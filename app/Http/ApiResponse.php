<?php

namespace Radiophonix\Http;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\ResourceInterface;

class ApiResponse extends Response
{
    /**
     * Create a json response for the API.
     *
     * @param mixed|string $content
     * @param int $status
     * @param array $headers
     */
    public function __construct($content, $status = 200, array $headers = [])
    {
        $headers['Content-Type'] = 'application/json';

        // Here we use Fractal to transform the $content data before returning it
        if ($content instanceof ResourceInterface) {
            if ($content instanceof FractalCollection && $content->hasPaginator()) {
                // We add some headers to help pagination for the client
                $headers['X-Per-Page'] = $content->getPaginator()->getPerPage();
                $headers['X-Page'] = $content->getPaginator()->getCurrentPage();
                $headers['X-Total'] = $content->getPaginator()->getTotal();

                // Previous and Next page numbers are only present when needed

                if ($content->getPaginator()->getCurrentPage() > 1) {
                    $headers['X-Link-Prev'] = $content->getPaginator()->getUrl(
                        $content->getPaginator()->getCurrentPage() - 1
                    );
                }

                if ($content->getPaginator()->getCurrentPage() < $content->getPaginator()->getLastPage()) {
                    $headers['X-Link-Next'] = $content->getPaginator()->getUrl(
                        $content->getPaginator()->getCurrentPage() + 1
                    );
                }
            }

            /** @var Manager $fractal */
            $fractal = app(Manager::class);

            $content = json_encode($fractal->createData($content)->toArray(), JSON_PRETTY_PRINT);
        } elseif ($content instanceof Jsonable) {
            $content = $content->toJson(JSON_PRETTY_PRINT);
        } else {
            $content = json_encode($content, JSON_PRETTY_PRINT);
        }

        parent::__construct($content, $status, $headers);
    }
}
