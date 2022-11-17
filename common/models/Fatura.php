<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fatura".
 *
 * @property int $id
 * @property string $data
 * @property int $pago
 * @property int $user_id
 *
 * @property Carta[] $cartas
 * @property LinhaFatura[] $linhaFaturas
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
            [['id', 'data', 'user_id'], 'required'],
            [['id', 'pago', 'user_id'], 'integer'],
            [['data'], 'safe'],
            [['id', 'user_id'], 'unique', 'targetAttribute' => ['id', 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
     * Gets query for [[LinhaFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhaFaturas()
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
