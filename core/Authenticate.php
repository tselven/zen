<?php

namespace Core;

class Authenticate
{
    public function filter(){
        if (!empty($_ENV['BLOCK_LIST']['ip']) || !empty($_ENV['BLOCK_LIST']['port']) || !empty($_ENV['BLOCK_LIST']['host'])) {
            //var_dump($_ENV['BLOCK_LIST']);
            return false;
            
        } else {
            return true;
        }
    }
    /**
     * @param string $username - username
     * @param string $password - password
     * @return $auth - boolean
     */
    protected function login($username, $password)
    {
    }

    protected static function logout()
    {

    }
    function generateOTP($length = 6)
    {
        $digits = '0123456789';
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $digits[rand(0, strlen($digits) - 1)];
        }
        return $otp;
    }
    /**
     * @param string $mail - mail address
     * @return void sendOTP - send OTP message too user
     */
    public function sendOTP($mail)
    {
        $otp = $this->generateOTP();
        $to_email = $mail;
        $subject = "OTP sent";
        $body = "<h1>Your OTP is : {$otp}</h1>";

        // Email headers
        $headers = "From: admin@example.com\r\n";
        $headers .= "Reply-To: sender@example.com\r\n";
        $headers .= "Content-type: text/html\r\n";
        // Additional SMTP headers
        $additional_headers = array(
            'Host' => $_ENV['SMTP_HOST'],
            'Port' => $_ENV['SMTP_PORT'],
            'Auth' => 'true',
            'Username' => $_ENV['SMTP_USER'],
            'Password' => trim($_ENV['SMTP_PASS'],'"'),
            'Connection' => $_ENV['SMTP_CON'] //'tsl' or 'ssl' for SSL connection
        );
        echo $additional_headers['Password'];
        // Format additional headers
        $smtp_headers = '';
        foreach ($additional_headers as $key => $value) {
            $smtp_headers .= "{$key}: {$value}\r\n";
        }
        // Sending email
        if (filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
            if (mail($to_email, $subject, $body, $headers,$smtp_headers)) {
                echo "Email sent successfully with OTP: " . $otp;
            } else {
                echo "Failed to send email.";
            }
        } else {
            echo "Invalid email address.";
        }
    }

    /**
     * @param string $user - username
     * @param string $otp - OTP code 
     */
    protected function verifyOTP($user, $otp)
    {
    }
}
