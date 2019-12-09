<?php
?>
<div class="row">
    <div class="col-md-6">
        <h3>Авторизация</h3>
        <?php $form=\yii\bootstrap\ActiveForm::begin(); ?>
        <?=$form->field($model,'email');?>
        <?=$form->field($model,'password')->passwordInput()?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Авторизация</button>
        </div>
        <?php $form::end(); ?>
    </div>
</div>
