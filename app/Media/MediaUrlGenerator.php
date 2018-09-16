<?php

namespace Radiophonix\Media;

use Spatie\MediaLibrary\UrlGenerator\LocalUrlGenerator;

class MediaUrlGenerator extends LocalUrlGenerator
{
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return str_start(parent::getUrl(), $this->config->get('app.url'));
    }
}
