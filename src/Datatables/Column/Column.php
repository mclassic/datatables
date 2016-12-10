<?php

namespace MClassic\Datatables\Column;

use InvalidArgumentException;

class Column
{
    /** @var  mixed */
    protected $data;
    /** @var  boolean */
    protected $orderable;
    /** @var  string */
    protected $name;
    /** @var  boolean */
    protected $searchable;
    /**
     * This represents the name or SQL representing a column name for a database query result set.
     *
     * @var  string
     */
    protected $selector;
    /** @var  string */
    protected $title;
    /** @var */
    protected $type;
    /** @var  boolean */
    protected $visible;

    /**
     * Column constructor.
     *
     * @param array $options An optional array of options to fill in class properties
     */
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            array_walk($options, function ($value, $key) {
                switch ($key) {
                    case 'orderable':
                        $this->orderable = (bool) $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'searchable':
                        $this->searchable = (bool) $value;
                        break;
                    case 'selector':
                        $this->selector = $value;
                        break;
                    case 'title':
                        $this->title = $value;
                        break;
                    case 'visible':
                        $this->visible = (bool) $value;
                        break;
                    default:
                        throw new InvalidArgumentException('Invalid option passed to Column constructor');
                        break;
                }
            });
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSelector()
    {
        return $this->selector ?: $this->name;
    }

    public function isOrderable()
    {
        return $this->orderable === true;
    }

    public function isSearchable()
    {
        return $this->searchable === true;
    }

    public function isVisible()
    {
        return $this->visible === true;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSelector($selector)
    {
        $this->selector = $selector;
    }
}
