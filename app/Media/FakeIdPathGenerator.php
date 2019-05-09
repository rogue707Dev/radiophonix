<?php

namespace Radiophonix\Media;

use Radiophonix\Models\Support\HasFakeId;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class FakeIdPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    /**
     * @param Media|HasFakeId $media
     * @return string
     */
    protected function getBasePath(Media $media): string
    {
        if (in_array(HasFakeId::class, class_uses($media))) {
            return $media->fakeId();
        }

        return $media->getKey();
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsives/';
    }
}
