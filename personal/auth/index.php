<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 14.01.2018
 * Time: 4:16
 */
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/login/header.php"); ?>

<body>
<div class="container">
    <div class="login">
        <h1>Вхід</h1> <br>
        <form class="bl_form" method="get">
            <input type="email" id="User_email" size="15" maxlength="40" required placeholder="Eлектронна скринька"><br><br>
            <input type="password" id="User_password" size="15" maxlength="40" required placeholder="Пароль"><br><br>
            <input type="submit" class="login_button" value="Вхід"><br><br>
            <a href="../registration/" class="other_button"> Реєстрація</a><br>
        </form>
    </div>
</div>
</body>

