<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

//Modelo para formulário de upload das imagens
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $imagemCarta;

    public function rules()
    {
        return [
            [['imagemCarta'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg ,jpeg'],
        ];
    }

    public function upload($nomeImagem)
    {
        if ($this->validate()) {
            $this->imagemCarta->saveAs(Yii::getAlias("@common") . '/images/' . $nomeImagem . '.' . $this->imagemCarta->extension);
            return $this->imagemCarta;
        } else {
            return false;
        }
    }
}