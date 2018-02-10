<?php

namespace Radiophonix\Models\Support\Scopes;

/** @noinspection PhpUndefinedClassInspection */

/**
 * @method static static sortBy($sort)
 */
trait SortByScope
{
    /**
     * Scope a query to sort results using a sorting string.
     *
     * The $sort string is a comma separated list of columns starting with
     * a + or a - for the sort order.
     *
     * Example: '+name,-city'
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortby($query, $sort)
    {
        $sortable = $this->sortable;

        $sort = explode(',', $sort);

        if (count($this->sortable) == 0 || count($sort) == 0) {
            // If no columns are sortables or no sorting options are given
            // we just return the query as is.
            return $query;
        }

        // We parse the $sort options to get the order
        $sort = array_map(function ($s) {
            return [
                'order' => substr($s, 0, 1) == '+' ? 'asc' : 'desc',
                'column' => substr($s, 1),
            ];
        }, $sort);

        // We remove unsortable columns
        $sort = array_filter($sort, function ($s) use ($sortable) {
            return in_array($s['column'], $sortable);
        });

        // We do the sorting itself
        foreach ($sort as $s) {
            $query->orderBy($s['column'], $s['order']);
        }

        return $query;
    }
}
