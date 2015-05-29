<?php 
class ProjectController extends BaseController {

    public function create() {
        $res = false;
        try {
            $res = ProjectService::create(Input::all());
        } catch (Exception $e) {
             return Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('3001')
            ));
        } else {
            return Util::response_error_msg('503');
        }
    }

    public function update() {
        $res = false;
        try {
            $res = ProjectService::update(Input::all());
        } catch (Exception $e) {
             return Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('3004')
            ));
        } else {
            return Util::response_error_msg('503');
        }
    }

    public function delete() {
        $res = false;
        try {
            $res = ProjectService::delete(Input::all());
        } catch (Exception $e) {
             return Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('3006')
            ));
        } else {
            return Util::response_error_msg('503');
        }
    }
}