<?php

namespace MClassic\Datatables\Engine;

/**
 * Interface ProtocolEngine
 *
 * @package MClassic\Datatables\Engine
 */
interface ProtocolEngine
{
    /** Legacy protocol */
    const VERSION_1 = 1;
    /** Modern 1.10+ protocol */
    const VERSION_2 = 2;

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function data(array $data = null);

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $value
     *
     * @return array|string
     */
    public function draw($value = null);

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $message
     *
     * @return array|string
     */
    public function error($message = null);

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $length
     *
     * @return array|string
     */
    public function length($length = null);

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $start
     *
     * @return array|string
     */
    public function start($start = null);

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $total
     *
     * @return array|string
     */
    public function totalFiltered($total = null);

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $total
     *
     * @return array|string
     */
    public function totalRecords($total = null);

    /**
     * What protocol version is implemented?
     *
     * @return const Protocol version as determined by interface and implementation
     */
    public function version();
}
