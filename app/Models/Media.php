<?php

namespace Radiophonix\Models;

use Radiophonix\Models\Support\HasFakeId;
use Spatie\MediaLibrary\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFakeId;
}
