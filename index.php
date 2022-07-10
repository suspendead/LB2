<?php

require_once __DIR__ . '/models/model.php';
$model = new Model();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Center</title>
</head>
<body>
    <div>
        <label for="">Медсестра: </label>
        <select id="nurse">
            <option value="" selected disabled>Не выбрано</option>
            <? foreach ($model->getNurses() as $nurse) { ?>
            <option value="<?= $nurse['name'] ?>"><?= $nurse['name'] ?></option>
            <? } ?>
        </select>
        <ul id="list-nurse"></ul>
    </div>
    <div>
        <label for="">Отделение: </label>
        <select id="dep">
            <option value="" selected disabled>Не выбрано</option>
            <? foreach ($model->getDepartment() as $dep) { ?>
            <option value="<?= $dep ?>"><?= $dep ?></option>
            <? } ?>
        </select>
        <ul id="list-dep"></ul>
    </div>
    <form>
        <select name="shift">
            <option value="" selected disabled>Не выбрано</option>
            <option value="Первая">Первая</option>
            <option value="Вторая">Вторая</option>
            <option value="Третья">Третья</option>
        </select>
        <select name="dep">
            <option value="" selected disabled>Не выбрано</option>
            <? foreach ($model->getDepartment() as $dep) { ?>
            <option value="<?= $dep ?>"><?= $dep ?></option>
            <? } ?>
        </select>
        <button name="find">Найти</button><br><br>
        <table id="table" border="2px" cellpadding="3px"></table>
    </form>


    <script src="script.js" defer></script>
</body>
</html>