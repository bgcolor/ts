<?php 
class DownloadController extends BaseController {

    public function download_only() {
        $res = false;
        try {
            return $res = DownloadService::download_only(Input::all());
        } catch (Exception $e) {
            return Util::response_error_msg('503');
        }

        return $res;
    }

    public function download_and_process() {
        try {
            return DownloadService::download_and_process(Input::all());
        } catch (Exception $e) {
            return Util::response_error_msg($e->getMessage());
        }
    }
}