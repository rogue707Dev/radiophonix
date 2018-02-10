<?php

namespace Radiophonix\Media;

use Radiophonix\Models\Support\HasFakeId;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class FakeIdPathGenerator implements PathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    /*
     * Get a (unique) base path for the given media.
     */
    protected function getBasePath(Media $media): string
    {
        if (in_array(HasFakeId::class, class_uses($media))) {
            return $media->fakeId();
        }

        return $media->getKey();
    }
}
