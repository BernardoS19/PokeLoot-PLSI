<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedido_avaliacao".
 *
 * @property int $user_id
 * @property int $carta_id
 * @property string $estado
 * @property float|null $valor_avaliado
 * @property string|null $data_avaliacao
 *
 * @property Carta $carta
 * @property User $user
 */
class Pedido_avaliacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_avaliacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'carta_id', 'estado'], 'required'],
            [['user_id', 'carta_id'], 'integer'],
            [['estado'], 'string'],
            [['valor_avaliado'], 'number', 'min' => 0.1],
            [['data_avaliacao'], 'safe'],
            [['user_id', 'carta_id'], 'unique', 'targetAttribute' => ['user_id', 'carta_id']],
            [['carta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carta::class, 'targetAttribute' => ['carta_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'carta_id' => 'Carta ID',
            'estado' => 'Estado',
            'valor_avaliado' => 'Valor Avaliado',
            'data_avaliacao' => 'Data Avaliacao',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
