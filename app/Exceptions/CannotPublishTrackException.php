<?php

namespace Radiophonix\Exceptions;

use Exception;
use Radiophonix\Models\Track;

class CannotPublishTrackException extends Exception
{
    /**
     * @var Track
     */
    private $track;

    public function __construct(Track $track)
    {
        parent::__construct(
            sprintf('The track #%s is not publishable', $track->id)
        );

        $this->track = $track;
    }

    /**
     * @return Track
     */
    public function getTrack(): Track
    {
        return $this->track;
    }
}
