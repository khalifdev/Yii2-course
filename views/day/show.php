<?php
/**
 * @var $model \app\models\Day
 */
?>
<h1>События дня</h1>
<h4>Дата: <?= $model->date; ?> <?= $model->isDayOff ? '(выходной)' : '' ?></h4>
<?php foreach ($model->activities as $activity) { ?>
    <p><b>Заголовок события:</b> <?= $activity['title'] ?></p>
    <p><b>Описание:</b> <?= $activity['description'] ?></p>
    <p><b>Блокирующее событие:</b> <?= $activity['isBlocked'] ? 'Да' : 'Нет' ?></p>
    <p><b>Повторяющееся событие:</b> <?= $activity['isRepeat'] ? 'Да' : 'Нет' ?></p>
<?php } ?>

