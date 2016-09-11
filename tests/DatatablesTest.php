<?php

use MClassic\Datatables\Datatables;
use MClassic\Datatables\Engine\Modern;
use MClassic\Datatables\Engine\ProtocolEngine;
use MClassic\Datatables\MissingProtocolException;

class DatatablesTest extends PHPUnit_Framework_TestCase
{
    protected $data;

    public function setUp()
    {
        parent::setUp();

        $faker = Faker\Factory::create();
        $faker->seed(1974);
        $this->data = [];
        for ($i = 0; $i < 100; $i++) {
            $this->data[] = [
                'id'   => $i + 1,
                'name' => $faker->name,
            ];
        }
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Return Datatables populated with larger data set.
     *
     * @param ProtocolEngine $protocol
     *
     * @return Datatables
     */
    protected function getDatatablesWithLargeDataset(ProtocolEngine $protocol)
    {
        $datatables = new Datatables($protocol->draw([123]));
        $datatables->setTotal(count($this->data));
        // var_dump($this->data); die;
        for ($i = 0; $i < 50; $i++) {
            $datatables->push($this->data[$i]);
        }

        return $datatables;
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
                'name' => 'Test Name',
            ],
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
                'name' => 'Test Name',
            ],
        ];

        $datatables->setData($data);
        $output = json_decode($datatables->output(), true);
        $this->assertArrayHasKey('aaData', $output);
        $row = $output['aaData'][0];

        $this->assertEquals('Test Name', $row['name']);
    }

    /* @todo This test fails right now because we don't do totals accurately in output() yet */
    public function test_table_output_totals()
    {
        $protocol = new Modern();
        $datatables = $this->getDatatablesWithLargeDataset($protocol);
        $output = json_decode($datatables->output(), true);
        // Uses modern protocol as default
        $this->assertEquals(100, $output[$protocol->totalRecords()], 'Total records before filtering is inaccurate.');
        $this->assertEquals(50, $output[$protocol->totalFiltered()], 'Total filtered records is inaccurate.');
    }
}
