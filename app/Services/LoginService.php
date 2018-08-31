<?php
namespace App\Services;


class LoginService
{

    
    /**
     * EmailService constructor.
     * @param Mailer $mail
     */
    public function __construct()
    {

    }

    /**
     *  登入功能
     */
    public function login($request)
    {
        $data = array(
            "phone" => $request['phone'],
            "passwd" => $request['passwd'],
            "fbid" => $request['fbid'],
            "port" => $request['port'],
            "lang" => "zh"
        ); 
        $data_string = json_encode($data);

        $ch = curl_init(config('app.tripmatch_auth_url'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',              
            'Content-Length: ' . strlen($data_string))
        ); 
        $result = json_decode(curl_exec($ch),TRUE);
        return $result;
    }
}