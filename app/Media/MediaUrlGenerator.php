<?php

namespace Radiophonix\Media;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\UrlGenerator\LocalUrlGenerator;

class MediaUrlGenerator extends LocalUrlGenerator
{
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return Str::start(parent::getUrl(), $this->config->get('app.url'));
    }
}
