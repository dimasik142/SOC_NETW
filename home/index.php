<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 13.01.2018
 * Time: 19:51
 */
?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/header.php"); ?>
<div class="main_window">
    <div class="title">
        dimasik124214
    </div>
    <div>
        <div class ="div_photo">
            <p id ="lena"><img id ="photo_low_quality"></p>
            <br>
        </div>
        <div class="information">
    asdasdasd
            asd
            as
            da
            sd
            as
            dsa
            d
        </div>
    </div>
    <button type="submit" class ="button_play">
        <image src="photo/play.png">
    </button>
</div>
<?php
\User\UserMethods::checkUserAuth();
if (\User\UserMethods::checkUserAuth()){
    echo 'uawe';
} else {
    echo 'no';
}
?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/footer.php"); ?>
