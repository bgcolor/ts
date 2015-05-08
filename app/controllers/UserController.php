<?php 
class UserController extends BaseController {

    public function loginView() {
        if (UserService::check()) return Redirect::to('/');
        return View::make('login');
    }

    /**
     * login user.
     * @return json give a message if fail
     */
    public function login() {
        
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
            $status_info = StatusInfo::WhereRaw('status_code = ?',array($e->getMessage()))->first();

            if ($status_info) {
                return Response::json(array(
                    'status' => 'fail',
                    'errorCode' => $e->getMessage(),
                    'message' => $status_info->description
                ));
            }
        }

        if ($res === true) {
            return Response::json(array(
                'status' => 'success',
                'message' => StatusInfo::WhereRaw('status_code = ?',array('1004'))->first()
            ));
        } else {
            return Response::json(array(
                'status' => 'fail',
                'errorCode' => '503',
                'message' => StatusInfo::WhereRaw('status_code = ?',array('503'))->first()
            ));
        }
    }

}