<?php 
class ViewController extends BaseController {

	public function index() {
        $user = UserService::get_user_array(Session::get('uid'));

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
            'username' => Session::get('username'),
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
			'change_pass'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
		return View::make('profile',$view_variable);
	}

    public function download() {

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
            'change_pass'
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
            'change_pass'
        ));

        $view_variable = array_merge($page_variable, $auth_variable);
        return View::make('upload',$view_variable);
    }
}