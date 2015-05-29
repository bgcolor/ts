<?php 
class ProjectService extends Service {

    public static function create($params) {
        if (!Util::validate($params,array(
            'name' => 'required',
            'description' => 'required'
        ))) {
            throw new Exception('3000');
        }

        $project = Project::where('name','=',$params['name'])->first();
        if ($project) {
            throw new Exception('3003');
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

    public static function update($params) {
        if (!Util::validate($params,array(
            'id' => 'required'
        ))) {
            throw new Exception('3000');
        }

        $project = Project::find($params['id']);

        if (isset($params['name'])) {
            $project->name = $params['name'];
        }

        if (isset($params['description'])) {
            $project->description = $params['description'];
        }

        return $project->update() ? true : false;
    }

    public static function delete($params) {
        if (!Util::validate($params,array(
            'id' => 'required'
        ))) {
            throw new Exception('0002');
        }

        $project = Project::find($params['id']);
        if (!$project) return Util::response_error_msg('0002');

        $users = User::where('project_id','=',$params['id'])->get();
        
        foreach ($users as $user) {
            $params = array('id' => $user->id);
            UserService::delete($params);
        }

        $project->delete();
        
        return true;
    }
}