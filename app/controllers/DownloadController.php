<?php 
class DownloadController extends BaseController {

    public function download() {
        if ( !Util::validate(
                Input::all(),
                array(
                    'pathname' => 'required'
                )
            ) ) {
            return Response::json( array(
                'status' => 'fail', 
                'errorCode' => '6000',
                'message' =>  StatusInfo::get_description('6000');
            ));
        }
        return Response::download('uploads/'.Input::get('pathname'));
    }
}