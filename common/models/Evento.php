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
            [['descricao'], 'string'],
            [['data'], 'safe'],
            [['data'], 'date', 'format' => 'php:Y-m-d'],
            [['carta_id'], 'integer'],
            [['longitude', 'latitude'], 'string', 'max' => 255],
            [['carta_id'], 'unique'],
            [['carta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carta::class, 'targetAttribute' => ['carta_id' => 'id']],
            ['data', 'validarData'],
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

    /*
     * Valida a data de evento ao ser criado para não ser inferior à data de criação
     */
    public function validarData()
    {
        if (strtotime($this->data) < strtotime(date('Y-m-d')))
        {
            $this->addError('data', 'Por favor insira uma data válida');
        }
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
