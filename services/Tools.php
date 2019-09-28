<?php


namespace app\services;



use yii\base\BaseObject;

class Tools extends BaseObject
{
    /**
     * 获取IP
     * @return ip
     */
    public static function getRealIp()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_CDN_SRC_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CDN_SRC_IP']))
        {
            $ip = $_SERVER['HTTP_CDN_SRC_IP'];
        }
        elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP']))
        {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches))
        {
            foreach ($matches[0] AS $xip)
            {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip))
                {
                    $ip = $xip;
                    break;
                }
            }
        }
        return $ip;
    }
}