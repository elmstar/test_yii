<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Projects $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
            \app\models\User::getUsersDropDown(),
        ['prompt' => 'Выберите пользователя']
    )->label('Пользователь') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_start')->textInput(['type' => 'date', 'value' => $model->getFormatDateStart()]) ?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'date', 'value' => $model->getFormatDeadline()]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
