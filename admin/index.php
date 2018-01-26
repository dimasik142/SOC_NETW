<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 26.01.2018
 * Time: 3:16
 */

include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

$person = new \Sql\Person\Person();
$userData = $person->getAllUsers(0); ?>

<html>
<head>
    <title>ADMIN</title>
</head>
<body>
<table border="1" width="100%" style="text-align: center">
    <tr style="height: 35px">
        <td>ЛОГІН</td>
        <td>ІМЯ ФАМІЛІЯ</td>
        <td>Кількість скарг</td>
        <td>СТАТУС</td>
        <td>ЗМІНИТИ СТАТУС</td>
    </tr>
    <?php foreach ($userData as $item) : ?>
        <tr style="height: 35px">
            <td><?= $item['LOGIN']['EMAIL'] ?></td>
            <td><?= $item['DATA']['NAME'] ?>  <?= $item['DATA']['SURENAME'] ?></td>
            <td></td>
            <td><?= $item['LOGIN']['STATUS'] ? $item['LOGIN']['STATUS'] : 'YES' ?></td>
            <td><input type="button" value="Заблокувати / Розблокувати" class="changeStatus" data-id="<?= $item['LOGIN']['USER_ID'] ?>" data-status="<?= $item['LOGIN']['STATUS'] ?>"></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
<script src="/templates/main/js/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('.changeStatus').click(function () {
            var self = this;
            $.ajax({
                type: 'post',
                url: '/lib/ajax/changeStatus.php',
                data: {
                    id: self.getAttribute('data-id'),
                    status: self.getAttribute('data-status')
                },
                dataType: 'json'
            }).done(function (result) {
                location.reload();
            });
        });
    });
</script>