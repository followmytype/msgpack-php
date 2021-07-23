# msgpack-php
自製msgPack套件，目前只完成`pack`功能
## 安裝方法
在`composer.json`裡加入這段，因為我沒有放到`packagist`上
```json
{
    // require裡加上套件名稱
    "require": {
        "czj/msgpack": "dev-main",
    },
    // repositories加上位置
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/followmytype/msgpack-php"
        }
    ]
}

```
## 使用方法
```php
// 引入vendor裡的autoload.php
require 'vendor/autoload.php';

use CZJ\MsgPack\Packer;

$packer = new Packer();

$nilMsgPack = $packer->pack(null);
$falseMsgPack = $packer->pack(false);
$trueMsgPack = $packer->pack(true);
$intZeroMsgPack = $packer->pack(0);
$intNumberMsgPack = $packer->pack(123);
$strMsgPack = $packer->pack("string");
$arrayMsgPack = $packer->pack([1, 2]);
$mapMsgPack = $packer->pack(['a' => 1, 'b' => 2]);
```
## 尚未完成功能
* ### `Pack`
    - [ ] 負數轉換
    - [ ] 浮點數
    - [ ] `bin format family`
    - [ ] 擴充型態

* ### `Unpack`
    - [ ] 全部