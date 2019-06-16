<?php

namespace Radiophonix\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Radiophonix\Models\Tick;

class TickCompleteScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('progress', '<', Tick::MIN_PROGRESS_TO_BE_COMPLETE);
    }
}
