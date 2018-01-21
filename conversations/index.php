<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 20.01.2018
 * Time: 15:42
 */
require($_SERVER["DOCUMENT_ROOT"]."/templates/main/header.php");
$dialogs = new \Sql\Communication\Dialogs\Dialogs();
$dialogsArray = $dialogs->getDialogsById($_SESSION['USER_AUTH_ID']);
?>
<div class="main_window">
    <ul class="dialog_menu">
        <li class="selected"><a style="cursor: pointer">Діалоги</a></li>
        <li><a style="cursor: pointer">Перегляд діалогів</a></li>
    </ul>
    <br>
    <?php foreach ($dialogsArray as $item) : ?>
        <?php if ($item['USER_DATA'] and $item['LAST_MESSAGE']): ?>
            <a href="dialog/?id=<?= $item['USER_DATA']['user_id']; ?>">
                <div class="dialog">
                    <hr>
                        <div class="photo">
                            <img src="<?= $item['USER_DATA']['photo']; ?>"  class="dialog_photo">
                        </div>
                        <div class="namedate">
                            <?= $item['USER_DATA']['name']; ?>  <?= $item['USER_DATA']['surename']; ?>
                            <br><?= $item['LAST_MESSAGE']['time']; ?>
                        </div>
                        <div class="messag">
                            <?= $item['LAST_MESSAGE']['text']; ?>
                        </div>
                    <hr>
                </div>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/footer.php"); ?>
