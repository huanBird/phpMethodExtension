<?php

if (!function_exists('formatBankCardNo')) {
    /**
     * 银行卡卡号掩码 默认前四位 后四位
     *
     * @param     $bankCardNo
     * @param int $fistNum
     * @param int $backNum
     *
     * @return string
     */
    function formatBankCardNo($bankCardNo, $fistNum = 4, $backNum = 4)
    {
        //截取银行卡号前4位
        $prefix = substr($bankCardNo, 0, $fistNum);
        //截取银行卡号后4位
        $suffix = substr($bankCardNo, '-' . $backNum, $backNum);

        return $prefix . " **** **** **** " . $suffix;
    }
}

if (!function_exists('timeTran')) {
    /**
     * 时间转换计算
     *
     * @param $showTime 需要转换的时间戳
     *
     * @return false|string
     */
    function timeTran($showTime)
    {
        $dur = time() - $showTime;

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
        if ($dur < 259200) { // 3天内
            return floor($dur / 86400) . '天前';
        }

        return date("Y-m-d", $showTime);
    }
}

if (!function_exists('random_str')) {
    /**
     * 生成指定长度的随机字符串(包含大写英文字母, 小写英文字母, 数字)
     *
     * @param      $length 需要生成的字符串的长度
     * @param bool $isupper
     *
     * @return string 包含 大小写英文字母 和 数字 的随机字符串
     */
    function random_str($length, $isupper = false)
    {
        //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
        $arr = $isupper ? array_merge(range('A', 'H'), range('J', 'M'), range('P', 'Z'), range(0, 9)) : array_merge(range('A', 'Z'), range(0, 9), range('a', 'z'));
        $str = '';
        $arr_len = count($arr);
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $arr_len - 1);
            $str .= $arr[$rand];
        }

        return $str;
    }
}

if (!function_exists('getSubstr')) {
    /**
     * 实现中文字串截取无乱码的方法
     *
     * @param $string 待截取的字符串
     * @param $start  开始截取位置
     * @param $length 截取长度
     *
     * @return string
     */
    function getSubstr($string, $start, $length)
    {
        if (mb_strlen($string, 'utf-8') > $length) {
            $str = mb_substr($string, (int)$start, $length, 'utf-8');
            return $str . '...';
        } else {
            return $string;
        }
    }
}

