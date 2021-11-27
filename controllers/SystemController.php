<?php

class SystemController {
    public function __construct()
    {

    }

    public function  actionCreateDir() {
        if (!file_exists(ROOT.'/tmp/media')) {
            mkdir(ROOT.'/tmp/media', 0777, true);
        }

        return true;
    }

    public function actionSaveImages($imagesArray) {
        $savedImagesArray = [];
        foreach ($imagesArray as $image) {
            $randomName = $this->generateRandomString();
            if (copy($image, ROOT.'/tmp/media/'.$randomName.'.png')) {
                $savedImagesArray[] = $randomName;
            }
        }

        return $savedImagesArray;
    }

    public function actionDeleteImages() {
        $savedFiles = scandir(ROOT.'/tmp/media/');
        foreach ($savedFiles as $file) {
            if ($file){
                unlink(ROOT.'/tmp/media/'.$file);
            }
        }

        return true;
    }

    public function generateRandomString($length = 10) {

        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}