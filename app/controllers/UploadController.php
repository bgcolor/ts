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
            return Util::response_error_msg($e->getMessage());
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
            return Util::response_error_msg($e->getMessage());
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

  public function delete() {
    $res = false;
    try {
        $res = UploadService::delete(Input::all());
    } catch (Exception $e) {
        echo $e->getMessage();
        return Util::response_error_msg('2006');
    }

    if ($res === true) {
       return Response::json(array(
            'status' => 'success',
            'message' => StatusInfoService::get_description('2007')
        )); 
    } else {
        return Util::response_error_msg('503');
    }
  }
  
}