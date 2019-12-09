<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?=$form->field($model,'files[]')->fileInput(['multiple' => true])?>

    <?= $form->field($model, 'startDateTime')->widget(DateTimePicker::class, [
        'name' => 'startDateTime',
        'value' => '18-06-1018, 14:45',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'd-m-yyyy H:i'
        ]
    ]);
    ?>
    <?= $form->field($model, 'endDateTime')->widget(DateTimePicker::class, [
        'name' => 'endDateTime',
        'value' => '18-06-1018, 14:45',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'd-m-yyyy H:i'
        ]
    ]);
    ?>

    <?=$form->field($model,'isBlocked')->checkbox()?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
