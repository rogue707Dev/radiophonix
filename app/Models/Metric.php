<?php
declare(strict_types=1);

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $uuid
 * @property string $type
 * @property int $version
 * @property array $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Metric extends Model
{
    const UPDATED_AT = null;

    /** @var string */
    protected $primaryKey = 'uuid';

    /** @var string */
    protected $keyType = 'string';

    /** @var bool */
    public $incrementing = false;

    /** @var array */
    protected $casts = [
        'data' => 'json',
    ];
}
