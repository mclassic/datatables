<?php

namespace MClassic\Datatables\Query;

use MClassic\Datatables\Column\Column;

/**
 * Class representing a Search object. Also used to build it.
 *
 * @package MClassic\Query
 */
class Builder
{
    /** @var  Column[] */
    protected $columns = [];
    /** @var  callable */
    protected $searchCallback;
    /** @var  string */
    protected $query;
    /** @var  boolean */
    protected $regex = false;

    /**
     * Searchable constructor.
     */
    public function __construct()
    {
    }

    public function pushColumn(Column $column)
    {
        return array_push($this->columns, $column);
    }

    /**
     * Return all Columns associated with this query.
     *
     * @return Column[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return callable
     */
    public function getQuery()
    {
        return $this->searchCallback;
    }

    /**
     * Set/retrieve regex on query.
     *
     * @param bool|null $regex
     *
     * @return $this|null
     */
    public function regex($regex = null)
    {
        if (is_null($regex)) {
            return $regex;
        }

        $this->regex = $regex;

        return $this;
    }

    public function run()
    {
        $searchCallback = $this->searchCallback;

        return $searchCallback($this);
    }

    public function search(callable $callback)
    {
        $this->searchCallback = $callback;
    }
}
