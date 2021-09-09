<?php


if (!function_exists('listDirFiles')) {
    /**
     * 安全过滤函数
     *
     * @param $string
     *
     * @return string
     */
    function listDirFiles($DirPath){
        if($dir = opendir($DirPath)){
            while(($file = readdir($dir))!== false){
                if(!is_dir($DirPath.$file))
                {
                    echo "filename: $file<br />";
                }
            }
        }
    }
}


if (!function_exists('download')) {
    /**
     * 强制下载文件
     *
     * @param $string
     *
     * @return string
     */
    function download($filename){
        if ((isset($filename))&&(file_exists($filename))){
            header("Content-length: ".filesize($filename));
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            readfile("$filename");
        } else {
            echo "Looks like file does not exist!";
        }
    }
}



