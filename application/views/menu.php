<h5>Меню:</h5>
<ul>
    <? if (isset($loggedIn)) { ?>
        <li><?php echo anchor('main/profile/'.$id, 'Моя страница'); ?></li>
        <li><?php echo anchor('main/comments', 'Мои комментарии'); ?></li>
        <li><?php echo anchor('user/logout', 'Выход'); ?></li>
    <? } else { ?>
        <li><?php echo anchor('main/register', 'Регистрация'); ?></li>
        <li><?php echo anchor('main/login', 'Авторизация'); ?></li>
    <? } ?>

</ul>
