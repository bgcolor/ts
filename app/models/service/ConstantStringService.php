<?php 
class ConstantStringService {
    
    public function get($key) {
        $value = Constant::whereRaw('key = ?',array($key))->first()->value;
        return $value ? $value : '';
    }
}