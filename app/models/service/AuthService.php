<?php 
class AuthService extends Service {

    public static function find($id) {
        $role = Session::get('role');
        
        if (Session::has($id.'-'.$role)) {
            return true;
        }

        $auth = Authority::whereRaw('id = ? and role = ?',array($id, $role))->first();
        return $auth ? true : false;
    }

    public static function find2($id,$role) {
        if (Session::has($id.'-'.$role)) {
            return true;
        }

        $auth = Authority::whereRaw('id = ? and role = ?',array($id, $role))->first();
        return $auth ? true : false;
    }

    public static function compose_variable($arr) {
        $role = Session::get('role');
        $res = array();
        foreach ($arr as $index) {
            $res[$index] = AuthService::find($index, $role) ? true : false;
        }
        return $res;
    }
}