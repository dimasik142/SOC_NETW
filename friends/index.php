<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 20.01.2018
 * Time: 21:01
 */
require($_SERVER["DOCUMENT_ROOT"]."/templates/main/header.php");
$person = new \Sql\Person\Person();
$userData = $person->getAllUsers($_SESSION['USER_AUTH_ID']);
?>
<link rel="stylesheet" href="/templates/main/css/friends.css" />

<div class="main_window">
    <?php foreach ($userData as $item) { ?>
        <div id="newFriends">
            <div id="friend_block">
                <div id="picture">
                    <p><img src="<?= $item['DATA']['PHOTO'] ? $item['DATA']['PHOTO'] : '/upload/images/nophoto.jpg'?>" id ="friendPhoto"></p>
                </div>
                <div id="user_data"><br><br>
                    <?= $item['DATA']['NAME'] ?>
                    <?= $item['DATA']['SURENAME'] ?><br>
                    <a type="button" href="/conversations/dialog/?id=<?= $item['LOGIN']['USER_ID'] ?>"><img src="/upload/images/mail.png" width="70" height="70"></a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/footer.php"); ?>