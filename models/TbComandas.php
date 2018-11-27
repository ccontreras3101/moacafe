<?php

namespace app\models;

use Yii;

/**
    * This is the model class for table "{{%tb_comandas}}".
    *
    * @property int $id
    * @property int $id_productos
    * @property int $ctd
    * @property int $id_usuario
    * @property int $id_mesa
    * @property int $id_cliente
    * @property int $status
    * @property obs_expressos $obs_expressos;
    * @property obs_lattes $obs_lattes;
    * @property obs_bfrias $obs_bfrias;
    * @property obs_energy $obs_energy;
    * @property obs_shake $obs_shake;
    * @property obs_fruits $obs_fruits;
    * @property obs_paninis $obs_paninis;
    * @property obs_salads $obs_salads;
    * @property obs_hotcakes $obs_hotcakes;
    * @property obs_cakes $obs_cakes;
    * @property obs_deserts $obs_deserts;
    * @property obs_desertsh_pedido $h_pedido;
    *
    * @property TbCafe $tbCafe
    * @property TbCocina $tbCocina
    * @property TbUsuarios $usuario
    * @property TbClientes $cliente
    * @property TbFacturacion $tbFacturacion
    * @property TbProductos $tbProductos

 */
class TbComandas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tb_comandas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_productos', 'ctd', 'id_usuario', 'id_mesa',/* 'id_cliente',*/ 'status'], 'required'],
            [['id_productos', 'ctd', 'id_usuario', 'id_mesa'], 'integer'],
            [['obs_expressos','obs_lattes','obs_bfrias','obs_energy','obs_shake','obs_fruits','obs_paninis','obs_salads','obs_hotcakes','obs_cakes','obs_deserts', 'h_pedido'], 'safe'],
            [['status'], 'string', 'max' => 1],
            [['id_productos'], 'unique'],
            [['id_usuario'], 'unique'],
            [['id_cliente'], 'unique'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => TbUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => TbClientes::className(), 'targetAttribute' => ['id_cliente' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_productos' => 'Id Productos',
            'ctd' => 'Ctd',
            'id_usuario' => 'Id Usuario',
            'id_mesa' => '# de Mesa',
            'id_cliente' => 'Cedula del Cliente',
            'status' => 'Status',
            'obs_expressos'=> 'Observaciones',
            'obs_lattes'=> 'Observaciones',
            'obs_bfrias'=> 'Observaciones',
            'obs_energy'=> 'Observaciones',
            'obs_shake'=> 'Observaciones',
            'obs_fruits'=> 'Observaciones',
            'obs_paninis'=> 'Observaciones',
            'obs_salads'=> 'Observaciones',
            'obs_hotcakes'=> 'Observaciones',
            'obs_cakes'=> 'Observaciones',
            'obs_deserts'=> 'Observaciones',
            'h_pedido' => 'Hora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbCafe()
    {
        return $this->hasOne(TbCafe::className(), ['id_comanda' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbCocina()
    {
        return $this->hasOne(TbCocina::className(), ['id_comanda' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(TbUsuarios::className(), ['id' => 'id_usuario']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario_full()
    {
        return $this->usuario->nombres.",". $this->usuario->apellidos;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getClientes()
    {
        return TbClientes::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbFacturacion()
    {
        return $this->hasOne(TbFacturacion::className(), ['id_comanda' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbProductos()
    {
        return $this->hasOne(TbProductos::className(), ['id' => 'id_productos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosid()
    {
        return $this->hasOne(TbProductos::className(), ['id' => 'id_productos']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->productosid;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getCafe()
    {
        return TbProductos::find()->where(['grupo' => 'expresso'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getBfrias()
    {
        return TbProductos::find()->where(['grupo' => 'b_frias'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getEnergys()
    {
        return TbProductos::find()->where(['grupo' => 'energizant'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getLattes()
    {
        return TbProductos::find()->where(['grupo' => 'lattes'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getShakes()
    {
        return TbProductos::find()->where(['grupo' => 'merengadas'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getFruits()
    {
        return TbProductos::find()->where(['grupo' => 'm_frutas'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getPaninis()
    {
        return TbProductos::find()->where(['grupo' => 'panini'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getEnsaladas()
    {
        return TbProductos::find()->where(['grupo' => 'ensaladas'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getHotcakes()
    {
        return TbProductos::find()->where(['grupo' => 'p_caliente'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getTortas()
    {
        return TbProductos::find()->where(['grupo' => 'tortas'])->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getPostres()
    {
        return TbProductos::find()->where(['grupo' => 'postres'])->all();
    }
    

}
