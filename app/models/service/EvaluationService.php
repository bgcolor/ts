<?php 
class EvaluationService extends Service {

	public static function create($params) {
		if (!Util::validate($params,array(
                'user_id' => 'required|integer',
                'evaluator_id' => 'required|integer',
                'progress' => 'required|integer'
            ))) {
            throw new Exception('4000');
        }

        if (AuthService::find('evaluate_others') !== true) {
        	throw new Exception('4001');
        }

        $user = User::find($params['user_id']);
        $self = User::find(Session::get('uid'));
        $user_tutor = User::find($user->tutor_id);

        if (!$user) {
            throw new Exception('4000');
        }

        if (isset($self->project_id) && $user->project_id != $self->project_id) {
            throw new Exception('4001');
        }

        if ($self->id == $user->tutor_id || (isset($user_tutor) && $user_tutor->tutor_id == $self->id)) {
            $evaluation =  Evaluation::whereRaw('user_id = ?', array($params['user_id']))->first();
            
            if (!$evaluation) {
                $evaluation = new Evaluation;
                $evaluation->user_id = $params['user_id'];
            }

            $creator = User::find($params['evaluator_id']);
                
            if (!$creator) {
                throw new Exception('4000');
            } 

            if ($evaluation->evaluator_id != $params['evaluator_id']) {
                $evaluation->evaluator_id = $params['evaluator_id'];
                $evaluation->evaluator_name = $creator->name;

            }

            $evaluation->progress = $params['progress'];
            $evaluation->description = $params['description'];
            return $evaluation->save() ? true : false;
        }

		throw new Exception('4001');
	}

    public static function hasPower($user_id, $self_id) {
        $user = User::find($user_id);
        $self = User::find($self_id);
        $user_tutor = User::find($user->tutor_id);

        return $self->id == $user->tutor_id || (isset($user_tutor) && $user_tutor->tutor_id == $self->id) ? true : false;
    }
}