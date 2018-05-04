<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_model extends CI_Model {

    public function sendSMS($nohp, $msg) {
        $request = 'username=username &pass = 123456&senderid = Usersenderid &dest_mobileno = ' . $nohp . '&message=' . $msg . '&response=Y';
        $ch = curl_init('www.smsjust.com/blank/sms/user/urlsms.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        $resuponce = curl_exec($ch);
        curl_close($ch);
        return $resuponce;
    }

    function smssend($nohp, $message) {
        $no = $nohp;
        $msg = $message; //"ID Pesanan : $invoiceID, jangan lupa transfer ya.. (by agussaputra.com)";
        $url = "https://reguler.zenziva.net/apps/smsapi.php";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey=' . $userkey . '&passkey=' . $passkey . '&nohp=' . $cellPhone . '&pesan=' . urlencode($message));
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);
    }

    function cekSisaSMS() {
        $userkey = "USER_KEY_ANDA";
        $passkey = "PASS_KEY_ANDA";
        $url = "https://reguler.zenziva.net/apps/smsapibalance.php";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey=' . $userkey . '&passkey=' . $passkey);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);
    }

    function stripslashes_deep($value) {
        $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);
        return $value;
    }
    
    function kirimSMS($number, $message_body, $return = '0') {
    $sender = 'SEDEMO'; // Need to change
    $smsGatewayUrl = 'http://springedge.com';
    $apikey = '62q3z3hs4941mve32s9kf10fa5074n7'; // Need to change
    $textmessage = urlencode($message_body);
    $api_element = '/api/web/send/';
    $api_params = $api_element . '?apikey=' . $apikey . '&sender=' . $sender . '&to=' . $number . '&message=' . $textmessage;
    $smsgatewaydata = $smsGatewayUrl . $api_params;
    $url = $smsgatewaydata;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    if (!$output) {
        $output = file_get_contents($smsgatewaydata);
    }
    if ($return == '1') {
        return $output;
    } else {
        echo "Sent";
    }
}

}

?>
