<?php

namespace MClassic\Datatables\Column;

class Builder
{
    /** @var  Column */
    protected $column;

    public function __construct(array $options = [])
    {
        $this->column = new Column();
        foreach ($options as $key => $value) {
            switch ($key) {

            }
        }
    }
}
