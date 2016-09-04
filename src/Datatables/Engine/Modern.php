<?php

namespace MClassic\Datatables\Engine;

class Modern implements ProtocolEngine
{

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function data(array $data = null)
    {
        return !empty($data) ? ['data' => $data] : 'data';
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $value
     *
     * @return array|string
     */
    public function draw($value = null)
    {
        return $value ? ['draw' => (int) $value] : 'draw';
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $message
     *
     * @return array|string
     */
    public function error($message = null)
    {
        return $message ? ['error' => $message] : 'error';
    }

    /**
     * Return key/value in context with implemented protocol.
     *
     * @param $length
     *
     * @return array|string
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
     * @return array|string
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
        return $total ? ['recordsFiltered' => (int) $total] : 'recordsFiltered';
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
        return $total ? ['recordsTotal' => (int) $total] : 'recordsTotal';
    }

    /**
     * What protocol version is implemented?
     *
     * @return const Protocol version as determined by interface and implementation
     */
    public function version()
    {
        return ProtocolEngine::VERSION_2;
    }
}