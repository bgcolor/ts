<?php 
class StatusInfoService {

    public static function get_description($key) {
        $desp = StatusInfo::WhereRaw('status_code = ?',array($key))->first();
        return $desp ? $desp->description : '';
    }
}