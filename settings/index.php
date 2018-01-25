<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 20.01.2018
 * Time: 23:01
 */
require($_SERVER["DOCUMENT_ROOT"]."/templates/main/header.php");
$person = new \Sql\Person\Person();
$userData = $person->getUserSettings($_SESSION['USER_AUTH_ID']);
?>
<link rel="stylesheet" href="/templates/main/css/settings.css" />

<div class="main_window">
    <div class="main_block">
        <h3> Змінити пароль</h3><br><br>
        <form class="bl_form" name="settingsChangePassword">
            <div class="settingsPassError"></div>
            <div class="settingsPassResult"></div>
            <input type="password" id="current_password_settings" required placeholder="Старий пароль"><p><br>
            <input type="password" id ="new_password_settings" required placeholder="Новий пароль"><p><br>
            <input type="password" id="new_password_repeat_settings" required placeholder="Повторіть пароль"><p><br>
            <input type="submit" value="Зберегти пароль">
        </form>
        <br>

        <div id="part_settings">
            <br><h3> Адресa вашої електронної пошти </h3><br><br>
            <form class="bl_form" name="settingsChangeEmail">
                Поточна адреса:<?= $userData['EMAIL'] ?><p><br>
                <input type="text" id="email_input_settings" required placeholder="Нова адреса"><p><br>
                <input type="submit" value="Змінити адресу">
            </form>
            <br><br>

            <div id="part_settings">
                <h3> Змінити Ім'я </h3><br>
                <form class="bl_form" name="settingsChangeName">
                    <input type="text" id="userName_settings" required placeholder="Ім'я"><p><br>
                    <input type="text" id="userSurename_settings" required placeholder="Фамілія"><p><br>
                    <input type="submit" value="Змінити "><p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/footer.php"); ?>