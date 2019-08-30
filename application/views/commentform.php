<div class="commentform">
    <form id="<? echo $id; ?>">
        <h5>Написать комметарий:</h5>
        Заголовок: <input id="title" name="title" type="text" maxlength="60"><br>
        Тема: <br><input id="theme" name="theme" type="text" maxlength="60"><br>
        Текст комментария: <br><textarea id="text" name="text" type="text" maxlength="500" required></textarea><br>
        <input class="add_comment" type="button" value="Отправить">

        <div id="commentform" class="quotefield">

            <input class="cancel_quote" type="button" value="Убрать цитирование">
        </div>

    </form>
</div>