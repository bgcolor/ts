<?php 
class DownloadService extends Service {

	public static function download_only($params) {
		if ( !Util::validate(
                $params,
                array(
                    'pathname' => 'required'
                )
            ) ) {
            return Util::response_error_msg('6000');
        }
        return Response::download(Input::get('pathname'));
	}

	public static function download_and_process($params) {
		if ( !Util::validate(
                $params,
                array(
                    'file_id' => 'required',
                    'downloader_id' => 'required'
                )
            ) ) {
            throw new Exception('6000'); 
        }

        $file = FileModel::find($params['file_id']);
        $downloader = User::find($params['downloader_id']);
        
        if (!$file || !$downloader) {
        	throw new Exception('6000');
        }

        $owner = User::find($file->user_id);

        if (!$owner) {
            throw new Exception('503');
        }

        $download = Download::whereRaw('file_id = ? and downloader_id = ?',array($params['file_id'], $params['downloader_id']))->first();

        if ($download) {
            $download->touch();
            return Response::download($file->pathname);
        }

        $download = new Download();
        $download->file_id = $params['file_id'];
        $download->owner_id = $owner->id;
        $download->owner_name = $owner->name;
        $download->pathname = $file->pathname;
        $download->filename = $file->filename;
        $download->downloader_id = $downloader->id;
        $download->downloader_name = $downloader->name; 

        if ($download->save()) {
        	return Response::download($file->pathname);
        } else {
            return Util::response_error_msg('6001');
        }
	}
}