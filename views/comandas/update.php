<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TbComandas */

$this->title = Yii::t('app', 'Modificar Comandas: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lista de Comandas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="tb-comandas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cafe' => $cafe,
 		'clientes'=>$clientes,
 		'b_frias' => $b_frias,
 		'lattes' => $lattes,
 		'shakes' => $shakes,
 		'energys' => $energys,
 		'fruits' => $fruits,
 		'paninis' => $paninis,
 		'ensaladas' => $ensaladas,
 		'hotcakes' => $hotcakes,
 		'tortas' => $tortas,
 		'postres' => $postres,
    ]) ?>

</div>
