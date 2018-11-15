<?php

namespace Radiophonix\Http\Responses\Saga;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use MarcW\RssWriter\Extension\Atom\AtomLink;
use MarcW\RssWriter\Extension\Atom\AtomWriter;
use MarcW\RssWriter\Extension\Core\Channel;
use MarcW\RssWriter\Extension\Core\CoreWriter;
use MarcW\RssWriter\Extension\Core\Enclosure;
use MarcW\RssWriter\Extension\Core\Image;
use MarcW\RssWriter\Extension\Core\Item;
use MarcW\RssWriter\Extension\Itunes\ItunesChannel;
use MarcW\RssWriter\Extension\Itunes\ItunesItem;
use MarcW\RssWriter\Extension\Itunes\ItunesOwner;
use MarcW\RssWriter\Extension\Itunes\ItunesWriter;
use MarcW\RssWriter\RssWriter;
use Radiophonix\Models\Author;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Support\CollectionType;
use Radiophonix\Models\Track;

class RssResponse implements Responsable
{
    /**
     * @var Saga
     */
    private $saga;

    /**
     * @var Author
     */
    private $author;

    /**
     * @var string
     */
    private $link;

    /**
     * @param Saga $saga
     */
    public function __construct(Saga $saga)
    {
        $this->saga = $saga;
        $this->author = $saga->authors()->first();
        $this->link = route('rss.saga', ['saga' => $saga->slug]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function toResponse($request)
    {
        $writer = $this->makeWriter();
        $channel = $this->buildChannel();

        $response = new Response();
        $response->header('Content-Type', 'application/rss+xml; charset=utf-8');
        $response->setContent($writer->writeChannel($channel));

        return $response;
    }

    /**
     * @return Channel
     */
    private function buildChannel(): Channel
    {
        $channel = new Channel();

        $image = new Image();
        $image->setUrl($this->saga->getFirstMediaUrl('cover', 'main'))
            ->setTitle($this->saga->name)
            ->setLink($this->link);

        $channel
            ->setTitle($this->saga->name)
            ->setDescription($this->saga->synopsis)
            ->setLink($this->link)
            ->setLanguage('fr')
            ->setCopyright($this->saga->licence)
            ->setImage($image)
            ->setPubDate($this->saga->last_publish_at)
            ->setLastBuildDate(Carbon::now())
            ->setGenerator('Radiophonix');

        $itunesChannel = (new ItunesChannel())
            ->setAuthor($this->author->name)
            ->setOwner(
                (new ItunesOwner())
                    ->setName($this->author->name)
                    ->setEmail($this->author->user->email)
            )
            ->setImage($image->getUrl())
            ->setSummary($this->saga->synopsis)
            ->setExplicit('no')
            ->setComplete($this->saga->finished);

        $atomLink = (new AtomLink())
            ->setRel('self')
            ->setHref($this->link)
            ->setType('application/rss+xml');

        $channel->addExtension($itunesChannel);
        $channel->addExtension($atomLink);

        $seasons = $this->saga->getCollections(CollectionType::SEASON);

        $index = 0;
        foreach ($seasons as $season) {
            foreach ($season->tracks as $track) {
                $withSeason = $seasons->count() > 1 ? $season : null;

                $channel->addItem(
                    $this->buildItem($track, $image, ++$index, $withSeason)
                );
            }
        }

        return $channel;
    }

    /**
     * @param Track $track
     * @param Image $image
     * @param int $index
     * @param Collection|null $season
     * @return Item
     */
    private function buildItem(Track $track, Image $image, int $index, ?Collection $season): Item
    {
        $enclosure = (new Enclosure())
            ->setUrl($track->url)
            /**
             * @todo taille du fichier en bytes
             * @see https://en.wikipedia.org/wiki/RSS_enclosure
             */
            ->setLength(0)
            ->setType('audio/mp3');

        $description = $track->synopsis;

        if ($season) {
            $description .= vsprintf(
                "\n\n%s - Épisode %s",
                [
                    $season->name,
                    $track->number,
                ]
            );
        }

        $description = trim($description);

        $item = (new Item())
            ->setTitle($track->title)
            ->setDescription($description)
            ->setEnclosure($enclosure)
            ->setPubDate($track->published_at);

        $itunesItem = (new ItunesItem())
            ->setSummary($description)
            ->setExplicit('no')
            ->setImage($image->getUrl())
            ->setAuthor($this->author->name)
            ->setOrder($index);

        return $item->addExtension($itunesItem);
    }

    /**
     * @return RssWriter
     */
    private function makeWriter(): RssWriter
    {
        $rssWriter = new RssWriter(null, [], true);
        $rssWriter->registerWriter(new CoreWriter());
        $rssWriter->registerWriter(new ItunesWriter());
//        $rssWriter->registerWriter(new SyWriter());
//        $rssWriter->registerWriter(new SlashWriter());
        $rssWriter->registerWriter(new AtomWriter());
//        $rssWriter->registerWriter(new DublinCoreWriter());

        return $rssWriter;
    }
}
