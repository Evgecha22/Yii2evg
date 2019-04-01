<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auto".
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $data
 * @property string $price
 * @property string $photo
 * @property int $id_marka
 * @property int $id_klient
 *
 * @property Klient $klient
 * @property Marka $marka
 */
class Auto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','city','price'],'required'],
            [['data'], 'date','format'=>'php:Y-m-d'],
            [['data'],'default','value'=>date('Y-m-d')],
            [['price'], 'number'],
            [['id_marka', 'id_klient'], 'integer'],
            [['name', 'city', 'photo'], 'string', 'max' => 255],
            [['id_klient'], 'exist', 'skipOnError' => true, 'targetClass' => Klient::className(), 'targetAttribute' => ['id_klient' => 'id']],
            [['id_marka'], 'exist', 'skipOnError' => true, 'targetClass' => Marka::className(), 'targetAttribute' => ['id_marka' => 'id']],
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
            'city' => 'City',
            'data' => 'Data (Y-m-d)',
            'price' => 'Price',
            'photo' => 'Photo',
            'id_marka' => 'Id Marka',
            'id_klient' => 'Id Klient',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKlient()
    {
        return $this->hasOne(Klient::className(), ['id' => 'id_klient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarka()
    {
        return $this->hasOne(Marka::className(), ['id' => 'id_marka']);
    }
    // Создаем метод который будет записывать название файла в таблицу БД
    public function saveImage($fileName){
        $this->photo=$fileName; // присваеваем свойство название файла
        return $this->save(false); // метод save сохраняет название в БД параметр false нужен для того чтобы отключить валидацыю то есть чтоб не сработал метод rules
    }
}
