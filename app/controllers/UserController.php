<?php 
class UserController extends BaseController {

    public function loginView() {
        if (UserService::check()) return Redirect::to('/');
        $pageVariable = array(
            
        );
        return View::make('login',$pageVariable);
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
        User::logout();
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

}