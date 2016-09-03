<?php

use MClassic\Datatables\Datatables;
use Mockery as m;

class DatatablesTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        //
    }

    public function tearDown()
    {
        //
    }

    public function test_new_table_output()
    {
        $datatables = new Datatables([], ['draw' => 1]);
        $data = [
            [
                'id'          => 1,
                'name'        => 'Test Name',
                'description' => 'This is some test data',
            ],
        ];

        $datatables->setData($data);
        $output = json_decode($datatables->output(), true);
        $row = $output['data'][0];

        $this->assertArrayHasKey('id', $row);
        $this->assertEquals(1, $row['id']);
        $this->assertArrayHasKey('name', $row);
        $this->assertEquals('Test Name', $row['name']);
        $this->assertArrayHasKey('description', $row);
        $this->assertEquals('This is some test data', $row['description']);
    }

    public function test_new_table_draw()
    {
        $datatables = new Datatables([], ['draw' => 23]);
        $output = json_decode($datatables->output(), true);

        $this->assertArrayHasKey('draw', $output);
        $this->assertEquals($output['draw'], 23);
    }
}
