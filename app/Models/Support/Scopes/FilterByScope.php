<?php

namespace Radiophonix\Models\Support\Scopes;

/**
 * @method static static filterBy($filters)
 */
trait FilterByScope
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterBy($query, $filters)
    {
        $filterable = $this->filterable;

        // If no column can be filtered or no filter is sent then we do nothing
        if (count($this->filterable) == 0 || count($filters) == 0) {
            return $query;
        }

        $filterableColumns = array_keys($filterable);

        // We only allow white-listed columns
        $filters = array_filter($filters, function ($filter) use ($filterableColumns) {
            return in_array($filter, $filterableColumns);
        }, ARRAY_FILTER_USE_KEY);

        if (count($filters) == 0) {
            return $query;
        }

        /*
         * We loop throught wanted filters to see if we have to replace some values.
         * A model can override filter values like so:
         *
         * $filterables = [
         *      'foo' => [
         *          'bar' => 1
         *      ],
         *      'yo'
         * ];
         *
         * Here when a query has ?foo=bar&yo=123 we replace bar with 1 to have: ?foo=1&yo=123
         *
         * This is usefull for constants like status for example.
         */
        foreach ($filters as $filterKey => $filterValue) {
            $operator = substr($filters[$filterKey], 0, 1);

            if (!in_array($operator, ['+', '-', '='])) {
                $operator = '=';
                $filters[$filterKey] = $operator . $filters[$filterKey];
            }

            foreach ($filterable as $key => $values) {
                // If $filterables has a matching key and has bindings we look for the value to replace
                if ($key == $filterKey && is_array($values)) {
                    foreach ($values as $valueKey => $value) {
                        if ($valueKey == substr($filters[$filterKey], 1)) {
                            $filters[$filterKey] = substr($filters[$filterKey], 0, 1) . $value;
                        }
                    }
                }
            }
        }

        // A query can look like these:
        // ?foo=1,+2,-3&bar=paris

        foreach ($filters as $filter => $value) {
            $value = explode(',', $value);

            $query->where(function ($q) use ($filter, $value) {
                foreach ($value as $val) {
                    $operator = substr($val, 0, 1);

                    if ($operator != '+' && $operator != '-') {
                        $operator = '=';
                    } else {
                        $operator = $operator == '+' ? '=' : '!=';
                        $val = substr($val, 0, 1);
                    }

                    $q->orWhere($filter, $operator, $val);
                }
            });
        }

        return $query;
    }
}
