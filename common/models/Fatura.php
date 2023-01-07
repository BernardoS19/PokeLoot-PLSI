<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fatura".
 *
 * @property int $id
 * @property string|null $data
 * @property int $pago
 * @property int $user_id
 *
 * @property Carta[] $cartas
 * @property LinhaFatura[] $linhasFatura
 * @property User $user
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['user_id'], 'integer'],
            [['pago'], 'integer', 'min' => 0, 'max' => 1],
            [['user_id', 'pago'], 'required'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            ['data', 'compare', 'compareValue' => date('Y-m-d H:i:s'), 'operator' => '==', 'type' => 'datetime'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'pago' => 'Pago',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Cartas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartas()
    {
        return $this->hasMany(Carta::class, ['id' => 'carta_id'])->viaTable('linha_fatura', ['fatura_id' => 'id']);
    }

    /**
     * Gets query for [[LinhasFatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasFatura()
    {
        return $this->hasMany(LinhaFatura::class, ['fatura_id' => 'id']);
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
