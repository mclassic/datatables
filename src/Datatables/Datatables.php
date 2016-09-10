<?php

namespace MClassic\Datatables;

use MClassic\Datatables\Engine\Legacy;
use MClassic\Datatables\Engine\Modern;
use MClassic\Datatables\Engine\ProtocolEngine;

/**
 * Server-side processor for jQuery's DataTables plugin.
 * This class is now only compatible with the protocol used for DataTables 1.10+.
 *
 * @author Mike Classic
 */
class Datatables implements DataArray, DatatableContract
{
    protected $columns       = [];
    protected $totalFiltered = 0;
    protected $count_page    = 0;
    protected $draw;
    protected $offset        = 0;
    /** @var  ProtocolEngine */
    protected $protocol;
    protected $searchableColumns = [];
    protected $searchCallback;
    protected $table             = [];
    protected $total             = 0;

    public function __construct(array $options = [])
    {
        // $this->columns = $columns;
        foreach ($options as $option => $value) {
            switch (strtolower($option)) {
                case 'draw':
                    $this->draw = (int) $value;
                    $this->setProtocol(new Modern());
                    break;
                case 'secho':
                    $this->draw = (int) $value;
                    $this->setProtocol(new Legacy());
                    break;
                case 'page':
                    break;
                default:
                    break;
            }
        }
    }

    public function page($offset, $length = null)
    {
        $this->table = array_slice($this->table, (int) $offset, $length);
        $this->offset = (int) $offset;
        $this->count_page = $length ?: count($this->table);
    }

    /**
     * {@inheritdoc}
     * @return mixed
     */
    public function pop()
    {
        $result = array_pop($this->table);
        $this->resetCounts();

        return $result;
    }

    /**
     * Reset all counts, appropriate totals, etc.
     * @todo Make this do something useful
     */
    protected function resetCounts()
    {
        $this->count_page = count($this->table);
        // Provide an initial total if it hasn't yet been set
        if ($this->total === 0) {
            $this->total = count($this->table);
        }
    }

    /**
     * {@inheritdoc}
     * @param $row
     *
     * @return int
     */
    public function push($row)
    {
        $result = array_push($this->table, $row);
        $this->resetCounts();

        return $result;
    }

    /**
     * {@inheritdoc}
     * @param      $search
     * @param bool $regex
     *
     * @return mixed
     * @throws \Exception
     */
    public function search($search, $regex = false)
    {
        if (!isset($this->searchCallback)) {
            throw new \Exception('The search callback has not been defined. Please define using searchable() first.');
        }

        $callback = $this->searchCallback;

        return $callback($search, $regex);
    }

    /**
     * {@inheritdoc}
     * @param callable $callback
     */
    public function searchable(callable $callback)
    {
        $this->searchCallback = $callback;
    }

    /**
     * {@inheritdoc}
     * @return mixed
     */
    public function shift()
    {
        $result = array_shift($this->table);
        $this->resetCounts();

        return $result;
    }

    /**
     * {@inheritdoc}
     * @param $row
     *
     * @return int
     */
    public function unshift($row)
    {
        $result = array_unshift($this->table, $row);
        $this->resetCounts();

        return $result;
    }

    /**
     * {@inheritdoc}
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->table = $data;
        $this->resetCounts();
    }

    /**
     * Return protocol engine.
     *
     * @return ProtocolEngine
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set protocol engine to use.
     *
     * @param ProtocolEngine $protocol
     */
    public function setProtocol(ProtocolEngine $protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * {@inheritdoc}
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = (int) $total;
    }

    /**
     * {@inheritdoc}
     * @return mixed
     * @throws MissingProtocolException
     */
    public function output()
    {
        if (empty($this->protocol)) {
            throw new MissingProtocolException('The ProtocolEngine has not been set.');
        }

        $this->totalFiltered = count($this->table);
        /* @todo Filtered totals are inaccurate, this needs to be fixed ASAP */
        $output = [
            $this->protocol->draw()          => (int) $this->draw,
            $this->protocol->totalRecords()  => (int) $this->total,
            $this->protocol->totalFiltered() => (int) $this->total,
            $this->protocol->data()          => $this->table,
        ];

        return json_encode($output);
    }
}
