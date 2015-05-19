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
}