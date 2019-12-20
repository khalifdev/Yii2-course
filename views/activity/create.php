<?php

use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

/**
 * @var $model \app\models\Activity
 */
?>
<h1>Новая активность</h1>
<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin();?>
            <?=$form->field($model,'title');?>
            <?=$form->field($model,'description')->textarea();?>

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

            <?= $form->field($model, 'useNotification')->checkbox(); ?>
            <?= $form->field($model, 'email', ['enableClientValidation' => false, 'enableAjaxValidation' => true]); ?>
            <?= $form->field($model, 'repeatEmail', ['enableClientValidation' => false, 'enableAjaxValidation' => true]); ?>
            <?=$form->field($model,'files[]')->fileInput(['multiple' => true])?>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        <?php ActiveForm::end(); ?>
    </div>
</div>