<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/Db/connect.php');
$db = Db::connect();

$res = $db->query("
SELECT av.*, atv.*
FROM avto_voe as av
LEFT JOIN  `avto_toplivo_voe` as atv ON av.marka_topliva = atv.marka_topliva
");

?>
<h1> Отчет о финансовых затратах на топливо за месяц по каждому автомобилю</h1>
<table id="report">
    <thead>
    <tr>
        <td>Марка авто</td>
        <td>Тип авто</td>
        <td>Номер авто</td>
        <td>Водитель, ФИО</td>
        <td>Тип топлива</td>
        <td>Затраты на топливо, грн</td>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($data = $res->fetch()) {
        $odometr_current_month = $data['odometr_current_month'];
        $odometr_last_month = $data['odometr_last_month'];
        $rashod_topliva = $data['rashod_topliva'];
        $price_toplivo = $data['price_toplivo'];
        $zatraty_na_toplivo = (($odometr_current_month - $odometr_last_month) / 100) * $rashod_topliva * $price_toplivo;
        ?>
        <tr>
            <td><?php echo $data['marka_avto']; ?> </td>
            <td><?php echo $data['type_avto']; ?> </td>
            <td><?php echo $data['gos_number']; ?> </td>
            <td><?php echo $data['fio_voditel']; ?> </td>
            <td><?php echo $data['type_topliva']; ?> </td>
            <td><?php echo $zatraty_na_toplivo; ?> </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
