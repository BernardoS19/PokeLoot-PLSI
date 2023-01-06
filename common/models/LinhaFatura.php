<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linha_fatura".
 *
 * @property int $fatura_id
 * @property int $carta_id
 * @property float|null $preco
 * @property int|null $verificado
 *
 * @property Carta $carta
 * @property Fatura $fatura
 */
class LinhaFatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linha_fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fatura_id', 'carta_id'], 'required'],
            [['fatura_id', 'carta_id'], 'integer'],
            [['verificado'], 'integer', 'min' => 0, 'max' => 1],
            [['preco'], 'number', 'min' => 0.1],
            [['fatura_id', 'carta_id'], 'unique', 'targetAttribute' => ['fatura_id', 'carta_id']],
            [['carta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carta::class, 'targetAttribute' => ['carta_id' => 'id']],
            [['fatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fatura::class, 'targetAttribute' => ['fatura_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fatura_id' => 'Fatura ID',
            'carta_id' => 'Carta ID',
            'preco' => 'Preco',
            'verificado' => 'Verificado',
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
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Fatura::class, ['id' => 'fatura_id']);
    }
}
