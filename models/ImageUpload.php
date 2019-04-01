<?php
/**
 * Created by PhpStorm.
 * User: samvik
 * Date: 14.03.2019
 * Time: 11:58
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;
    public function rules()
    {
        return [
            [['image'],'required'], // required проверка на пустоту
            [['image'],'file','extensions'=>'jpg,png'] // extensions проверяем наличие типов файла
        ];
    }

    public function imageUpload(UploadedFile $file,$currentimage)
    {
        // print_r($file); // проверяем что файл передан модели
        //die ($currentimage); // распечатываем навание текущего файла
        // $file->saveAs(Yii::getAlias('@web').'upload/'.$file->name);
       // if ($this->validate()) {
            if (file_exists(Yii::getAlias('@web') . 'upload/' . $currentimage)) { // фунцыя file_exists возращает true если файл существует
                @unlink(Yii::getAlias('@web') . 'upload/' . $currentimage); // удаляем старый файл
            }
            $filename = strtolower(md5(uniqid($file->baseName)) . "." . $file->extension);
            $file->saveAs(Yii::getAlias('@web') . 'upload/' . $filename);
            return $filename;
        }
   // }

}