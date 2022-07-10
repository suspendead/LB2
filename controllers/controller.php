<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/model.php';

$model = new Model();
$_POST = json_decode(file_get_contents('php://input'), true);
$res = '';

switch ($_POST['event']) {
    case 'nurse':
        foreach ($model->getDutyByNurse($_POST['name']) as $duty) {
            foreach ($duty['ward'] as $number) {
                $res .= '<li>Палата №' . $number['number'] . '</li>';
            }
        }
        echo json_encode($res);
        break;
    case 'dep':
        foreach ($model->getDutyByDepartment($_POST['dep']) as $duty) {
            foreach ($duty['nurse'] as $nurse) {
                $res .= '<li>Медсестра ' . $nurse['name'] . '</li>';
            }
        }
        echo json_encode($res);
        break;
    case 'form':
        $res = 
        '<tr>
            <th>Смена</th>
            <th>Дата</th>
            <th>Медсёстры</th>
            <th>Отделение</th>
            <th>Палаты</th>
        </tr>';
        foreach ($model->getDutyByDepAndShift($_POST['shift'], $_POST['dep']) as $duty) {
            $res .= 
            '<tr>
                <td>' . $duty['shift'] . '</td>
                <td>' . ($duty['date']->toDateTime())->format('d.m.Y H:i') . '</td>
                <td><ul>';
                foreach ($duty['nurse'] as $nurse) {
                $res .= 
                '<li>Медсестра ' . $nurse['name'] . '</li>';
                }
                $res .= '</ul></td>
                <td>' . $duty['department'] . '</td>
                <td><ul>';
                foreach ($duty['ward'] as $ward) {
                $res .= 
                '<li>Палата №' . $ward['number'] . '</li>';
                }

            $res .= '</ul></td>
            </tr>';
        } 
        echo json_encode($res);
        break;
}

?>