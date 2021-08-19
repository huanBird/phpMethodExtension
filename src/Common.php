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