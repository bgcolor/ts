<?php 
class UserService {
    public static function check() {
        //check if the user has already signed
        return Session::has('username') ? true : false;
    }

    public static function check_old_password($username, $password) {
        $user = User::where('username','=',$username)->first();
        
        //check if the user exists
        if (is_null($user)) {
            return false;
        }
        return Hash::check($password,$user->password) ? true : false;
    }

    public static function login($username, $password) {
        $user = User::where('username','=',$username)->first();

        //check if the user exists
        if (is_null($user)) {
            return false;
        }

        //check username and password
        if (!Hash::check($password,$user->password)) {
            return false;
        }

        //register login time
        $user->touch();

        //make user session
        Session::put('username',$user->username);
        Session::put('uid',$user->id);
        return true;
    }

    public static function logout() {
        Session::flush();
    }

    public static function create($params) {

        //validate
        if (!Util::validate($params,array(
                'username' => 'required',
                'password' => 'required|min:6|max:20',
                'name' => 'required',
                'role' => 'required'
            ))) {
            throw new Exception('1000');
        }

        if (UserService::check_existed_username($params['username'])) {
            throw new Exception('1003');
        }

        //build user array
        $user_arr = UserService::user_array($params);

        $user = User::create($user_arr);

        return $user ? true : false;
    }

    public static function check_existed_username($username) {
        $user =  User::where('username','=',$username)->first();
        
        //check if there is a user in db with the same name.

        return $user ? true : false;
    }

    public static function user_array($params){
        $user_arr = array(
            'username' => $params['username'],
            'password' => Hash::make($params['password']),
            'name' => $params['name'],
            'role' => $params['role'],
        );


        if ($params['role'] != 5) {
            if (!isset($params['project_id'])) {
                throw new Exception('1000');
            }
            $project = Project::find($params['project_id']);
            if (!$project) {
                throw new Exception('1003');
            }
            $user_arr['project_id'] = $params['project_id'];
        }

        if ($params['role'] == 1) {
            if(!isset($params['tutor_id'])) {
                throw new Exception('1001');
            }

            $tutor = User::find($params['tutor_id']);

            if (!$tutor) {
                throw new Exception('1002');
            }

            $user_arr['tutor_id'] = $params['tutor_id'];
            $user_arr['tutor_name'] = $tutor->name;
        }

        if ($params['role'] == 2) {
            if (isset($params['tutor_id'])) {
                $tutor = User::find($params['tutor_id']);

                if (!$tutor) {
                    throw new Exception('1002');
                }

                $user_arr['tutor_id'] = $params['tutor_id'];
                $user_arr['tutor_name'] = $tutor->name;
            }
        }

        return $user_arr;
    }
}