<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 14.01.2018
 * Time: 4:16
 */
require($_SERVER["DOCUMENT_ROOT"]."/templates/login/header.php"); ?>

<body>
<div class="container">
    <div class="login">
        <h1>Вхід</h1>
        <div class="errors"><br></div>
        <form class="bl_form" name="LOGIN_FORM">
            <input type="email" id="user_email" size="30" maxlength="40" required placeholder="Email:"><br><br>
            <input type="password" id="user_password" size="30" maxlength="40" required placeholder="Password:"><br><br>
            <input type="submit" class="login_button" value="Вхід"><br><br>
            <a href="../registration/" class="other_button"> Реєстрація</a><br>
        </form>
    </div>
</div>
</body>

