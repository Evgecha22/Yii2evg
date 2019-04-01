<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Klient */

$this->title = 'Update Klient: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Klients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="klient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
