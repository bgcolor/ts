<?php 
error_reporting(0);
class UploadController extends BaseController {
  
  public function upload_only() {
    if ( Input::hasFile( 'userfile' ) ) {
        $file = Input::file('userfile');
        $pathname;
        try {
            $pathname = UploadService::upload_only($file);
        } catch (Exception $e) {
            return Response::json(array(
                'status' => 'fail',
                'errorCode' => '2001',
                'message' => StatusInfoService::get_description('2001')
            ));
        }

        if ($pathname) {
            return Response::json(array(
                'status' => 'success',
                'data' => $pathname,
                'message' => StatusInfoService::get_description('2002')
            ));
        } else {
            return Util::response_error_msg('503');
        }    
    }

    return Util::response_error_msg('2003');
  }

  public function upload_and_process() {
    if ( Input::hasFile( 'userfile' ) ) {
        $file = Input::file('userfile');

        $res = false;
        try {
            $res = UploadService::upload_and_process($file, Input::except('userfile'));
        } catch (Exception $e) {
            Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
           return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('2002')
            )); 
        } else {
            return Util::response_error_msg('503');
        }
    }

    return Util::response_error_msg('2003');
  }
}