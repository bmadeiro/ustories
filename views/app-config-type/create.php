<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AppConfigType */

$this->title = Yii::t('app', 'Create App Config Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'App Config Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-config-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
