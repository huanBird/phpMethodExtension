[WIP] helpers for php
======

### Require

- php >= 7.0

### Installation

```shell
composer require szmz/phpmethodextension
```

### Documentation

```shell
    /**
     * 银行卡卡号掩码 默认前四位 后四位
     * @param $bankCardNo
     * @param int $fistNum
     * @param int $backNum
     * @return string
     */
     function formatBankCardNo($bankCardNo,$fistNum = 4,$backNum = 4)

   /**
    * 时间转换计算
    * @param$show_time 需要转换的时间戳
    * @return string          转换后的时间
    */
    function timeTran($show_time)
    
    
    /**
     * 生成指定长度的随机字符串(包含大写英文字母, 小写英文字母, 数字)
     * @param int $length 需要生成的字符串的长度
     * @return string 包含 大小写英文字母 和 数字 的随机字符串
     */
    function random_str($length,$isupper = false)
    
  /**
   *   实现中文字串截取无乱码的方法
   *  @param $string 待截取的字符串
   *  @param $start   开始截取位置
   *  @param $length 截取长度
   *  @return  $string  截取后的字符串
   */
  function getSubstr($string, $start, $length)
  
  /**
   *   验证手机号码
   *  @param $phone 手机号码
   *  @return  bool   
   */
  function checkMobile($phone = '')
  
   /**
    * 过滤掉emoji表情
    */
  function repEmoji($str)
  
  /**
   * 格式化价格
   * @access  public
   * @param   float   $price  价格
   * @return  string
   */
  function priceFormat($price,$show_yuan = false,$type=0)

```

### Configuration

### Usage

### License

Licensed under [The MIT License (MIT)](LICENSE).
