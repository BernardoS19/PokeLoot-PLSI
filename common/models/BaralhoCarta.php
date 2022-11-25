<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "baralho_carta".
 *
 * @property int $baralho_id
 * @property int $carta_id
 *
 * @property Baralho $baralho
 * @property Carta $carta
 */
class BaralhoCarta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baralho_carta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['baralho_id', 'carta_id'], 'required'],
            [['baralho_id', 'carta_id'], 'integer'],
            [['baralho_id', 'carta_id'], 'unique', 'targetAttribute' => ['baralho_id', 'carta_id']],
            [['baralho_id'], 'exist', 'skipOnError' => true, 'targetClass' => Baralho::class, 'targetAttribute' => ['baralho_id' => 'id']],
            [['carta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carta::class, 'targetAttribute' => ['carta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'baralho_id' => 'Baralho ID',
            'carta_id' => 'Carta ID',
        ];
    }

    /**
     * Gets query for [[Baralho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaralho()
    {
        return $this->hasOne(Baralho::class, ['id' => 'baralho_id']);
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
