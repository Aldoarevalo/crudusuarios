<?php
    function getUUID(){
        $data    = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function getFechaHora(){
        $result = date("YmdHis");
        return $result;
    }

    function getCaptcha($var00){
        $captchaJSON = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Le-8qUZAAAAALXfUJSV8d1EK7P_dZGzETESkH-j&response='.$var00);
        
        $result = json_decode($captchaJSON, true);
        return $result;
    }
?>