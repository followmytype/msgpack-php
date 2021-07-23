<?php

namespace MsgPack\Test;

use CZJ\MsgPack\Packer;
use PHPUnit\Framework\TestCase;

final class SimpleTest extends TestCase
{
    public function testBoolNull()
    {
        $pack = new Packer();
        $this->assertEquals($pack->pack(null), hex2bin('c0'));
        $this->assertEquals($pack->pack(false), hex2bin('c2'));
        $this->assertEquals($pack->pack(true), hex2bin('c3'));
    }

    public function testInt()
    {
        $pack = new Packer();
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

    public function testStr()
    {
        $pack = new Packer();
        // 空字串
        $str = $this->strAGenerate(0);
        $this->assertEquals($pack->pack($str), hex2bin('a0'));
        // 1個字元
        $str = $this->strAGenerate(1);
        $this->assertEquals($pack->pack($str), hex2bin('a1') . $str);
        // 31字元
        $str = $this->strAGenerate(31);
        $this->assertEquals($pack->pack($str), hex2bin('bf') . $str);
        // 32字元
        $str = $this->strAGenerate(32);
        $this->assertEquals($pack->pack($str), hex2bin('d920') . $str);
        // 33字元
        $str = $this->strAGenerate(33);
        $this->assertEquals($pack->pack($str), hex2bin('d921') . $str);
        // 255字元
        $str = $this->strAGenerate(255);
        $this->assertEquals($pack->pack($str), hex2bin('d9ff') . $str);
        // 256字元
        $str = $this->strAGenerate(256);
        $this->assertEquals($pack->pack($str), hex2bin('da0100') . $str);
        // 257字元
        $str = $this->strAGenerate(257);
        $this->assertEquals($pack->pack($str), hex2bin('da0101') . $str);
        // 65535字元
        $str = $this->strAGenerate(65535);
        $this->assertEquals($pack->pack($str), hex2bin('daffff') . $str);
        // 65536字元
        $str = $this->strAGenerate(65536);
        $this->assertEquals($pack->pack($str), hex2bin('db00010000') . $str);
        // 65537字元
        $str = $this->strAGenerate(65537);
        $this->assertEquals($pack->pack($str), hex2bin('db00010001') . $str);
    }

    public function testChineseStr()
    {
        $pack = new Packer();
        $this->assertEquals($pack->pack("中文字"), hex2bin('a9') . "中文字");
    }

    public function strAGenerate(int $num)
    {
        $A = '';
        for ($i=0; $i < $num; $i++) { 
            $A .= 'A';
        }
        return $A;
    }

    public function testArrayPack()
    {
        $pack = new Packer();
        $emptyArr = [];
        $this->assertEquals($pack->pack($emptyArr), hex2bin('90'));
        $oneDegreeArr = [1, 2, 3];
        $this->assertEquals($pack->pack($oneDegreeArr), hex2bin('93010203'));
        $oneDegreeArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16];
        $this->assertEquals($pack->pack($oneDegreeArr), hex2bin('dc00100102030405060708090a0b0c0d0e0f10'));
        $twoDegreeArr = [
            [1, 1, 1],
            [],
            'a'
        ];
        $this->assertEquals($pack->pack($twoDegreeArr), hex2bin('939301010190a161'));
        $threeDegreeArr = [
            [1, 1, 1],
            [
                ['a'],
                ['']
            ],
            'a'
        ];
        $this->assertEquals($pack->pack($threeDegreeArr), hex2bin('93930101019291a16191a0a161'));
    }

    public function testMapPack()
    {
        $pack = new Packer();
        $oneDegreeMap = ["A" => 1, "B" => 2, "C" => 3];
        $this->assertEquals($pack->pack($oneDegreeMap), hex2bin('83a14101a14202a14303'));
        $oneDegreeMap = [
            "A" => 1, 
            "B" => [
                [1,1],
                "a" => 9,
                "b" => [
                    "c" => 2
                ]
             ], 
            "C" => 3
        ];
        $this->assertEquals($pack->pack($oneDegreeMap), hex2bin('83a14101a1428300920101a16109a16281a16302a14303'));
    }
}