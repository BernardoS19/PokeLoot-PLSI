<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "colecao".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Carta[] $cartas
 */
class Colecao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colecao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 255],
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
        return $this->hasMany(Carta::class, ['colecao_id' => 'id']);
    }
}
