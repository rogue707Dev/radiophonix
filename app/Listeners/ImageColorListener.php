<?php

namespace Radiophonix\Listeners;

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;

class ImageColorListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param MediaHasBeenAdded $event
     * @return void
     */
    public function handle(MediaHasBeenAdded $event)
    {
        $media = $event->media;

        // We only want to extract colors from images
        if ($media->getTypeFromExtension() !== 'image'
            || !$media->hasCustomProperty('colors')
        ) {
            return;
        }

        // First we create a color palette based on the given image
        $palette = Palette::fromFilename($media->getPath());

        // We only want the most representative color
        $colors = (new ColorExtractor($palette))->extract(1);

        // We transform it to Hex for easier usage
        $color = Color::fromIntToHex($colors[0]);
        $rgb = Color::fromIntToRgb($colors[0]);

        $contrast = $this->getColorContrast($rgb['r'], $rgb['g'], $rgb['b']);

        $media->setCustomProperty('color', $color);
        $media->setCustomProperty('color_type', $contrast);
        $media->save();
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     * @return string
     */
    private function getColorContrast(int $r, int $g, int $b)
    {
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? 'light' : 'dark';
    }
}
