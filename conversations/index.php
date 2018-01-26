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
    <br><br>
    <?php foreach ($dialogsArray as $item) : ?>
        <?php if ($item['USER_DATA'] and $item['LAST_MESSAGE']): ?>
            <a href="dialog/?id=<?= $item['USER_DATA']['USER_ID']; ?>">
                <div class="dialog">
                    <hr>
                        <div class="photo">
                            <img src="<?= $item['USER_DATA']['PHOTO']; ?>"  class="dialog_photo">
                        </div>
                        <div class="namedate">
                            <?= $item['USER_DATA']['NAME']; ?>  <?= $item['USER_DATA']['SURENAME']; ?>
                            <br><?= $item['LAST_MESSAGE']['DATA_TIME']; ?>
                        </div>
                        <div class="messag">
                            <?= $item['LAST_MESSAGE']['TEXT']; ?>
                        </div>
                    <hr>
                </div>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/footer.php"); ?>
