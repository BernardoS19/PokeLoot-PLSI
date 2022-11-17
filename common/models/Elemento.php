<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "elemento".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Carta[] $cartas
 */
class Elemento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'elemento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }

    /**
     * Gets query for [[Cartas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartas()
    {
        return $this->hasMany(Carta::class, ['elemento_id' => 'id']);
    }
}
