<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\switchinput\SwitchInput;
//use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\App */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-form">
    
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->widget(SwitchInput::classname(), [
        'type' => SwitchInput::CHECKBOX
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
