<?php 
class ProjectService {

    public static function create($params) {
        if (!Util::validate($params,array(
            'name' => 'required',
            'description' => 'required'
        ))) {
            throw new Exception('3000');
        }

        if (isset($params['creator_id'])) {

            $creator = User::find($params['creator_id']);
            if (!$creator) {
                throw new Exception('3000');
            }

            $params['creator_name'] = $creator->name;

        } else {
            if (Session::has('uname') || Session::has('uid')) {
                $params['creator_id'] = Session::get('uid');
                $params['creator_name'] = Session::get('uname');
            }
        }

        $project = Project::create($params);
        return $project ? true : false;
    }
}