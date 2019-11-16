<?php
use yii\helpers\Html;
/**
 * @var $model \app\models\Day
 */
?>
<h1>Активности дня</h1>
<h4>Дата: <?= $model->date; ?> <?= $model->isDayOff ? '(выходной)' : '(рабочий)' ?></h4>
<?php foreach ($model->activities as $activity) { ?>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?= Html::img('@web/files/1573483416_8.jpg', ['class' => 'card-img', 'alt' => 'картинка'])?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $activity['title'] ?></h5>
                    <p class="card-text"><?= $activity['description'] ?></p>
                    <p class="card-text"><small class="text-muted">Изменено 3 мин. назад</small></p>
                </div>
            </div>
        </div>
    </div>

<!--    <p><b>Заголовок активности:</b> --><?//= $activity['title'] ?><!--</p>-->
<!--    <p><b>Описание:</b> --><?//= $activity['description'] ?><!--</p>-->
<!--    <p><b>Время:</b> с <span> --><?//= $activity['startTime']; ?><!-- </span>-->
<!--                    по <span> --><?//= $activity['endTime']; ?><!--  </span></p>-->
<!--    <p><b>Блокирующая активность:</b> --><?//= $activity['isBlocking'] ? 'Да' : 'Нет' ?><!--</p>-->
<!--    <p><b>Повторяющаяся активность:</b> --><?//= $activity['isRepeated'] ? 'Да' : 'Нет' ?><!--</p>-->
<!--    <p><b>Частота повторения:</b> --><?//= $activity['isRepeated'] ? $model::REPEAT_TYPE[$activity['repeatType']] : '-' ?><!--</p>-->
<?php } ?>

