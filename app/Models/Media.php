<?php

namespace Radiophonix\Models;

use Radiophonix\Models\Support\GeneratesUuid;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use GeneratesUuid;
}
