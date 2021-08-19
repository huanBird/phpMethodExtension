<?php
namespace szmz\phpmethodextension;


class MethodExtension
{
    public function getMd5Sha1($str)
    {
        return md5(sha1($str));
    }


    public function trimLen($str)
    {
        return strlen(trim($str));
    }

    /**
     * 银行卡卡号掩码 默认前四位 后四位
     * @param $bankCardNo
     * @param int $fistNum
     * @param int $backNum
     * @return string
     */
    public function formatBankCardNo($bankCardNo,$fistNum = 4,$backNum = 4){
        //截取银行卡号前4位
        $prefix = substr($bankCardNo,0,$fistNum);
        //截取银行卡号后4位
        $suffix = substr($bankCardNo,'-'.$backNum,$backNum);
        $maskBankCardNo = $prefix." **** **** **** ".$suffix;
        return $maskBankCardNo;
    }
}