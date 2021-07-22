<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\IntPack;

class Pack
{
    public IntPack $intpack;
    public StrPack $strpack;

    function __construct(){
        $this->intpack = new IntPack();
        $this->strpack = new StrPack();
    }

    public function pack($data)
    {
        if (is_int($data)) {
            return $this->intpack->pack($data);
        }
        if (is_string($data)) {
            return $this->strpack->pack($data);
        }

    }
}