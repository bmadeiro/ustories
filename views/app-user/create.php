<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AppUser */

$this->title = Yii::t('app', 'Create App User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'App Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
