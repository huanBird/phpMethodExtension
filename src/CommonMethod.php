<?php


if (!function_exists('formatBankCardNo')) {

    /**
     * 银行卡卡号掩码 默认前四位 后四位
     * @param $bankCardNo
     * @param int $fistNum
     * @param int $backNum
     * @return string
     */
    function formatBankCardNo($bankCardNo,$fistNum = 4,$backNum = 4){
        //截取银行卡号前4位
        $prefix = substr($bankCardNo,0,$fistNum);
        //截取银行卡号后4位
        $suffix = substr($bankCardNo,'-'.$backNum,$backNum);
        $maskBankCardNo = $prefix." **** **** **** ".$suffix;
        return $maskBankCardNo;
    }
}


if (!function_exists('timeTran')){
    /*------------------------------------------------------ */
// * 时间转换计算
// * @param$show_time 需要转换的时间戳
// * @return string          转换后的时间
    /*------------------------------------------------------ */
    function timeTran($show_time) {
        $dur = time() - $show_time;
        if ($dur < 0) {
            return '刚刚';
        }
        if ($dur < 60) {
            return $dur . '秒前';
        }
        if ($dur < 3600) {
            return floor($dur / 60) . '分钟前';
        }
        if ($dur < 86400) {
            return floor($dur / 3600) . '小时前';
        }
        if ($dur < 259200) {//3天内
            return floor($dur / 86400) . '天前';
        }
        return date("Y-m-d", $show_time);
    }
}



if (!function_exists('random_str')){
    /*------------------------------------------------------ */
// * 生成指定长度的随机字符串(包含大写英文字母, 小写英文字母, 数字)
// * @param int $length 需要生成的字符串的长度
// * @return string 包含 大小写英文字母 和 数字 的随机字符串
    /*------------------------------------------------------ */
    function random_str($length,$isupper = false){
        //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
        $arr = $isupper ? array_merge(range('A','H'),range('J','M'),range('P','Z'),range(0,9)) : array_merge(range('A', 'Z'),range(0, 9), range('a', 'z'));
        $str = '';
        $arr_len = count($arr);
        for ($i = 0; $i < $length; $i++){
            $rand = mt_rand(0, $arr_len-1);
            $str.=$arr[$rand];
        }
        return $str;
    }
}


if (!function_exists('getSubstr')){

    /*------------------------------------------------------ */
// *   实现中文字串截取无乱码的方法
// *  @param $string 待截取的字符串
// *  @param $start   开始截取位置
// *  @param $length 截取长度
// *  @return  $string  截取后的字符串
    /*------------------------------------------------------ */
    function getSubstr($string, $start, $length) {
        if(mb_strlen($string,'utf-8')>$length){
            $str = mb_substr($string, $start, $length,'utf-8');
            return $str.'...';
        }else{
            return $string;
        }
    }
}


if (!function_exists('checkMobile')){
    /*------------------------------------------------------ */
// *   验证手机号码
// *  @param $phone 手机号码
// *  @return  bool
    /*------------------------------------------------------ */
    function checkMobile($phone = ''){
        $preg_phone='/^1\d{10}$/ims';
        if(preg_match($preg_phone,$phone)){
            return true;
        }
        return false;

    }
}


if (!function_exists('repEmoji')){

    /*------------------------------------------------------ */
//-- 过滤掉emoji表情
    /*------------------------------------------------------ */
    function repEmoji($str){
        $str = preg_replace_callback( '/./u',function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        },$str);
        return $str;
    }
}


if (!function_exists('priceFormat')){

    /*------------------------------------------------------ */
//-- 格式化价格
//-- @access  public
//-- @param   float   $price  价格
//-- @return  string
    /*------------------------------------------------------ */
    function priceFormat($price,$show_yuan = false,$type=0){
        switch ($type){
            case 0:
                $price = number_format($price, 2, '.', '');
                break;
            case 1: // 保留不为 0 的尾数
                $price = preg_replace('/(.*)(\\.)([0-9]*?)0+$/', '\1\2\3', number_format($price, 2, '.', ''));
                if (substr($price, -1) == '.') $price = substr($price, 0, -1);
                break;
            case 2: // 不四舍五入，保留1位
                $price = substr(number_format($price, 2, '.', ''), 0, -1);
                break;
            case 3: // 直接取整
                $price = intval($price);
                break;
            case 4: // 四舍五入，保留 1 位
                $price = number_format($price, 1, '.', '');
                break;
            case 5: // 先四舍五入，不保留小数
                $price = round($price);
                break;
        }

        if($show_yuan == false) return sprintf("%s", $price);
        else return sprintf("￥%s元", $price);
    }
    // 简易UUID生成方法(非严谨版)
    function uuid() {
        $charid = md5(uniqid(mt_rand(), true));
        $hyphen = chr(45);
        $uuid = chr(123)
               .substr($charid, 0, 8).$hyphen
               .substr($charid, 8, 4).$hyphen
               .substr($charid,12, 4).$hyphen
               .substr($charid,16, 4).$hyphen
               .substr($charid,20,12)
               .chr(125);
        return $uuid;
    }
}



