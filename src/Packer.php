<?php
namespace CZJ\MsgPack;

use CZJ\MsgPack\Pack\ValuePack;
use CZJ\MsgPack\Pack\ArrayPack;

class Packer
{
    use ValuePack;
    public $msgPack;

    public function pack($data)
    {
        if (is_array($data)) {
            $arrPacker = new ArrayPack();
            return $arrPacker->pack($data);
        } else {
            return $this->valuePack($data);
        }
    }
}