<?php

namespace Radiophonix\Media;

use Radiophonix\Models\Media;
use Spatie\MediaLibrary\Models\Media as BaseMedia;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class UuidPathGenerator implements PathGenerator
{
    public function getPath(BaseMedia $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    public function getPathForConversions(BaseMedia $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    /**
     * @param BaseMedia $media
     * @return string
     */
    protected function getBasePath(BaseMedia $media): string
    {
        if ($media instanceof Media) {
            return (string)$media->uuid();
        }

        return $media->getKey();
    }

    public function getPathForResponsiveImages(BaseMedia $media): string
    {
        return $this->getBasePath($media) . '/responsives/';
    }
}
