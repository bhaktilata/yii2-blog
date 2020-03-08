<?php
// функцию загрузки картинки на сервер вместе с логикой загрузки и валидацией. 
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{
    
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }


    public function uploadFile($file, $currentImage)
    {
            
       $this->image = $file;

      /* if($this->validate())
       {
           $this->deleteCurrentImage($currentImage);
           return $this->saveImage();
       } */
        
        //@unlink($this->getFolder() . $currentImage);

        $this->deleteCurrentImage($currentImage);

         $filename = $this->generateFilename();
        // $filename = strtolower(md5(uniqid($file->basename)) . '.' . $file->extension);
        $file->saveAs($this->getFolder() . $filename); // загрузка на сервер 
        return $filename;
    }

    private function getFolder()
    {
        return Yii::getAlias('@web') . 'images/';
    }

    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($currentImage)
    {
        if($this->fileExists($currentImage))
        {
            @unlink($this->getFolder() . $currentImage);
        }
    }

    public function fileExists($currentImage)
    {
        if(!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
    }

    public function saveImage()
    {
        $filename = $this->generateFilename();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}
