<?php 
class EvaluationController extends BaseController {

	public function create() {
		$res = false;
		try {
			$res = EvaluationService::create(Input::all());
		} catch (Exception $e) {
			Util::response_error_msg($e->getMessage());
		}

		if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('4002')
            ));
        } else {
            return Util::response_error_msg('503');
        }
	}
}