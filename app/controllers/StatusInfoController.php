<?php 
class StatusInfoController extends BaseController {

    public function get() {
        if (!Util::validate(Input::all(),array(
                'status_code' => 'required'
            ))) {
            return Util::response_error_msg('7000');
        }

        return Response::json(array(
            'status' => 'success',
            'data' => StatusInfoService::get_description(Input::get('status_code'))
        ));
    }

}