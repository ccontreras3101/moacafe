<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_mesas".
 *
 * @property int $id
 * @property int $id_comanda
 * @property string $h_entrada
 * @property string $h_salida
 *
 * @property TbComandas $comanda
 */
class TbMesas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mesas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_comanda', 'h_entrada', 'h_salida'], 'required'],
            [['id_comanda'], 'integer'],
            [['h_entrada', 'h_salida'], 'safe'],
            [['id_comanda'], 'unique'],
            [['id_comanda'], 'exist', 'skipOnError' => true, 'targetClass' => TbComandas::className(), 'targetAttribute' => ['id_comanda' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_comanda' => Yii::t('app', 'Id Comanda'),
            'h_entrada' => Yii::t('app', 'H Entrada'),
            'h_salida' => Yii::t('app', 'H Salida'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComanda()
    {
        return $this->hasOne(TbComandas::className(), ['id' => 'id_comanda']);
    }
}
