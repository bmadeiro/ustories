<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AppConfigGroup */

$this->title = Yii::t('app', 'Create App Config Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'App Config Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-config-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
