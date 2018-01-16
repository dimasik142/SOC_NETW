<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 16.01.2018
 * Time: 14:01
 */ ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/registration/header.php"); ?>

<body>
<div class="container">
    <div class="main_window">
        <p> Реєстрація </p><br>
        <form class="bl_form">
            <input type="text" name="User_name" id ="name" size="15" maxlength="35" required placeholder="Iм'я"></p><br>
            <input type="text" name="User_surename" id ="surename" size="15" maxlength="35" required placeholder="Прізвище"></p><br>
            <input type="email" name="User_email" id="email" size="15" maxlength="35" required placeholder="Eлектронна скринька"></p><br>
            <input type="password" name="User_password" id="pass" size="15" maxlength="35" required placeholder="Пароль"></p><br>
            <input type="password" name="User_password" id="pass_repeat" size="15" maxlength="35" required placeholder="Повторіть пароль"></p><br>
            <input type="button"  id="button_registration" value="Зареєструватись" onclick="check_password()" >
        </form>
    </div>
</div>
</body>

