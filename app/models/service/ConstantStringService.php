<?php 
class ConstantStringService extends Service {
    
    public static function get($id) {
        $value = ConstantString::find($id)->value;
        return $value ? $value : '';
    }
}