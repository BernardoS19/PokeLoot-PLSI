<?php

namespace frontend\models;

use yii\base\Model;

class PagamentoForm extends Model
{

    public $nome;
    public $numero;
    public $data_validade;
    public $ccv;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'numero', 'data_validade', 'ccv'], 'required'],
            ['nome', 'string'],
            ['numero', 'string', 'max' => '16'],
            ['numero', 'match', 'pattern' => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})$/m'],
            ['data_validade', 'date', 'format' => 'MM/yy'],
            ['ccv', 'integer', 'max' => 999],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome no Cartão',
            'numero' => 'Número do Cartão',
            'data_validade' => 'Validade (ex: 12/98)',
            'ccv' => 'CCV',
        ];
    }


}