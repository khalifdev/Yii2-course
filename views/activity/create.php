<?php
/**
 * @var $model \app\models\Activity
 */
?>
<h1>Новая активность</h1>
<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>
            <?=$form->field($model,'title');?>
            <?=$form->field($model,'description')->textarea(['data-des'=>22]);?>
            <?=$form->field($model,'date')->input('date');?>
            <?=$form->field($model,'isBlocked')->checkbox()?>
            <?=$form->field($model,'isRepeat')->checkbox()?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>