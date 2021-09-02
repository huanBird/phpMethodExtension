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
  
  /**
   * 简易UUID生成
   * @access  public
   * @return  string
   */
  function uuid()
  
  /**
   * 返回经htmlspecialchars处理过的字符串或数组
   * @param $obj 需要处理的字符串或数组
   * @return mixed
   */
  function new_html_special_chars($string)
  
  /**
   * 安全过滤函数
   *
   * @param $string
   * @return string
   */
  function safe_replace($string)
  
  /**
   * xss过滤函数
   *
   * @param $string
   * @return string
   */
  function remove_xss($string)
  
  /**
   * 过滤ASCII码从0-28的控制字符
   * @return String
   */
  function trim_unsafe_control_chars($str)
  
  /**
   * 格式化文本域内容
   *
   * @param $string 文本域内容
   * @return string
   */
  function trim_textarea($string)
  
  /**
   * 将文本格式成适合js输出的字符串
   * @param string $string 需要处理的字符串
   * @param intval $isjs 是否执行字符串格式化，默认为执行
   * @return string 处理后的字符串
   */
  function format_js($string, $isjs = 1)
  
  /**
   * 转义 javascript 代码标记
   *
   * @param $str
   * @return mixed
   */
  function trim_script($str)
  
  /**
   * 获取请求ip
   *
   * @return ip地址
   */
  function ip()
  
  /**
   * 转换字节数为其他单位
   *
   *
   * @param    string    $filesize    字节大小
   * @return    string    返回大小
   */
  function sizecount($filesize)
  
  /**
   * 取得文件扩展
   *
   * @param $filename 文件名
   * @return 扩展名
   */
  function fileext($filename)
  
  /**
   * 隐藏手机号中间四位
   * @param $str
   * @return string|string[]
   */
  function yc_phone($str)
  
  /**
   * 检查身份证是否正确
   * @param $num_id
   * @return bool
   */
  function checkIdNum($num_id)
  
  /**
   * 判断是不是微信登陆
   * @return array
   */
  function is_wechat_open()
  
  /**
   * 生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
   * @param $length
   * @return string
   */
  function random_str($length)
  
  /**
   * [api_show  ]
   * @param $status 业务状态码
   * @param $message 信息提示
   * @param array $data 数据
   * @param int $httpCode http状态码
   * @return
   * @author [默默]
   */
  function api_show($status, $message, $data = [], $httpCode = 200)
  
  
  /**
   * 判断当前访问的用户是  PC端  还是 手机端  返回true 为手机端  false 为PC 端
   * @return bool
   */
  function isMobile()
  
  /**
   * 计算折扣
   * @param  [type] $activityPrice [description]
   * @param  [type] $marketPrice   [description]
   * @return [type]                [description]
   */
  function getDiscount($activityPrice, $marketPrice, $showUnit = false)
  
  
  
  /**
   * 微信 支付 格式 数组 转 xml
   *
   * @param $arr
   *
   * @return string
   */
  function wechatPayArrayToXml ($arr)
  
  
  /**
   * array to xml
   * @param $data
   * @param bool $root
   * @return string
   */
  function arrayToXml($data, $root = true)
  
  
  /**
   * Xml to Array
   * @param $xml
   * @return mixed
   */
  function xmlToArray($xml)
  
  

```

### Configuration

### Usage
```
https://packagist.org/packages/szmz/phpmethodextension
```

### License

Licensed under [The MIT License (MIT)](LICENSE).
