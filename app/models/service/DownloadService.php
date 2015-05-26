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
        return Response::download(iconv("utf-8",Util::$localCharset, Input::get('pathname')));
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
            $download->touch();/*echo urlencode($file->pathname);*/
            // return Response::download(iconv("utf-8",Util::$localCharset, $file->pathname));
            // return Response::download(iconv("utf-8",Util::$localCharset, $file->pathname));
        } else {
            $download = new Download();
            $download->file_id = $params['file_id'];
            $download->owner_id = $owner->id;
            $download->owner_name = $owner->name;
            $download->pathname = $file->pathname;
            $download->filename = $file->filename;
            $download->downloader_id = $downloader->id;
            $download->downloader_name = $downloader->name;

            if (!$download->save()) {
                return Util::response_error_msg('6001');
            }
        }

        $ua = $_SERVER["HTTP_USER_AGENT"];

        // $_SERVER["HTTP_USER_AGENT"]在IE中显示为：
        // Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko
            // echo $file->pathname;
        if (file_exists(iconv('utf-8','gb18030',$file->pathname))) {
            
        
            $filename = $file->filename;

            header('Content-Type: application/octet-stream');

            //if (preg_match("/MSIE/", $ua)) {        
            //兼容IE11
            if(preg_match("/MSIE/", $ua) || preg_match("/Trident\/7.0/", $ua)){
                header('Content-Disposition: attachment; filename="' . $filename . '"');
            } else if (preg_match("/Firefox/", $ua)) {
                header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
            } else {
                header('Content-Disposition: attachment; filename="' . $filename . '"');
            }

            readfile(iconv('utf-8','gb18030',$file->pathname));
        }
       
	}
}