<?php 
class ConstantStringService extends Service {
    
    public static function get($id) {
        if (Session::has($id)) {
            return Session::get($id);
        }
        $value = ConstantString::find($id)->value;
        return $value ? $value : '';
    }
}