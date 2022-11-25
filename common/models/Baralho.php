<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "baralho".
 *
 * @property int $id
 * @property string $nome
 * @property int $user_id
 *
 * @property BaralhoCarta[] $baralhoCartas
 * @property Carta[] $cartas
 * @property User $user
 */
class Baralho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baralho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
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
            'nome' => 'Nome',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[BaralhoCartas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaralhoCartas()
    {
        return $this->hasMany(BaralhoCarta::class, ['baralho_id' => 'id']);
    }

    /**
     * Gets query for [[Cartas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartas()
    {
        return $this->hasMany(Carta::class, ['id' => 'carta_id'])->viaTable('baralho_carta', ['baralho_id' => 'id']);
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
