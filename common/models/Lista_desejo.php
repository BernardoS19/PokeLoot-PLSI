<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lista_desejo".
 *
 * @property int $user_id
 * @property int $carta_id
 *
 * @property Carta $carta
 * @property User $user
 */
class Lista_desejo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lista_desejo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'carta_id'], 'required'],
            [['user_id', 'carta_id'], 'integer'],
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
