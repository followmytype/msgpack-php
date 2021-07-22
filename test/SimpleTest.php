<?php

namespace MsgPack\Test;

use CZJ\MsgPack\Pack\Pack;
use PHPUnit\Framework\TestCase;

final class SimpleTest extends TestCase
{
    public function testInt()
    {
        $pack = new Pack();
        $this->assertEquals($pack->pack(0), hex2bin('00'));
        $this->assertEquals($pack->pack(1), hex2bin('01'));
        $this->assertEquals($pack->pack(127), hex2bin('7f'));
        $this->assertEquals($pack->pack(128), hex2bin('cc80'));
        $this->assertEquals($pack->pack(129), hex2bin('cc81'));
        $this->assertEquals($pack->pack(255), hex2bin('ccff'));
        $this->assertEquals($pack->pack(256), hex2bin('cd0100'));
        $this->assertEquals($pack->pack(257), hex2bin('cd0101'));
        $this->assertEquals($pack->pack(65535), hex2bin('cdffff'));
        $this->assertEquals($pack->pack(65536), hex2bin('ce00010000'));
        $this->assertEquals($pack->pack(65537), hex2bin('ce00010001'));
    }
}