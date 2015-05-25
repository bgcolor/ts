<?php 
class ViewController extends BaseController {

	public function index() {
        $user_id = Session::get('uid');
        $user = UserService::get_user_array($user_id);

		$page_variable = array(
            'profile_title' => ConstantStringService::get('profile_title'),
            'photo_remark1' => ConstantStringService::get('photo_remark1'),
            'photo_remark2' => ConstantStringService::get('photo_remark2'),
            'no_tutors' => ConstantStringService::get('no_tutors'),
            'no_students' => ConstantStringService::get('no_students'),
            'no_evaluation' => ConstantStringService::get('no_evaluation'),
            'no_downloads' => ConstantStringService::get('no_downloads'),
            'no_uploads' => ConstantStringService::get('no_uploads'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'post_max_size' => ConstantStringService::get('post_max_size'),
            'msg_above_max' => StatusInfoService::get_description('2001'),
            'msg_delete' => StatusInfoService::get_description('2008'),
            'msg_wrong_type' => StatusInfoService::get_description('2009'),
            'username' => Session::get('username'),
            'user_id' => $user_id,
            'user' => $user,
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
        	'my_profile',
			'my_tutor',
			'my_student',
			'my_download',
			'my_upload',
            'my_progress',
			'create_user',
			'create_project',
			'change_pass',
            'manage_files',
            'project_files',
            'downloads_download',
            'project_users',
            'all_users',
            'downloads_delete'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
		return View::make('profile',$view_variable);
	}

    public function download() {

        $user_id = Session::get('uid');
        $downloads = UserService::get_downloads($user_id);

        if (Input::has('q')) {
            $downloads = UserService::get_downloads_with_querystring($user_id, Input::get('q'));
        } else {
            $downloads = UserService::get_downloads($user_id);
        }

        
        if (!isset($downloads)) {
            $paginator = Paginator::make(array(), 0, Util::$pagination);
        } 
        
        $downloads_arr = $downloads->toArray();
        $paginator = Paginator::make($downloads_arr, $downloads->getTotal(), Util::$pagination);

        if (Input::has('q')) {
            $paginator->appends(array('q' => Input::get('q')));
        }
        
        $page_variable = array(
            'download_title' => ConstantStringService::get('download_title'),
            'no_downloads' => ConstantStringService::get('no_downloads'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'msg_delete' => StatusInfoService::get_description('2008'),
            'username' => Session::get('username'),
            'downloads' => $downloads,
            'user_id' => $user_id,
            'paginator' => $paginator,
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'downloads_download',
            'downloads_delete',
            'project_files',
            'project_users',
            'all_users',
            'manage_files'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('download',$view_variable);
    }

    public function upload() {

        $user_id = Session::get('uid');

        if (Input::has('q')) {
            $uploads = UserService::get_uploads_with_querystring($user_id, Input::get('q'));
        } else {
            $uploads = UserService::get_uploads($user_id);
        }

        
        if (!isset($uploads)) {
            $paginator = Paginator::make(array(), 0, Util::$pagination);
        } 
        
        $uploads_arr = $uploads->toArray();
        $paginator = Paginator::make($uploads_arr, count($uploads_arr), Util::$pagination);

        if (Input::has('q')) {
            $paginator->appends(array('q' => Input::get('q')));
        }

        $page_variable = array(
            'upload_title' => ConstantStringService::get('upload_title'),
            'no_uploads' => ConstantStringService::get('no_uploads'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'post_max_size' => ConstantStringService::get('post_max_size'),
            'msg_above_max' => StatusInfoService::get_description('2001'),
            'msg_delete' => StatusInfoService::get_description('2008'),
            'username' => Session::get('username'),
            'user_id' => $user_id,
            'uploads' => $uploads,
            'paginator' => $paginator,
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'project_files',
            'project_users',
            'all_users',
            'manage_files'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('upload',$view_variable);
    }

    public function changePassword() {

        $page_variable = array(
            'change_pass_title' => ConstantStringService::get('change_pass_title'),
            'no_tutors' => ConstantStringService::get('no_tutors'),
            'no_students' => ConstantStringService::get('no_students'),
            'no_evaluation' => ConstantStringService::get('no_evaluation'),
            'no_downloads' => ConstantStringService::get('no_downloads'),
            'no_uploads' => ConstantStringService::get('no_uploads'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'pass_fail' => StatusInfoService::get_description('1012'),
            'username' => Session::get('username'),
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'project_files',
            'project_users',
            'all_users',
            'manage_files'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('change_pass',$view_variable);
    }

    public function createProject() {
        
        $page_variable = array(
            'project_title' => ConstantStringService::get('project_title'),
            'no_tutors' => ConstantStringService::get('no_tutors'),
            'no_students' => ConstantStringService::get('no_students'),
            'no_evaluation' => ConstantStringService::get('no_evaluation'),
            'no_downloads' => ConstantStringService::get('no_downloads'),
            'no_uploads' => ConstantStringService::get('no_uploads'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'project_fail' => StatusInfoService::get_description('3002'),
            'username' => Session::get('username'),
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'project_users',
            'all_users',
            'project_files',
            'manage_files'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('create_project',$view_variable);
    }

    public function someone() {
        $user_id = Input::get('id');
        $user = UserService::get_someone_array($user_id);

        $page_variable = array(
            'profile_title' => Session::get('uname'),
            'no_tutors' => ConstantStringService::get('no_tutors'),
            'no_students' => ConstantStringService::get('no_students'),
            'no_evaluation' => ConstantStringService::get('no_evaluation'),
            'no_downloads' => ConstantStringService::get('no_downloads'),
            'no_uploads' => ConstantStringService::get('no_uploads'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'post_max_size' => ConstantStringService::get('post_max_size'),
            'msg_above_max' => StatusInfoService::get_description('2001'),
            'msg_delete' => StatusInfoService::get_description('2008'),
            'username' => Session::get('username'),
            'user_id' => $user_id,
            'user' => $user,
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'manage_files',
            'project_files',
            'downloads_download',
            'downloads_delete',
            'project_users',
            'all_users',
            'evaluate_others'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('someone_profile',$view_variable);
    }

    public function createUser() {
        $user_id = Input::get('id');
        $projects = Project::all();
        $tutors = User::whereRaw('role = ? or role = ?',array(2,3))->get();

        $page_variable = array(
            'user_title' => ConstantStringService::get('user_title'),
            'username' => Session::get('username'),
            'user_id' => $user_id,
            'projects' => $projects,
            'tutors' => $tutors,
            'user_fail' => StatusInfoService::get_description('1014'),
            'chose_tutor' => StatusInfoService::get_description('1001'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'manage_files',
            'project_files',
            'downloads_download',
            'downloads_delete',
            'project_users',
            'all_users',
            'evaluate_others'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('create_user',$view_variable);
    }

    public function userList() {
        $user_id = Session::get('uid');
        $self = User::find($user_id);

        $type = Input::get('type');

        if (1 == $type) {
            $users = array(User::find($self->tutor_id));
        }

        if (2 == $type) {
            $users = User::where('tutor_id','=',$user_id)->get();
        }

        if (3 == $type) {
            if (Input::has('q')) {
                $users = User::where('project_id','=',$self->project_id)->whereRaw('name like "%'.Input::get('q').'%"')->get();
            } else {
                $users = User::where('project_id','=',$self->project_id)->get();
            }
            
        }

        if (4 == $type) {
            if (Input::has('q')) {
                $users = User::whereRaw('name like "%'.Input::get('q').'%"')->get();
            } else {
                $users = User::all();
            } 
        }

        if (isset($users) && count($users)) {
            foreach ($users as $user) {
                // $evaluation = Evaluation::where('user_id','=',$user->id)->first();
                $evaluation = Evaluation::find($user->id);
                $project = project::find($user->project_id);
                $students = User::where('tutor_id','=',$user->id)->get();
                
                $user->evaluation = $evaluation;
                $user->project = $project; 
                
                if (count($students)) {
                    $user->students = $students;
                }   
            }
        }

        

        $page_variable = array(
            'list_title' => ConstantStringService::get('list_title'),
            'no_students' => ConstantStringService::get('no_students'),
            'username' => Session::get('username'),
            'user_id' => $user_id,
            'users' => $users,
            'type' => $type,
            'user_fail' => StatusInfoService::get_description('1016'),
            'chose_tutor' => StatusInfoService::get_description('1001'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'msg_delete' => StatusInfoService::get_description('1017'),
            'msg_reset' => StatusInfoService::get_description('1018'),
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'change_others_pass',
            'manage_files',
            'project_users',
            'all_users',
            'project_files'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('user_list',$view_variable);
    }

    public function evaluate() {
        if (!AuthService::find('evaluate_others')) {
            return Util::response_error_msg('4001');
        }

        $user_id = Input::get('id');
        $user = User::find($user_id);

        if (!$user) {
            return Util::response_error_msg('1000');
        }

        $page_variable = array(
            'evaluate_title' => ConstantStringService::get('evaluate_title'),
            'username' => Session::get('username'),
            'user_id' => $user_id,
            'user' => $user,
            'evaluate_fail' => StatusInfoService::get_description('4003'),
            'public_msg' => ConstantStringService::get('public_msg'),
            'system_title' => ConstantStringService::get('system_title'),
            'system_sub_title' => ConstantStringService::get('system_sub_title'),
            'powered_by' => ConstantStringService::get('powered_by')
        );

        $auth_variable = AuthService::compose_variable(array(
            'my_profile',
            'my_tutor',
            'my_student',
            'my_download',
            'my_upload',
            'my_progress',
            'create_user',
            'create_project',
            'change_pass',
            'manage_files',
            'project_files',
            'downloads_download',
            'downloads_delete',
            'project_users',
            'all_users',
            'evaluate_others'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('evaluate',$view_variable);
    }
}