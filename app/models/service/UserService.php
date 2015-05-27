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
        self::compose_session($user);
        
        return true;
    }

    public static function compose_session($user) {
        //make user session
        Session::put('username',$user->username);
        Session::put('uid',$user->id);
        Session::put('uname',$user->name);
        Session::put('role',$user->role);

        $status_infos = StatusInfo::all();
        foreach ($status_infos as $si) {
            Session::put($si->status_code, $si->description);
        }

        $constant_strings = ConstantString::all();
        foreach ($constant_strings as $cs) {
            Session::put($cs->id, $cs->value);
        }

        $authorities = Authority::all();
        foreach ($authorities as $a) {
            Session::put($a->id.'-'.$a->role, $a->description);
        }
    }

    public static function logout() {
        Session::flush();
    }

    public static function create($params) {

        //validate
        if (!Util::validate($params,array(
                'username' => 'required',
                // 'password' => 'required|min:6|max:20',
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

        $params['password'] = Hash::make(ConstantStringService::get('default_password'));

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

            if ($params['project_id'] != $tutor->project_id) {
                throw new Exception('1015');
            }

            if (!$tutor) {
                throw new Exception('1002');
            }

            $params['tutor_name'] = $tutor->name;
        }

        if ($params['role'] == 2) {
            if (isset($params['tutor_id'])) {
                $tutor = User::find($params['tutor_id']);

                if ($params['project_id'] != $tutor->project_id) {
                    throw new Exception('1015');
                }

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
            $user->password = Hash::make($params['new-password']); 
            return $user->save() ? true : false;
        } else {
            throw new Exception('1010');
        }

    }

    public static function reset_password($params) {
        //validate
        if (!Util::validate($params,array(
                'id' => 'required',
            ))) {
            throw new Exception('1000');
        }

        if (!AuthService::find('change_others_pass')) {
            throw new Exception('0001');
        }

        $user = User::find($params['id']);

        $user->password = Hash::make(ConstantStringService::get('default_password')); 
        return $user->save() ? true : false;

    }

    public static function get_user_array($id) {
        $user = User::find($id);
        $user_arr = $user->toArray();

        $project = Project::find($user->project_id);
        if ($project) {
            $user_arr['project'] = $project;
        }

        $evaluation = Evaluation::whereRaw('user_id = ?', array($id))->first();
        if ($evaluation) {
            $user_arr['evaluation'] = $evaluation;
        }

        $students = User::whereRaw('tutor_id = ?', array($id))->get();
        if (count($students)) {
            foreach ($students as $s) {
                $s->evaluation = Evaluation::whereRaw('user_id = ?', array($s->id))->first();
            }

            $user_arr['students'] = $students;
        }

        $tutor = User::find($user->tutor_id);
        if ($tutor) {
            $user_arr['tutor'] = $tutor;
        }

        $downloads;
        if (AuthService::find('check_all_files')  === true) {
            $downloads = FileModel::skip(0)->take(Util::$previewCount)->orderBy('created_at', 'desc')->get();
        } else if (AuthService::find('check_others_files') === true) {
            $users = User::where('project_id','=',$user->project_id)->get();
            
            $user_str = '(';
            foreach ($users as $k => $v) {
                if ($k != 0) {
                    $user_str .= ',';
                }
                $user_str .= $v->id;
            }
            $user_str .= ')';

            $downloads = FileModel::whereRaw("user_id in $user_str")->skip(0)->take(Util::$previewCount)->orderBy('created_at', 'desc')->get();
        } else {
            $tutor = User::find($user->tutor_id);
            $students = User::whereRaw('tutor_id = ?',array($id))->get();
            $file_owners = array();
            if ($tutor) {
                $file_owners[] = $tutor->id;
            }

            if($students) {
                foreach ($students as $student) {
                    $st_sts = User::whereRaw('tutor_id = ?',array($student->id))->get();
                    if ($st_sts) {
                        foreach ($st_sts as $st_st) {
                            $file_owners[] = $st_st->id;
                        }
                    }
                    $file_owners[] = $student->id;
                }
            }

            if ($file_owners) {
                $downloads = FileModel::whereRaw('user_id in ('.implode(',', $file_owners).')')->skip(0)->take(Util::$previewCount)->orderBy('created_at', 'desc')->get();
            } else {
                $downloads = array();
            }
        }

        if ($downloads) {
            foreach ($downloads as $d) {
                $records = Download::whereRaw('file_id = ?',array($d->id))->get();
                $downloaders = array();
                foreach($records as $record) {
                    $user = User::find($record->downloader_id);
                    // array_push($d->downloaders, $user->name);
                    $downloaders[] = $user->name;
                }

                $user = User::find($d->user_id);
                
                $d->user = $user;
                $d->downloaders = $downloaders;
                $d->my_record = Download::whereRaw('downloader_id = ? and file_id = ?',array($id, $d->id))->select('updated_at')->first();
            }

            $user_arr['downloads'] = $downloads;
        }

        $uploads = FileModel::where('user_id', '=', $id)->skip(0)->take(Util::$previewCount)->orderBy('created_at', 'desc')->get();

        if ($uploads) {
            foreach ($uploads as $upload) {
                $user = User::find($upload->user_id);
                $upload->user_name = $user->name;

                $downloaders = Download::where('file_id','=',$upload->id)->get();
                if ($downloaders) {
                    $upload->downloaders = $downloaders;
                }
            }

            $user_arr['uploads'] = $uploads;
        }

        return $user_arr;
    }

    public static function get_someone_array($id) {
        $user = User::find($id);
        $user_arr = $user->toArray();

        $project = Project::find($user->project_id);
        if ($project) {
            $user_arr['project'] = $project;
        }

        $has_progress = false;
        if (AuthService::find2('my_progress', $user->role)) {
            $evaluation = Evaluation::find($id);
            if ($evaluation) {
                $user_arr['evaluation'] = $evaluation;
                
            }
            $has_progress = true;
        }
        $user_arr['has_progress'] = $has_progress;

        $has_students = false;
        if (AuthService::find2('my_student', $user->role)) {
            $students = User::whereRaw('tutor_id = ?', array($id))->get();
            if (count($students)) {
                foreach ($students as $s) {
                    $s->evaluation = Evaluation::whereRaw('user_id = ?', array($s->id))->first();
                }

                $user_arr['students'] = $students;
                
            }
            $has_students = true;
        }
        $user_arr['has_students'] = $has_students;

        

        $tutor = User::find($user->tutor_id);
        if ($tutor) {
            $user_arr['tutor'] = $tutor;
        }

    
        $downloads = Download::where('downloader_id','=',$user->id)->orderBy('updated_at', 'desc')->get();
        if (count($downloads)) {
            $user_arr['downloads'] = $downloads;
        }


        // if ($downloads) {
        //     foreach ($downloads as $d) {
        //         $records = Download::whereRaw('file_id = ?',array($d->id))->get();
        //         $downloaders = array();
        //         foreach($records as $record) {
        //             $user = User::find($record->downloader_id);
        //             // array_push($d->downloaders, $user->name);
        //             $downloaders[] = $user->name;
        //         }

        //         $user = User::find($d->user_id);
                
        //         $d->user = $user;
        //         $d->downloaders = $downloaders;
        //         $d->my_record = Download::whereRaw('downloader_id = ? and file_id = ?',array($id, $d->id))->select('created_at')->first();
        //     }

        //     $user->downloads = $downloads;
        // }

        $has_uploads = false;
        if (AuthService::find2('my_upload', $user->role)) {
           $uploads = FileModel::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

           if (count($uploads)) {
               foreach ($uploads as $upload) {
                   $user = User::find($upload->user_id);
                   $upload->user_name = $user->name;

                   $downloaders = Download::where('file_id','=',$upload->id)->get();
                   if ($downloaders) {
                       $upload->downloaders = $downloaders;
                   }
               }

               $user_arr['uploads'] = $uploads;
           }
           $has_uploads = true;
        }
        $user_arr['has_uploads'] = $has_uploads;

        

        $can_download = false;
        $can_delete = false;
        $role = Session::get('role');
        if (5 == $role) {
            $can_download = true;
            $can_delete = true;
        } else {
            $self = User::find(Session::get('uid'));
            $user_tutor = User::find($user->tutor_id);

            if ($self->id == $user->id) {
                $can_download = true;
                $can_delete = true;
            }

            if ($self->tutor_id == $user->id) {
                $can_download = true;
            }

            if ($self->id == $user->tutor_id) {
                $can_download = true;
            }

            if (isset($user_tutor) && $self->id == $user_tutor->tutor_id) {
                $can_download = true;
            }

        }

        $user_arr['can_download'] = $can_download;
        $user_arr['can_delete'] = $can_delete;

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

    public static function get_uploads($id) {
        $uploads = FileModel::where('user_id', '=', $id)->orderBy('updated_at', 'desc')->paginate(Util::$pagination);

        if ($uploads) {
            foreach ($uploads as $upload) {
                $user = User::find($upload->user_id);
                $upload->user_name = $user->name;

                $downloaders = Download::where('file_id','=',$upload->id)->get();
                if ($downloaders) {
                    $upload->downloaders = $downloaders;
                }
            }
        }

        return $uploads;
    }

    public static function get_uploads_with_querystring($id, $q) {
        $uploads = FileModel::where('user_id', '=', $id)->where('filename', 'like', '%'.$q.'%')->orderBy('updated_at', 'desc')->paginate(Util::$pagination);

        if ($uploads) {
            foreach ($uploads as $upload) {
                $user = User::find($upload->user_id);
                $upload->user_name = $user->name;

                $downloaders = Download::where('file_id','=',$upload->id)->get();
                if ($downloaders) {
                    $upload->downloaders = $downloaders;
                }
            }
        }

        return $uploads;
    }

    public static function get_downloads($id) {
        $user =  User::find($id);
        if (!$user) {
            throw new Exception('1000');
        }

        $downloads;
        if (AuthService::find('check_all_files')  === true) {
            $downloads = FileModel::orderBy('updated_at', 'desc')->paginate(Util::$pagination);
        } else if (AuthService::find('check_others_files') === true) {
            $users = User::where('project_id','=',$user->project_id)->get();
            
            $user_str = '(';
            foreach ($users as $k => $v) {
                if ($k != 0) {
                    $user_str .= ',';
                }
                $user_str .= $v->id;
            }
            $user_str .= ')';

            $downloads = FileModel::whereRaw("user_id in $user_str")->orderBy('updated_at', 'desc')->paginate(Util::$pagination);
        } else {

            $tutor = User::find($user->tutor_id);
            $students = User::whereRaw('tutor_id = ?',array($id))->get();
            $file_owners = array();
            if ($tutor) {
                $file_owners[] = $tutor->id;
            }

            if($students) {
                foreach ($students as $student) {
                    $st_sts = User::whereRaw('tutor_id = ?',array($student->id))->get();
                    if ($st_sts) {
                        foreach ($st_sts as $st_st) {
                            $file_owners[] = $st_st->id;
                        }
                    }
                    $file_owners[] = $student->id;
                }
            }

            if ($file_owners) {
                $downloads = FileModel::whereRaw('user_id in ('.implode(',', $file_owners).')')->orderBy('created_at', 'desc')->paginate(Util::$pagination);
            } else {
                $downloads = array();
            }   

        }

        if ($downloads) {
            foreach ($downloads as $d) {
                $records = Download::whereRaw('file_id = ?',array($d->id))->get();
                $downloaders = array();
                foreach($records as $record) {
                    $user = User::find($record->downloader_id);
                    // array_push($d->downloaders, $user->name);
                    $downloaders[] = $user->name;
                }

                $user = User::find($d->user_id);
                
                $d->user = $user;
                $d->downloaders = $downloaders;
                $d->my_record = Download::whereRaw('downloader_id = ? and file_id = ?',array($id, $d->id))->select('updated_at')->first();
            }
        }
        
        return $downloads;
    }

    public static function get_downloads_with_querystring($id, $q) {
        $user =  User::find($id);
        if (!$user) {
            throw new Exception('1000');
        }

        $downloads;
        if (AuthService::find('check_all_files')  === true) {
            $downloads = FileModel::where('filename', 'like', '%'.$q.'%')->orderBy('updated_at', 'desc')->paginate(Util::$pagination);
        } else if (AuthService::find('check_others_files') === true) {
            $users = User::where('project_id','=',$user->project_id)->get();
            
            $user_str = '(';
            foreach ($users as $k => $v) {
                if ($k != 0) {
                    $user_str .= ',';
                }
                $user_str .= $v->id;
            }
            $user_str .= ')';

            $downloads = FileModel::whereRaw("user_id in $user_str")->where('filename', 'like', '%'.$q.'%')->orderBy('updated_at', 'desc')->paginate(Util::$pagination);
        } else {
    
            $tutor = User::find($user->tutor_id);
            $students = User::whereRaw('tutor_id = ?',array($id))->get();
            $file_owners = array();
            if ($tutor) {
                $file_owners[] = $tutor->id;
            }

            if($students) {
                foreach ($students as $student) {
                    $st_sts = User::whereRaw('tutor_id = ?',array($student->id))->get();
                    if ($st_sts) {
                        foreach ($st_sts as $st_st) {
                            $file_owners[] = $st_st->id;
                        }
                    }
                    $file_owners[] = $student->id;
                }
            }

            if ($file_owners) {
                $downloads = FileModel::whereRaw('user_id in ('.implode(',', $file_owners).') and filename like "%'.$q.'%"')->orderBy('created_at', 'desc')->paginate(Util::$pagination);
            } else {
                $downloads = array();
            } 

        }

        if ($downloads) {
            foreach ($downloads as $d) {
                $records = Download::whereRaw('file_id = ?',array($d->id))->get();
                $downloaders = array();
                foreach($records as $record) {
                    $user = User::find($record->downloader_id);
                    // array_push($d->downloaders, $user->name);
                    $downloaders[] = $user->name;
                }

                $user = User::find($d->user_id);
                
                $d->user = $user;
                $d->downloaders = $downloaders;
                $d->my_record = Download::whereRaw('downloader_id = ? and file_id = ?',array($id, $d->id))->select('updated_at')->first();
            } 
        }

        return $downloads;
    }

    public static function delete($params) {
        if (!Util::validate($params,array(
                'id' => 'required',
            ))) {
            throw new Exception('1000');
        }

        if (!AuthService::find('change_pass')) {
            throw new Exception('0001');
        }

        $user = User::find($params['id']);
        if (!$user) {
            throw new Exception('1000');
        }

        $downloaders = Download::whereRaw('downloader_id = ? or owner_id = ?',array($user->id, $user->id));
        $uploads = FileModel::where("user_id",'=',$user->id);
        $evaluation = Evaluation::find($user->id);
        $files = $uploads->get();

        DB::transaction(function() use ($user,$downloaders,$uploads,$evaluation)
        {
            $uploads->delete();

            if (isset($evaluation)) {
                $evaluation->delete();
            }

            $downloaders->delete();

            $user->delete();
        });

        if(isset($files)) {
            foreach ($files as $f) {
                unlink($f->pathname);
            }
        }

        return true;
    }
}