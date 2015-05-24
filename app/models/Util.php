<?php 
class Util {
    //'1' to '0001',(bit = 4)
    public static function format_bit_str( $str, $bit = 4 ) {
        $len = strlen( $str );

        if ( $len < $bit ) {
            $pre = '';
            for ( $i = 0;$i < $bit - $len;$i++ ) {
                $pre .= '0';
            }
            return $pre.$str;
        } else {
            return substr( $str, $len - 4 );
        }
    }

    public static function has_auth($name, $type, $value) {
        //check if session exists.
        if (!Session::has($name)) {
            return false;
        }

        return self::format_bit_str(decbin(Session::get($name)))[$type] == $value ? true : false;
    }

    public static function has_auths($name,$value) {
        //check if session exists.
        if (!Session::has($name)) {
            return false;
        }

        return Session::get($name) == $value ? true : false;
    }

    public static function has_module_auth($name) {
        if (!Session::has($name)) return false;
        return Session::get($name) > 0 ? true : false;
    }

    //simplify validate.
    public static function validate($data, $case) {
        $validator = Validator::make($data,$case);
        return $validator->fails() ? false : true;
    }

    //check there is not ' " and white space in the str.
    public static function has_unsafe_str($str) {
        return preg_match('/[\'\"\ ]/',$str);
    }

    //generate file name with suffix <- 后缀
    public static function gen_file_name($suffix) {
        if (!is_string($suffix))  return false;
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro,$t) );
        $date_str = $d->format('ymdHisu');
        return $date_str.$suffix;
    }

    public static $pagination = 10;

    public static $previewCount = 5;

    public static function response_error_msg($msg){
        $desp = StatusInfoService::get_description($msg);
        if ($desp) {
            return Response::json(array(
                'status' => 'fail',
                'errorCode' => $msg,
                'message' => $desp
            ));
        } else {
            echo $msg;
        }
    }

    public static $localCharset = 'gb18030';

}