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

    public function test_array_push()
    {
        $datatables = new Datatables([], ['draw' => 1]);
        $data = [
            [
                'id' => 1,
                'name' => 'One'
            ]
        ];

        $datatables->setData($data);
        $total = $datatables->push(['id' => 2, 'name' => 'Two']);
        $this->assertEquals(2, $total);

        $output = json_decode($datatables->output(), true);
        $rows = $output['data'];
        $second = $rows[1];
        $this->assertEquals(2, $second['id']);
        $this->assertEquals('Two', $second['name']);
    }

    public function test_array_unshift()
    {
        $datatables = new Datatables([], ['draw' => 1]);
        $data = [
            [
                'id' => 1,
                'name' => 'One'
            ]
        ];

        $datatables->setData($data);
        $total = $datatables->unshift(['id' => 2, 'name' => 'Two']);
        $this->assertEquals(2, $total);

        $output = json_decode($datatables->output(), true);
        $rows = $output['data'];
        $first = $rows[0];
        $this->assertEquals(2, $first['id']);
        $this->assertEquals('Two', $first['name']);
    }

    public function test_array_pop()
    {
        $datatables = new Datatables([], ['draw' => 1]);
        $data = [
            [
                'id' => 1,
                'name' => 'One'
            ],
            [
                'id' => 2,
                'name' => 'Two'
            ]
        ];

        $datatables->setData($data);
        $second = $datatables->pop();
        $this->assertEquals(2, $second['id']);
        $this->assertEquals('Two', $second['name']);

        $output = json_decode($datatables->output(), true);
        $rows = $output['data'];
        $second = $rows[0];
        $this->assertEquals(1, $second['id']);
        $this->assertEquals('One', $second['name']);
    }

    public function test_array_shift()
    {
        $datatables = new Datatables([], ['draw' => 1]);
        $data = [
            [
                'id' => 1,
                'name' => 'One'
            ],
            [
                'id' => 2,
                'name' => 'Two'
            ]
        ];

        $datatables->setData($data);
        $first = $datatables->shift();
        $this->assertEquals(1, $first['id']);
        $this->assertEquals('One', $first['name']);

        $output = json_decode($datatables->output(), true);
        $rows = $output['data'];
        $second = $rows[0];
        $this->assertEquals(2, $second['id']);
        $this->assertEquals('Two', $second['name']);
    }
}
