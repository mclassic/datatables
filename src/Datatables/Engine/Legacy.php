<?php

namespace MClassic\Datatables\Engine;

/**
 * Implementation for legacy protocol
 *
 * @package MClassic\Datatables\Engine
 */
class Legacy implements ProtocolEngine
{

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $value
     *
     * @return array|string
     */
    public function draw($value = null)
    {
        return $value ? ['sEcho' => (int) $value] : 'sEcho';
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $message
     *
     * @return array
     */
    public function error($message = null)
    {
        // This doesn't exist in legacy protocol
        return;
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $length
     *
     * @return array
     */
    public function length($length = null)
    {
        // TODO: Implement length() method.
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $start
     *
     * @return array
     */
    public function start($start = null)
    {
        // TODO: Implement start() method.
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $total
     *
     * @return array|string
     */
    public function totalFiltered($total = null)
    {
        return $total ? ['iTotalDisplayRecords' => (int) $total] : 'iTotalDisplayRecords';
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $total
     *
     * @return array|string
     */
    public function totalRecords($total = null)
    {
        return $total ? ['iTotalRecords' => (int) $total] : 'iTotalRecords';
    }

    /**
     * What protocol version is implemented?
     *
     * @return const Protocol version as determined by interface and implementation
     */
    public function version()
    {
        return ProtocolEngine::VERSION_1;
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param array $data
     *
     * @return array|string
     */
    public function data(array $data = null)
    {
        return $data ? ['aaData' => $data] : 'aaData';
    }
}
