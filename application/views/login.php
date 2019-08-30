<div class="middle">
    <div class="container">
        <div class="content">
                <strong>Приветствуем пользователей, новых и старых!</strong>
        </div>
    </div>


    <aside class="left-sidebar">
        <?php include "profileslist.php"; ?>
    </aside><!-- .left-sidebar -->

    <aside class="right-sidebar">
        <form action="<?php echo base_url('user/auth')?>" method="post">
            Логин: <br><input name="username" type="text" maxlength="20" required><br><br>
            Пароль: <br><input name="password" type="password" maxlength="20" required><br><br>
            <?php echo anchor('main/register', 'Регистрация'); ?><br>
            <input type="submit" value="Вход">
            <? if (isset($message))
                echo '<span id="error">'.$message.'</span>'; ?>
        </form>
    </aside><!-- .right-sidebar -->

</div><!-- .middle-->