<div class="middle">
    <div class="container">
        <div class="content">
            <table>
                <tr>
                    <form action="<?php echo base_url('user/reg')?>" method="post">
                        <th>
                            E-mail: <br><input name="email" type="text" maxlength="20" required><br><br>
                            Пароль: <br><input name="password" type="password" maxlength="20" required><br><br>
                            <br><input type="submit" value="Зарегистрироваться">
                        </th>
                        <th width="50px"></th>
                        <th>
                            Логин: <br><input name="username" type="text" maxlength="20" required><br><br>
                            Имя: <br><input name="first_name" type="text" maxlength="20" required><br><br>
                            Фамилия: <br><input name="last_name" type="text" maxlength="20" required><br><br>
                        </th>

                    </form>
                </tr>
            </table>

            <? if (isset($message))
                echo '<span id="error">'.$message.'</span>'; ?>
        </div>
    </div>
    <aside class="left-sidebar">
        <?php include "menu.php"; ?>
        <?php include "profileslist.php"; ?>
    </aside><!-- .left-sidebar -->
</div><!-- .middle-->