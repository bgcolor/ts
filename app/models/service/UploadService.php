<?php 
error_reporting(0);
class UploadService extends Service {

    /**
     *  file is uploaded to uploads/${username}/ folder
     *	and then return whole pathname to the client
     */
    public static function upload_only($file) {
    	$username = Session::get('username');
    	return 'uploads/'.$username.'/'.UploadService::process($file);
    }

    /**
     *  file is uploaded to uploads/${username}/ folder
     *	and then process
     *	return only true or false
     */
    public static function upload_and_process($file, $params) {
    	UploadService::before_upload($params);
    	$filename = UploadService::process($file);
    	UploadService::after_upload($params, $filename);
    	return true;
    }

    public static function process($file) {
    	$username = Session::get('username');
        // $filname = Util::gen_file_name('.'.$file->getClientOriginalExtension());
        $filname = $file->getClientOriginalName();
        
        $pathname = 'uploads/'.$username.'/'.$filname;
        $existFile = FileModel::whereRaw('pathname = ?',array($pathname))->first();
        if ($existFile) {
            throw new Exception('2004');
        }

        $file->move('uploads/'.$username,$filname);
        return $filname;
    }

    public static function before_upload($params) {
    	if (!Util::validate($params,array(
                'id' => 'required|integer'
            ))) {
            throw new Exception('2000');
        }
    }

    public static function after_upload($params, $filename) {
    	$user_id = Session::get('uid');
    	$user = User::find($user_id);
    	
    	if (!$user) {
    		throw new Exception('2000');
    	}

		
        $file = new FileModel();
    	$file->user_id = $user_id;

    	$username = Session::get('username');

    	$file->pathname = 'uploads/'.$username.'/'.$filename;
    	$file->filename = $filename;

    	if (!$file->save()) {echo 'aa';
    		throw new Exception('503');
    	}
    }

    public static function delete($params) {
        if ( !Util::validate(
                $params,
                array(
                    'id' => 'required'
                )
            ) ) {
            throw new Exception('6000');
        }

        DB::transaction(function() use ($params)
        {
            $file = FileModel::find($params['id']);
            $pathname = $file->pathname;
            $file->delete();
            Download::where('file_id','=',$params['id'])->delete();
            unlink(URL::to('/').'/'.$pathname);
        });

        return true;
    }
}