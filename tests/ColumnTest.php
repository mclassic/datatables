<?php

use MClassic\Datatables\Column\Column;
use MClassic\Datatables\Datatables;
use MClassic\Datatables\Engine\Modern;

class ColumnTest extends PHPUnit_Framework_TestCase
{
    public function test_adding_and_retrieving_column()
    {
        $protocol = new Modern();
        $datatables = new Datatables($protocol->draw('1'));
        $columnOptions = [
            'searchable' => false,
            'visible' => true,
            'orderable' => true,
            'name' => 'test1'
        ];

        $datatables->addColumn(new Column($columnOptions));
        $columns = $datatables->getColumns();
        $checkMe = $columns[0];
        $this->assertEquals('test1', $checkMe->getName());
        $this->assertFalse($checkMe->isSearchable());
        $this->assertTrue($checkMe->isVisible());
        $this->assertTrue($checkMe->isOrderable());
    }
}
