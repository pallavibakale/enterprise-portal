<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Client;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $clients = Client::find()->orderBy(['name' => SORT_ASC])->all();
    $clientItems = ArrayHelper::map($clients, 'id', 'name');
    ?>

    <?= $form->field($model, 'client_id')->dropDownList(
        $clientItems,
        ['prompt' => 'Select Client']
    ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        'active' => 'Active',
        'on_hold' => 'On Hold',
        'completed' => 'Completed',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
