<?php 
class AuthService {

    public static function find($id) {
        $role = Session::get('role');
        $auth = Authority::whereRaw('id = ? and role = ?',array($id, $role))->first();
        return $auth ? true : false;
    }

    public static function compose_variable($arr) {
        $role = Session::get('role');
        $res = array();
        foreach ($arr as $index) {
            $res[$index] = AuthService::find($index, $role);
        }
    }
}