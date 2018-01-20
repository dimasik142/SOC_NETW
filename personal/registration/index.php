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
        <p> Реєстрація </p>
        <div class="errors"><br></div>
        <form class="bl_form" name="REGISTRATION_FORM">
            <input type="text" id ="name" size="30" required placeholder="Iм'я"></p><br>
            <input type="text" id ="surename" size="30" required placeholder="Прізвище"></p><br>
            <input type="email" id="email" size="30" required placeholder="Eлектронна скринька"></p><br>
            <input type="password" id="pass" size="30" required placeholder="Пароль"></p><br>
            <input type="password" id="pass_repeat" size="30" required placeholder="Повторіть пароль"></p><br>
            <input type="submit"  id="button_registration" value="Зареєструватись" onclick="check_password()" >
        </form>
    </div>
</div>
</body>

