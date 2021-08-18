

当前组件整体处于 beta 阶段

## 运行环境

- php >= 7.0
- composer

## 安装

```shell
composer require szmz/phpmethodextension
```

## 说明


### 使用

```php
<?php
declare(strict_types=1);
namespace App\Controller;
use szmz\phpmethodextension\MethodExtension;

/**
 * @AutoController()
 */
class IndexController extends AbstractController
{
    public function index(Pay $pay)
    {
        $obj = new MethodExtension();
        $result = $obj->getMd5Sha1('2222222');
        return ['code'=>200,'data'=>$result];
    }
}
```

## 详细文档

[https://pay.yansongda.cn](https://pay.yansongda.cn)