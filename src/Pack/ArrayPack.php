<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;
use CZJ\MsgPack\Pack\ValuePack;
/**
 * 轉換陣列的方法
 */
class ArrayPack extends BasePack
{
    // 因為我這邊要遞迴去跑整個陣列，當遇到單一數值時（非陣列）就要直接轉換他
    // 所以我這邊要用到trait
    use ValuePack;

    public function pack(array $arr) 
    {
        // 如果是空陣列就直接給他頭就好
        if (empty($arr)) return $this->arrayHead($arr);

        // 判斷是否為鍵值陣列去做對應的處理
        if ($this->isMap($arr)) {
            // 先拿頭
            $msgPack = $this->mapHead($arr);
            // 歷遍這個陣列
            foreach ($arr as $key => $value) {
                // 轉換key
                $msgPack .= $this->valuePack($key);
                // 如果value是陣列的話就遞迴去pack他，不是的話就pack value，組合他們
                if (is_array($value)) {
                    $msgPack .= $this->pack($value);
                } else {
                    $msgPack .= $this->valuePack($value);
                }
            }
        } else {
            $msgPack = $this->arrayHead($arr);
            foreach ($arr as $value) {
                if (is_array($value)) {
                    $msgPack .= $this->pack($value);
                } else {
                    $msgPack .= $this->valuePack($value);
                }
            }
        }
        // 回傳pack結果
        return $msgPack;
    }

    // 判斷陣列是否為鍵值陣列(key-value)
    public function isMap(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    // 取得普通陣列的頭
    private function arrayHead(array $arr)
    {
        $length = count($arr);

        if ($length < 16) {
            $hex = dechex($this::$array + $length);
        } elseif ($length < 65536) {
            $hex = dechex($this::$array16) . $this->leftAddZero($length, 4);
        } elseif ($length < pow(2, 32)) {
            $hex = dechex($this::$array32) . $this->leftAddZero($length, 8);
        }

        return hex2bin($hex);
    }

    // 取得鍵值陣列的頭
    private function mapHead(array $arr)
    {
        $length = count($arr);

        if ($length < 16) {
            $hex = dechex($this::$map + $length);
        } elseif ($length < 65536) {
            $hex = dechex($this::$map16) . $this->leftAddZero($length, 4);
        } elseif ($length < pow(2, 32)) {
            $hex = dechex($this::$map32) . $this->leftAddZero($length, 8);
        }

        return hex2bin($hex);
    }
}