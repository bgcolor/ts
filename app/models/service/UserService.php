<?php 
class UserService extends Service {
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

    public static function login($params) {
        if (!isset($params['username']) || !isset($params['password'])) {
            throw new Exception('1005');
        }

        $username = $params['username'];
        $password = $params['password'];

        $user = User::where('username','=',$username)->first();

        //check if the user exists
        if (is_null($user)) {
            throw new Exception('1006');
        }

        //check username and password
        if (!Hash::check($password,$user->password)) {
            throw new Exception('1007');
        }

        //register login time
        $user->touch();

        //make user session
        Session::put('username',$user->username);
        Session::put('uid',$user->id);
        Session::put('uname',$user->name);
        Session::put('role',$user->role);
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

        $params['password'] = Hash::make($params['password']);

        if ($params['role'] != 5) {
            if (!isset($params['project_id'])) {
                throw new Exception('1000');
            }
            $project = Project::find($params['project_id']);
            if (!$project) {
                throw new Exception('1009');
            }
        }

        if ($params['role'] == 1) {
            if(!isset($params['tutor_id'])) {
                throw new Exception('1001');
            }

            $tutor = User::find($params['tutor_id']);

            if (!$tutor) {
                throw new Exception('1002');
            }

            $params['tutor_name'] = $tutor->name;
        }

        if ($params['role'] == 2) {
            if (isset($params['tutor_id'])) {
                $tutor = User::find($params['tutor_id']);

                if (!$tutor) {
                    throw new Exception('1002');
                }

                $params['tutor_name'] = $tutor->name;
            }
        }

        return $params;
    }

    public static function change_password($params) {
        //validate
        if (!Util::validate($params,array(
                'old-password' => 'required|min:6|max:20',
                'new-password' => 'required|min:6|max:20',
            ))) {
            throw new Exception('1000');
        }

        if (!AuthService::find('change_pass')) {
            throw new Exception('0001');
        }

        $username = Session::get('username');
        $uid = Session::get('uid');

        $check_old_pass = UserService::check_old_password($username,$params['old-password']);
        
        if ($check_old_pass === true) {
            $user =  User::where('username','=',$username)->first();
            $user->password = Hash::make($params['password']); 
            return $user->save() ? true : false;
        } else {
            throw new Exception('1010');
        }

    }

    public static function get_user_array($id) {
        $user = User::find($id);
        $user_arr = $user->toArray();

        $project = Project::find($user->project_id);
        if ($project) {
            $user_arr['project_name'] = $project;
        }

        $evaluation = Evaluation::whereRaw('user_id = ?', array($id))->first();
        if ($evaluation) {
            $user_arr['evaluation'] = $evaluation;
        }

        $students = User::whereRaw('tutor_id = ?', array($id))->get();
        if ($students) {
            $user_arr['students'] = $students;
        }

        $tutor = User::find($user->tutor_id);
        if ($tutor) {
            $user_arr['tutor'] = $tutor;
        }

        return $user_arr;
    }

    public static function update($params) {
        if (!Util::validate($params,array(
                'id' => 'required',
            ))) {
            throw new Exception('1000');
        }

        $user = User::find($params['id']);

        if (!$user) {
            throw new Exception('1000');
        }

        foreach ( $params as $key => $value ) {
            if ($key == 'password') {
                throw new Exception('0002');
            }

            $user[$key] = $value;
        }

        return $user->save() ? true : false;
    }
}