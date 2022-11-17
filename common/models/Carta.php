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
 * @property int $tipo_id
 * @property int $elemento_id
 * @property int $colecao_id
 * @property int $imagem_id
 *
 * @property BaralhoDeCarta[] $baralhoDeCartas
 * @property Baralho[] $baralhos
 * @property Colecao $colecao
 * @property Elemento $elemento
 * @property Evento $evento
 * @property Fatura[] $faturas
 * @property Imagem $imagem
 * @property LinhaFatura[] $linhaFaturas
 * @property ListaDeDesejo[] $listaDeDesejos
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
            [['id', 'nome', 'preco', 'descricao', 'tipo_id', 'elemento_id', 'colecao_id', 'imagem_id'], 'required'],
            [['id', 'verificado', 'tipo_id', 'elemento_id', 'colecao_id', 'imagem_id'], 'integer'],
            [['preco'], 'number'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 255],
            [['imagem_id'], 'unique'],
            [['id', 'tipo_id', 'elemento_id', 'colecao_id', 'imagem_id'], 'unique', 'targetAttribute' => ['id', 'tipo_id', 'elemento_id', 'colecao_id', 'imagem_id']],
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
            'tipo_id' => 'Tipo ID',
            'elemento_id' => 'Elemento ID',
            'colecao_id' => 'Colecao ID',
            'imagem_id' => 'Imagem ID',
        ];
    }

    /**
     * Gets query for [[BaralhoDeCartas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaralhoDeCartas()
    {
        return $this->hasMany(BaralhoDeCarta::class, ['carta_id' => 'id']);
    }

    /**
     * Gets query for [[Baralhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaralhos()
    {
        return $this->hasMany(Baralho::class, ['id' => 'baralho_id'])->viaTable('baralho_de_carta', ['carta_id' => 'id']);
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
     * Gets query for [[ListaDeDesejos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListaDeDesejos()
    {
        return $this->hasMany(ListaDeDesejo::class, ['carta_id' => 'id']);
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
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('lista_de_desejo', ['carta_id' => 'id']);
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
