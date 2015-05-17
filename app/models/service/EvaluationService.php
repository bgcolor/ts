<?php 
class EvaluationService extends Service {

	public static function create($params) {
		if (!Util::validate($params,array(
                'user_id' => 'required|integer',
                'creator_id' => 'required|integer',
                'progress' => 'required|integer'
            ))) {
            throw new Exception('4000');
        }

        if (AuthService::find('evaluate_others') !== true) {
        	throw new Exception('4001');
        }

		$evaluation =  Evaluation::whereRaw('user_id = ?', array($params['user_id']))->first();
		if ($evaluation) {
			$creator = User::find($params['creator_id']);
			
			if (!$creator) {
				throw new Exception('4000');
			} 

			if ($evaluation->cerator_id != $params['creator_id']) {
				$evaluation->creator_id = $params['creator_id'];
				$evaluation->creator_name = $creator->name;
			}

			$evaluation->progress = $params['progress'];
			return $evaluation->save() ? true : false;
		}
	}
}