if (!function_exists('checkMobile')) {
    /**
     * 验证手机号码
     *
     * @param string $phone
     *
     * @return bool
     */
    function checkMobile($phone = '')
    {
        $preg_phone = '/^1\d{10}$/ims';
        if (preg_match($preg_phone, $phone)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('repEmoji')) {
    /**
     * 过滤掉emoji表情
     *
     * @param $str
     *
     * @return string|string[]|null
     */
    function repEmoji($str)
    {
        $str = preg_replace_callback('/./u', function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        }, $str);

        return $str;
    }
}

if (!function_exists('priceFormat')) {
    /**
     * 格式化价格
     *
     * @param      $price
     * @param bool $showYuan
     * @param int  $type
     *
     * @return string
     */
    function priceFormat($price, $showYuan = false, $type = 0)
    {
        switch ($type) {
            case 0:
                $price = number_format($price, 2, '.', '');
                break;
            case 1: // 保留不为 0 的尾数
                $price = preg_replace('/(.*)(\\.)([0-9]*?)0+$/', '\1\2\3', number_format($price, 2, '.', ''));
                if (substr($price, -1) == '.') {
                    $price = substr($price, 0, -1);
                }
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

        if ($showYuan == false) {
            return sprintf("%s", $price);
        } else {
            return sprintf("￥%s元", $price);
        }
    }
}

if (!function_exists('uuid')) {
    /**
     * 简易UUID生成方法
     *
     * @return string
     */
    function uuid()
    {
        $charId = md5(uniqid(mt_rand(), true));
        $hyphen = chr(45);
        return chr(123)
            . substr($charId, 0, 8) . $hyphen
            . substr($charId, 8, 4) . $hyphen
            . substr($charId, 12, 4) . $hyphen
            . substr($charId, 16, 4) . $hyphen
            . substr($charId, 20, 12)
            . chr(125);
    }
}


if (!function_exists('new_html_special_chars')){
    /**
     * 返回经htmlspecialchars处理过的字符串或数组
     * @param $obj 需要处理的字符串或数组
     * @return mixed
     */
    function new_html_special_chars($string) {
        $encoding = 'utf-8';
        if(strtolower(CHARSET)=='gbk') $encoding = 'ISO-8859-15';
        if(!is_array($string)) return htmlspecialchars($string,ENT_QUOTES,$encoding);
        foreach($string as $key => $val) $string[$key] = new_html_special_chars($val);
        return $string;
    }
}


if (!function_exists('safe_replace')){

    /**
     * 安全过滤函数
     *
     * @param $string
     * @return string
     */
    function safe_replace($string) {
        $string = str_replace('%20','',$string);
        $string = str_replace('%27','',$string);
        $string = str_replace('%2527','',$string);
        $string = str_replace('*','',$string);
        $string = str_replace('"','&quot;',$string);
        $string = str_replace("'",'',$string);
        $string = str_replace('"','',$string);
        $string = str_replace(';','',$string);
        $string = str_replace('<','&lt;',$string);
        $string = str_replace('>','&gt;',$string);
        $string = str_replace("{",'',$string);
        $string = str_replace('}','',$string);
        $string = str_replace('\\','',$string);
        return $string;
    }
}

if (!function_exists('remove_xss')){
    /**
     * xss过滤函数
     *
     * @param $string
     * @return string
     */
    function remove_xss($string) {
        $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

        $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

        $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

        $parm = array_merge($parm1, $parm2);

        for ($i = 0; $i < sizeof($parm); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($parm[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[x|X]0([9][a][b]);?)?';
                    $pattern .= '|(&#0([9][10][13]);?)?';
                    $pattern .= ')?';
                }
                $pattern .= $parm[$i][$j];
            }
            $pattern .= '/i';
            $string = preg_replace($pattern, ' ', $string);
        }
        return $string;
    }
}

if (!function_exists('trim_unsafe_control_chars')){
    /**
     * 过滤ASCII码从0-28的控制字符
     * @return String
     */
    function trim_unsafe_control_chars($str) {
        $rule = '/[' . chr ( 1 ) . '-' . chr ( 8 ) . chr ( 11 ) . '-' . chr ( 12 ) . chr ( 14 ) . '-' . chr ( 31 ) . ']*/';
        return str_replace ( chr ( 0 ), '', preg_replace ( $rule, '', $str ) );
    }
}

if (!function_exists('trim_textarea')){
    /**
     * 格式化文本域内容
     *
     * @param $string 文本域内容
     * @return string
     */
    function trim_textarea($string) {
        $string = nl2br ( str_replace ( ' ', '&nbsp;', $string ) );
        return $string;
    }
}

if (!function_exists('format_js')){
    /**
     * 将文本格式成适合js输出的字符串
     * @param string $string 需要处理的字符串
     * @param intval $isjs 是否执行字符串格式化，默认为执行
     * @return string 处理后的字符串
     */
    function format_js($string, $isjs = 1) {
        $string = addslashes(str_replace(array("\r", "\n", "\t"), array('', '', ''), $string));
        return $isjs ? 'document.write("'.$string.'");' : $string;
    }
}

if (!function_exists('trim_script')){
    /**
     * 转义 javascript 代码标记
     *
     * @param $str
     * @return mixed
     */
    function trim_script($str) {
        if(is_array($str)){
            foreach ($str as $key => $val){
                $str[$key] = trim_script($val);
            }
        }else{
            $str = preg_replace ( '/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $str );
            $str = preg_replace ( '/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $str );
            $str = preg_replace ( '/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $str );
            $str = str_replace ( 'javascript:', 'javascript：', $str );
        }
        return $str;
    }
}


if (!function_exists('ip')){
    /**
     * 获取请求ip
     *
     * @return ip地址
     */
    function ip() {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    }

}



if (!function_exists('sizecount')){
    /**
     * 转换字节数为其他单位
     *
     *
     * @param    string    $filesize    字节大小
     * @return    string    返回大小
     */
    function sizecount($filesize) {
        if ($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 .' GB';
        } elseif ($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 .' MB';
        } elseif($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
        } else {
            $filesize = $filesize.' Bytes';
        }
        return $filesize;
    }
}


if (!function_exists('fileext')){
    /**
     * 取得文件扩展
     *
     * @param $filename 文件名
     * @return 扩展名
     */
    function fileext($filename) {
        return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
    }
}



