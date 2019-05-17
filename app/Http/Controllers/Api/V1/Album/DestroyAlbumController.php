<?php

namespace Radiophonix\Http\Controllers\Api\V1\Album;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Album;

class DestroyAlbumController extends ApiController
{
    public function __invoke(Album $album): ApiResponse
    {
        $this->authorize('delete', $album);

        $saga = $album->saga;

        $album->delete();

        $saga->refreshLastPublishedAt();

        return $this->ok();
    }
}
