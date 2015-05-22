<?php 
class ConstantController extends BaseController {

	public function get() {
		if (!Util::validate(Input::all(),array(
                'id' => 'required'
            ))) {
            return Util::response_error_msg('7000');
        }

        return Response::json(array(
            'status' => 'success',
            'data' => ConstantStringService::get(Input::get('id'))
        ));
	}
}