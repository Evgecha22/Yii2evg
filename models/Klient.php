<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "klient".
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $year
 * @property string $phone
 * @property string $login
 * @property string $email
 * @property string $pass
 *
 * @property Auto[] $autos
 */
class Klient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'klient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','login','email','pass','phone'],'required'],
            [['year'],'date','format'=>'php:Y-m-d'],
            [['year'],'default','value'=>date("Y-m-d")],
            [['name', 'photo', 'phone', 'login', 'email', 'pass'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'photo' => 'Photo',
            'year' => 'Year Y-m-d',
            'phone' => 'Phone',
            'login' => 'Login',
            'email' => 'Email',
            'pass' => 'Pass',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutos()
    {
        return $this->hasMany(Auto::className(), ['id_klient' => 'id']);
    }
    public function saveimage($fileName){
        $this->photo=$fileName;
        return $this->save(false);
    }
}
