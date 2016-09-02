<?php

namespace MClassic\Datatables;

interface DatatableContract
{
    /**
     * The method to return as a response to a jQuery Datatables API query.
     *
     * @return string JSON-formatted string
     */
    function output();

    /**
     * Perform a search (filter) on data using the previously defined callback.
     *
     * @param      $search
     * @param bool $regex
     *
     * @return mixed
     * @see searchable
     */
    function search($search, $regex = false);

    /**
     * Set the search callback for filtering data.
     *
     * @param callable $callback
     *
     * @return mixed
     * @see search
     */
    function searchable(callable $callback);

    /**
     * Set the data all at once by passing an array of rows. An example would be an array of results from a database query.
     *
     * @param array $data
     *
     * @return mixed
     */
    function setData(array $data);
}
