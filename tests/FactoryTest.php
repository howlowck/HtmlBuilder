<?php

use Howlowck\HtmlBuilder\Factory;
class FactoryTest extends PHPUnit_Framework_TestCase {
    public function testCreateInstance() {
        $factory = new Factory();
        $this->assertInstanceOf('Howlowck\HtmlBuilder\Element', $factory->make('ul'));
    }
}