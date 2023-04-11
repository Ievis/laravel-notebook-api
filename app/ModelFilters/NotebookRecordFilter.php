<?php

namespace App\ModelFilters;

use App\Services\TokenService;
use EloquentFilter\ModelFilter;

class NotebookRecordFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function email($email)
    {
        return $this->where('email', 'LIKE', "%$email%");
    }

    public function setup()
    {
        $this->query = TokenService::getUserByToken()->notebook_records();
    }
}
