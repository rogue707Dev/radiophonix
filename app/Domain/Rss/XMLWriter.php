<?php

namespace Radiophonix\Domain\Rss;

class XMLWriter extends \XMLWriter
{
    public function startDocument($version = '1.0', $encoding = null, $standalone = null)
    {
        return parent::startDocument('1.0', 'UTF-8');
    }
}
