<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carta".
 *
 * @property int $id
 * @property string $nome
 * @property float $preco
 * @property string $descricao
 * @property int $verificado
 * @property int $imagem_id
 * @property int $tipo_id
 * @property int $elemento_id
 * @property int $colecao_id
 *
 * @property BaralhoCarta[] $baralhoCartas
 * @property Baralho[] $baralhos
 * @property Colecao $colecao
 * @property Elemento $elemento
 * @property Evento $evento
 * @property Fatura[] $faturas
 * @property Imagem $imagem
 * @property LinhaFatura[] $linhaFaturas
 * @property ListaDesejo[] $listaDesejos
 * @property PedidoAvaliacao[] $pedidoAvaliacaos
 * @property Tipo $tipo
 * @property User[] $users
 * @property User[] $users0
 */
class Carta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'preco', 'descricao', 'imagem_id', 'tipo_id', 'elemento_id', 'colecao_id'], 'required'],
            [['preco'], 'number', 'min' => 0.1],
            [['descricao'], 'string'],
            [['imagem_id', 'tipo_id', 'elemento_id', 'colecao_id'], 'integer'],
            [['verificado'], 'integer', 'min' => 0, 'max' => 1],
            [['nome'], 'string', 'max' => 45],
            [['imagem_id'], 'unique'],
            [['colecao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colecao::class, 'targetAttribute' => ['colecao_id' => 'id']],
            [['elemento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Elemento::class, 'targetAttribute' => ['elemento_id' => 'id']],
            [['imagem_id'], 'exist', 'skipOnError' => true, 'targetClass' => Imagem::class, 'targetAttribute' => ['imagem_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::class, 'targetAttribute' => ['tipo_id' => 'id']],
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
            'preco' => 'Preco',
            'descricao' => 'Descricao',
            'verificado' => 'Verificado',
            'imagem_id' => 'Imagem',
            'tipo_id' => 'Tipo',
            'elemento_id' => 'Elemento',
            'colecao_id' => 'Colecao',
        ];
    }

    /**
     * Gets query for [[BaralhoCartas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaralhoCartas()
    {
        return $this->hasMany(BaralhoCarta::class, ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[Baralhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaralhos()
    {
        return $this->hasMany(Baralho::class, ['id' => 'baralho_id'])->viaTable('baralho_carta', ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[Colecao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColecao()
    {
        return $this->hasOne(Colecao::class, ['id' => 'colecao_id']);
    }

    /**
     * Gets query for [[Elemento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElemento()
    {
        return $this->hasOne(Elemento::class, ['id' => 'elemento_id']);
    }

    /**
     * Gets query for [[Evento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvento()
    {
        return $this->hasOne(Evento::class, ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['id' => 'fatura_id'])->viaTable('linha_fatura', ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[Imagem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagem()
    {
        return $this->hasOne(Imagem::class, ['id' => 'imagem_id']);
    }

    /**
     * Gets query for [[LinhaFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhaFaturas()
    {
        return $this->hasMany(LinhaFatura::class, ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[ListaDesejos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListaDesejos()
    {
        return $this->hasMany(ListaDesejo::class, ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[PedidoAvaliacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoAvaliacaos()
    {
        return $this->hasMany(PedidoAvaliacao::class, ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipo::class, ['id' => 'tipo_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('lista_desejo', ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[Users0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('pedido_avaliacao', ['carta_id' => 'id']);
    }
}
