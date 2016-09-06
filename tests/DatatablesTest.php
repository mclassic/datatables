<?php

use MClassic\Datatables\Datatables;
use MClassic\Datatables\MissingProtocolException;
use Mockery as m;

class DatatablesTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_array_push()
    {
        $datatables = new Datatables(['draw' => 1]);
        $data = [
            [
                'id'   => 1,
                'name' => 'One',
            ],
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
        $datatables = new Datatables(['draw' => 1]);
        $data = [
            [
                'id'   => 1,
                'name' => 'One',
            ],
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
        $datatables = new Datatables(['draw' => 1]);
        $data = [
            [
                'id'   => 1,
                'name' => 'One',
            ],
            [
                'id'   => 2,
                'name' => 'Two',
            ],
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
        $datatables = new Datatables(['draw' => 1]);
        $data = [
            [
                'id'   => 1,
                'name' => 'One',
            ],
            [
                'id'   => 2,
                'name' => 'Two',
            ],
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

    public function test_missing_option_draw()
    {
        $this->setExpectedException(MissingProtocolException::class);
        $datatables = new Datatables();
        $this->assertNull($datatables->getProtocol(), 'Datatables should return a null ProtocolEngine.');
        // This will throw an exception because the protocol engine was not set via options or explcitly using setProtocol()
        $output = $datatables->output();
    }

    public function test_new_table_draw()
    {
        $datatables = new Datatables(['draw' => 23]);
        $output = json_decode($datatables->output(), true);

        $this->assertArrayHasKey('draw', $output);
        $this->assertEquals(23, $output['draw']);
    }

    public function test_new_table_data_output()
    {
        $datatables = new Datatables(['draw' => 3]);
        $data = [
            [
                'name'        => 'Test Name'
            ]
        ];

        $datatables->setData($data);
        $output = json_decode($datatables->output(), true);
        $this->assertArrayHasKey('data', $output);
        $row = $output['data'][0];

        $this->assertEquals('Test Name', $row['name']);
    }

    public function test_old_table_draw()
    {
        $datatables = new Datatables(['sEcho' => 123]);
        $data = [
            [
                'id' => 1,
            ],
        ];

        $datatables->setData($data);
        $output = json_decode($datatables->output(), true);
        $this->assertArrayHasKey('sEcho', $output);
        $this->assertEquals(123, $output['sEcho']);
    }

    public function test_old_table_data_output()
    {
        $datatables = new Datatables(['sEcho' => 2]);
        $data = [
            [
                'name'        => 'Test Name'
            ]
        ];

        $datatables->setData($data);
        $output = json_decode($datatables->output(), true);
        $this->assertArrayHasKey('aaData', $output);
        $row = $output['aaData'][0];

        $this->assertEquals('Test Name', $row['name']);
    }
}
