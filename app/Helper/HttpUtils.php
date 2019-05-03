<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 2018/6/20
 * Time: 15:36
 */


function post($url, $headers, $params)
{
    $data = json_encode($params);

    $curl = curl_init();

    array_push($headers, "Content-Type: application/json");
    array_push($headers, "Content-Length: " . strlen($data));

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    // print_r("=========请求信息 start =========\n");
    // print_r($url . "\n");
    // print_r(json_encode($headers) . "\n");
    // print_r($data  . "\n");
    $response = curl_exec($curl);
    curl_close($curl);
    // print_r("==============================\n");
    // print_r($response);
    // print_r("\n=========请求信息 end =========\n");
    return $response;
}

function form($url, $headers, $params)
{
    $data = "";
    foreach ($params as $k => $v) {
        $data .= "$k=" . urlencode($v) . "&";
    }
    $data = substr($data, 0, -1);

    $curl = curl_init();

    array_push($headers, "Content-Type: application/x-www-form-urlencoded");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    // print_r("=========请求信息 start =========\n");
    // print_r($url . "\n");
    // print_r(json_encode($headers) . "\n");
    // print_r($data  . "\n");
    $response = curl_exec($curl);
    curl_close($curl);
    // print_r("==============================\n");
    // print_r($response);
    // print_r("\n=========请求信息 end =========\n");
    return $response;
}

function get($url, $headers)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    print_r("=========请求信息 start =========\n");
    print_r($url . "\n");
    print_r($headers);
    $response = curl_exec($curl);
    curl_close($curl);
    print_r("==============================\n");
    print_r($response);
    print_r("\n=========请求信息 end =========\n");
    return $response;
}