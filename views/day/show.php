<?php
/**
 * @var $model \app\models\Day
 */
?>
<h1>Активности дня</h1>
<h4>Дата: <?= $model->date; ?> <?= $model->isDayOff ? '(выходной)' : '(рабочий)' ?></h4>
<?php foreach ($model->activities as $activity) { ?>
    <p><b>Заголовок активности:</b> <?= $activity['title'] ?></p>
    <p><b>Описание:</b> <?= $activity['description'] ?></p>
    <p><b>Время:</b> с <span> <?= $activity['startTime']; ?> </span>
                    по <span> <?= $activity['endTime']; ?>  </span></p>
    <p><b>Блокирующая активность:</b> <?= $activity['isBlocking'] ? 'Да' : 'Нет' ?></p>
    <p><b>Повторяющаяся активность:</b> <?= $activity['isRepeated'] ? 'Да' : 'Нет' ?></p>
    <p><b>Частота повторения:</b> <?= $activity['isRepeated'] ? $model::REPEAT_TYPE[$activity['repeatType']] : '-' ?></p>
<?php } ?>

