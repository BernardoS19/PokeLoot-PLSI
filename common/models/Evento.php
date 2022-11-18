<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property int $id
 * @property string $descricao
 * @property string $data
 * @property string $longitude
 * @property string $latitude
 * @property int $carta_id
 *
 * @property Carta $carta
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'data', 'longitude', 'latitude', 'carta_id'], 'required'],
            [['data'], 'safe'],
            [['carta_id'], 'integer'],
            [['descricao', 'longitude', 'latitude'], 'string', 'max' => 255],
            [['carta_id'], 'unique'],
            [['carta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carta::class, 'targetAttribute' => ['carta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'data' => 'Data',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'carta_id' => 'Carta ID',
        ];
    }

    /**
     * Gets query for [[Carta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarta()
    {
        return $this->hasOne(Carta::class, ['id' => 'carta_id']);
    }
}
