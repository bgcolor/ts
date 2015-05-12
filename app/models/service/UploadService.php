<?php 
class UploadService {

    public function upload_single_file($file) {
        $path = Util::gen_file_name('.'.$file->getClientOriginalExtension());
        $file->move('uploads',$path);
        return $path;
    }
}