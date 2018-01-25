<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 13.01.2018
 * Time: 19:51
 */
require($_SERVER["DOCUMENT_ROOT"]."/templates/main/header.php");
$person = new \Sql\Person\Person();
$userData = $person->getUserInformation($_SESSION['USER_AUTH_ID']);
?>

<div class="main_window">
    <div class="title">
        <?= $userData['NAME'] ?>   <?= $userData['SURENAME'] ?>
    </div>
    <div>
        <div class ="div_photo">
            <p id ="lena"><img id ="photo_low_quality" src="<?= $userData['PHOTO'] ?>"></p>
            <br>
        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/footer.php"); ?>
