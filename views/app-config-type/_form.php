<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppConfigType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-config-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'config_group_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_active')->widget(SwitchInput::classname(), [
        'type' => SwitchInput::CHECKBOX
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
