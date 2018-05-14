<?php

namespace app\admin\controller;

class Upload extends Base
{
	//图片上传
    public function upload(){
       $file = request()->file('file');
       $info = $file->move(ROOT_PATH  . DS . 'uploads/images');
       if($info){
            echo '/uploads/images/'.$info->getSaveName();
        }else{
            echo $file->getError();
        }
    }

    //会员头像上传
    public function uploadface(){
       $file = request()->file('file');
       $info = $file->move(ROOT_PATH  . DS . 'uploads/face');
       if($info){
           echo '/uploads/face/'.$info->getSaveName();
        }else{
            echo $file->getError();
        }
    }



}