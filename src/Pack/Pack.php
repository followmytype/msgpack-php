<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BoolNullPack;
use CZJ\MsgPack\Pack\IntPack;
use CZJ\MsgPack\Pack\StrPack;

class Pack
{
    public BoolNullPack $boolNullPack;
    public IntPack $intpack;
    public StrPack $strpack;

    function __construct(){
        $this->boolNullPack = new BoolNullPack();
        $this->intpack = new IntPack();
        $this->strpack = new StrPack();
    }

    public function pack($data)
    {
        if (is_bool($data) || is_null($data)) {
            return $this->boolNullPack->pack($data);
        }
        if (is_int($data)) {
            return $this->intpack->pack($data);
        }
        if (is_string($data)) {
            return $this->strpack->pack($data);
        }
    }
}