<?php

namespace MClassic\Datatables;

interface DataArray
{
    /**
     * Pop an element off of the end of an array.
     *
     * @return mixed the last value of in the array
     */
    function pop();

    /**
     * Push an element on to the end of an array.
     *
     * @param $entry
     *
     * @return int the new number of elments in the array
     */
    function push($entry);

    /**
     * Shift an element off of the beginning of an array.
     *
     * @return mixed the shifted value taken off the beginning of the array
     */
    function shift();

    /**
     * Add an element to the beginning of an array.
     *
     * @param $entry
     *
     * @return mixed the new number of elements in the array
     */
    function unshift($entry);
}
