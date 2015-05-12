<?php 
class UploadController extends BaseController {
  
  public function upload() {
    if ( Input::hasFile( 'userfile' ) ) {
        $file = Input::file('userfile');
        $path;
        try {
            $path = UploadService::upload_single_file();
        } catch (Exception $e) {
            return Response::json(array(
                'status' => 'fail',
                'errorCode' => '2001',
                'message' => StatusInfoService::get_description('2001');
            ));
        }

        if ($path) {
            return Response::json(array(
                'status' => 'success',
                'data' => $path,
                'message' => StatusInfoService::get_description('2002');
            ));
        } else {
            return Response::json(array(
                'status' => 'fail',
                'errorCode' => '503',
                'message' => StatusInfoService::get_description('503');
            ));
        }
        
    }
  }
}