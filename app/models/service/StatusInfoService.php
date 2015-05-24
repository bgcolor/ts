<?php 
class StatusInfoService extends Service {

    public static function get_description($key) {
        if (Session::has($key)) {
           return Session::get($key); 
        }
        $desp = StatusInfo::WhereRaw('status_code = ?',array($key))->first();
        return $desp ? $desp->description : '';
    }
}