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
     * @param int $type
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


if (!function_exists('new_html_special_chars')) {
    /**
     * 返回经htmlspecialchars处理过的字符串或数组
     * @param $obj 需要处理的字符串或数组
     * @return mixed
     */
    function new_html_special_chars($string)
    {
        $encoding = 'utf-8';
        if (strtolower(CHARSET) == 'gbk') $encoding = 'ISO-8859-15';
        if (!is_array($string)) return htmlspecialchars($string, ENT_QUOTES, $encoding);
        foreach ($string as $key => $val) $string[$key] = new_html_special_chars($val);
        return $string;
    }
}


if (!function_exists('safe_replace')) {

    /**
     * 安全过滤函数
     *
     * @param $string
     * @return string
     */
    function safe_replace($string)
    {
        $string = str_replace('%20', '', $string);
        $string = str_replace('%27', '', $string);
        $string = str_replace('%2527', '', $string);
        $string = str_replace('*', '', $string);
        $string = str_replace('"', '&quot;', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace('"', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('<', '&lt;', $string);
        $string = str_replace('>', '&gt;', $string);
        $string = str_replace("{", '', $string);
        $string = str_replace('}', '', $string);
        $string = str_replace('\\', '', $string);
        return $string;
    }
}

if (!function_exists('remove_xss')) {
    /**
     * xss过滤函数
     *
     * @param $string
     * @return string
     */
    function remove_xss($string)
    {
        $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

        $parm1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

        $parm2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

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

if (!function_exists('trim_unsafe_control_chars')) {
    /**
     * 过滤ASCII码从0-28的控制字符
     * @return String
     */
    function trim_unsafe_control_chars($str)
    {
        $rule = '/[' . chr(1) . '-' . chr(8) . chr(11) . '-' . chr(12) . chr(14) . '-' . chr(31) . ']*/';
        return str_replace(chr(0), '', preg_replace($rule, '', $str));
    }
}

if (!function_exists('trim_textarea')) {
    /**
     * 格式化文本域内容
     *
     * @param $string 文本域内容
     * @return string
     */
    function trim_textarea($string)
    {
        $string = nl2br(str_replace(' ', '&nbsp;', $string));
        return $string;
    }
}

if (!function_exists('format_js')) {
    /**
     * 将文本格式成适合js输出的字符串
     * @param string $string 需要处理的字符串
     * @param intval $isjs 是否执行字符串格式化，默认为执行
     * @return string 处理后的字符串
     */
    function format_js($string, $isjs = 1)
    {
        $string = addslashes(str_replace(array("\r", "\n", "\t"), array('', '', ''), $string));
        return $isjs ? 'document.write("' . $string . '");' : $string;
    }
}

if (!function_exists('trim_script')) {
    /**
     * 转义 javascript 代码标记
     *
     * @param $str
     * @return mixed
     */
    function trim_script($str)
    {
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = trim_script($val);
            }
        } else {
            $str = preg_replace('/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $str);
            $str = preg_replace('/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $str);
            $str = preg_replace('/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $str);
            $str = str_replace('javascript:', 'javascript：', $str);
        }
        return $str;
    }
}


if (!function_exists('ip')) {
    /**
     * 获取请求ip
     *
     * @return ip地址
     */
    function ip()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
    }

}


if (!function_exists('sizecount')) {
    /**
     * 转换字节数为其他单位
     *
     *
     * @param string $filesize 字节大小
     * @return    string    返回大小
     */
    function sizecount($filesize)
    {
        if ($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
        } elseif ($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
        } elseif ($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
        } else {
            $filesize = $filesize . ' Bytes';
        }
        return $filesize;
    }
}


if (!function_exists('fileext')) {
    /**
     * 取得文件扩展
     *
     * @param $filename 文件名
     * @return 扩展名
     */
    function fileext($filename)
    {
        return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
    }
}


if (!function_exists('yc_phone')) {
    /**
     * 隐藏手机号中间四位
     * @param $str
     * @return string|string[]
     */
    function yc_phone($str)
    {
        $resstr = substr_replace($str, '****', 3, 4);
        return $resstr;
    }
}

if (!function_exists('checkIdNum')) {

    /**
     * 检查身份证是否正确
     * @param $num_id
     * @return bool
     */
    function checkIdNum($num_id)
    {
        $num_id = strtoupper($num_id);
        $regx = "/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/";
        $arr_split = array();
        if (!preg_match($regx, $num_id)) {
            return FALSE;//正则校验
        }
        if (15 == strlen($num_id)) //检查15位
        {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
            @preg_match($regx, $num_id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else      //检查18位
        {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $num_id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) //检查生日日期是否正确
            {
                return FALSE;
            } else {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int)$num_id{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($num_id, 17, 1)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
    }
}

if (!function_exists('is_wechat_open')) {
    /**
     * 判断是不是微信登陆
     * @return array
     */
    function is_wechat_open()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false) {
            // 非微信浏览器禁止浏览
            //echo "HTTP/1.1 401 Unauthorized";
            //return '未知浏览器';
            return ['version' => 0, 'status' => 0];
        } else {
            // 微信浏览器，允许访问
            // 获取版本号
            preg_match('/.*?(MicroMessenger\/([0-9.]+))\s*/', $user_agent, $matches);
            return ['version' => '微信Version:' . $matches[2], 'status' => 1];
        }
    }
}

if (!function_exists('random_str')) {
    /**
     * 生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
     * @param $length
     * @return string
     */
    function random_str($length)
    {

        $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        $str = '';
        $arr_len = count($arr);
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $arr_len - 1);
            $str .= $arr[$rand];
        }
        return $str;
    }
}

if (!function_exists('api_show')) {
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
    {

        $jsondata = [
            'status' => $status,
            'msg' => $message,
            'data' => $data,
        ];
        return json_encode($jsondata, $httpCode);
    }
}


if (!function_exists('isMobile')) {
    /**
     * 判断当前访问的用户是  PC端  还是 手机端  返回true 为手机端  false 为PC 端
     * @return bool
     */
    function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
            return true;

        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
                return true;
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }
}








