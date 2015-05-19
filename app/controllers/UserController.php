<?php 
class UserController extends BaseController {

    public function loginView() {
        if (UserService::check()) return Redirect::to('/');
        $page_variable = array(
            'login_title' => ConstantStringService::get('login_title'),
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );
        return View::make('login',$page_variable);
    }

    public function update() {
        $res = false;
        try {
            $res = UserService::update(Input::all());
        } catch (Exception $e) {
            return Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('1011')
            ));
        } else {
            return Util::response_error_msg('503');
        }
    }

    /**
     * login user.
     * @return json give a message if fail
     */
    public function login() {
        $res = false;
        try {
            $res = UserService::login(Input::all());
        } catch (Exception $e) {
            return Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('1008')
            ));
        } else {
            return Util::response_error_msg('503');
        }
    }

    /**
     * logout user.
     * @return none
     */
    public function logout() {
        UserService::logout();
        return Redirect::to('/');
    }

    public function create() {

        $res = false;
        try {
            $res = UserService::create(Input::all());   
        } catch(Exception $e) {
            return Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('1004')
            ));
        } else {
            return Util::response_error_msg('503');
        }
    }

    public function changePassword() {
        
        $res = false;
        try {
            $res = UserService::change_password(Input::all());   
        } catch(Exception $e) {
            return Util::response_error_msg($e->getMessage());
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfoService::get_description('1011')
            ));
        } else {
            return Util::response_error_msg('503');
        }
    }

}