<?php
/**
 * @author      dawn
 * @since       2018/12/5 16:10
 */

namespace fit\curl;


class Curl
{
    /**
     * get请求
     * @param string $url 完整链接
     * @param array $headers 请求头
     * @param int $connectTimeout 连接超时
     * @param int $timeout 执行超时
     * @return mixed
     */
    public static function get(string $url, array $headers = [], int $connectTimeout=-1, int $timeout=-1)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($connectTimeout != -1){
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
        }
        if($timeout != -1){
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        }

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * post请求
     * @param string $url 完整链接
     * @param array $data 参数
     * @param array $headers 请求头
     * @param int $connectTimeout 连接超时
     * @param int $timeout 执行超时
     * @return mixed
     */
    public static function post(string $url, array $data, array $headers = [], int $connectTimeout=-1, int $timeout=-1)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($connectTimeout != -1){
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
        }
        if($timeout != -1){
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        }

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}