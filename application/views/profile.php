<div class="middle">
    <div class="container">
        <div class="content">
            <table>
                <tr>
                    <th>
                        <div class="userPhoto">
                            <strong><?php echo $id; ?></strong>
                        </div>
                    </th>
                    <th>
                        <div class="userInfo">
                            <h2><?php echo $first_name.' '.$last_name ?></h2>
                            <h5>О себе: здесь каждый пользователь мог бы написать о себе. Очень жаль, что разработчику не особо интересно, что могли бы написать о себе пользователи в графе "О себе"</h5>
                        </div>
                    </th>
                </tr>
            </table>
            <?php if (isset($loggedIn)) include "commentform.php"; ?>
            <?php include "commentlist.php"; ?>
        </div>
    </div>

    <aside class="left-sidebar">
        <?php include "menu.php"; ?>
        <?php include "profileslist.php"; ?>
    </aside><!-- .left-sidebar -->

</div><!-- .middle-->