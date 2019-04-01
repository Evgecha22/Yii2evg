<?php
/**
 * Created by PhpStorm.
 * User: samvik
 * Date: 27.03.2019
 * Time: 12:21
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUploadTest extends Model
{
    public $image;
    public function rules()
    {
        return [
            [['image'],'required'],
            [['image'],'file','extensions'=>'jpg,png']
        ];
    }

    public function imageUpload(UploadedFile $file,$currentimage){
        if (file_exists(Yii::getAlias('@web').'upload/'.$currentimage)){
            @unlink(Yii::getAlias('@web').'upload/'.$currentimage);
        }
        $filename=strtolower(md5(uniqid($file->baseName)).'.'.$file->extension);
        $file->saveAs(Yii::getAlias('@web').'upload/'.$filename);
        return $filename;
    }
}