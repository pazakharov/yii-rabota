<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
           
            $name = 'uploads/' .$this->randomFileName($this->imageFile->extension);
           
            $this->imageFile->saveAs($name);
           
            return $name;
        } else {
            return false;
        }
    }

    private function randomFileName($extension = false)
  {
    $extension = $extension ? '.' . $extension : '';
    do {
      $name = md5(microtime() . rand(0, 1000));
      $file = $name . $extension;
    } while (file_exists($file));
    return $file;
  }
}

?>