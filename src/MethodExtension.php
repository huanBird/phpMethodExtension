<?php
namespace szmz\phpmethodextension;


class MethodExtension
{
    public function getMd5Sha1($str)
    {
        return md5(sha1($str));
    }
}