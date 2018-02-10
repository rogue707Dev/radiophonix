<?php

namespace Radiophonix\Models\Support;

use Spatie\MediaLibrary\Media;

interface HasMediaMetadata
{
    /**
     * @param string $collectionName
     * @param array $filters
     * @return Media|null
     */
    public function getFirstMedia(string $collectionName = 'default', array $filters = []);
}
