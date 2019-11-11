<?php

use yii\bootstrap\ActiveForm;

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
            <?= $form->field($model, 'date'); ?>
            <?= $form->field($model, 'startTime')->input('time'); ?>
            <?= $form->field($model, 'endTime')->input('time'); ?>
            <?=$form->field($model,'isBlocking')->checkbox()?>
            <?=$form->field($model,'isRepeated')->checkbox()?>
            <?= $form->field($model, 'repeatType')->dropDownList([
                0=>'Каждый день',1=>'Каждую неделю', 2=>'Каждый месяц']) ?>

            <?= $form->field($model, 'useNotification')->checkbox(); ?>
            <?= $form->field($model, 'email', ['enableClientValidation' => false, 'enableAjaxValidation' => true]); ?>
            <?= $form->field($model, 'repeatEmail', ['enableClientValidation' => false, 'enableAjaxValidation' => true]); ?>
            <?=$form->field($model,'files[]')->fileInput(['multiple' => true])?>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        <?php ActiveForm::end(); ?>
    </div>
</div>