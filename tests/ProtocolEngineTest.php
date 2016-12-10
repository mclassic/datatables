<?php

use MClassic\Datatables\Datatables;
use MClassic\Datatables\Engine\Legacy;
use MClassic\Datatables\Engine\Modern;
use MClassic\Datatables\Engine\ProtocolEngine;

class ProtocolEngineTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_modern_engine()
    {
        $datatables = new Datatables(['draw' => 123]);
        $engine = $datatables->getProtocol();
        $this->assertEquals(ProtocolEngine::VERSION_2, $engine->version(), 'Mismatched protocol version.');
    }

    public function test_legacy_engine()
    {
        $datatables = new Datatables(['sEcho' => 123]);
        $engine = $datatables->getProtocol();
        $this->assertEquals(ProtocolEngine::VERSION_1, $engine->version(), 'Mismatched protocol version.');
    }

    public function test_explicit_modern_engine()
    {
        $datatables = new Datatables();
        $datatables->setProtocol(new Modern());
        $engine = $datatables->getProtocol();
        $this->assertEquals(ProtocolEngine::VERSION_2, $engine->version(), 'Mismatched protocol version.');
    }

    public function test_explicit_legacy_engine()
    {
        $datatables = new Datatables();
        $datatables->setProtocol(new Legacy());
        $engine = $datatables->getProtocol();
        $this->assertEquals(ProtocolEngine::VERSION_1, $engine->version(), 'Mismatched protocol version.');
    }

    public function test_modern_draw()
    {
        $protocol = new Modern();
        $this->assertEquals('draw', $protocol->draw());
        $this->assertArraySubset(['draw' => 456], $protocol->draw(456), true, 'Protocol does not match echo.');
    }
}
