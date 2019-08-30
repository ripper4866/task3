<div class="commentlist">
    <strong>Комментарии:</strong>
    <ul- class="comments">
        <? $allCommentsLoaded = array_pop($comments) ?>
        <? foreach ($comments as $comment): ?>
            <li class="comment"><?= $comment->first_name.' '.$comment->last_name.' '.$comment->date_time ?><br>
            <h5><?= $comment->title ?></h5><h6><?= $comment->theme ?></h6>
            <?= $comment->text ?><br>
            <? if (isset($loggedIn)) echo '<input class="answer_comment" type="button" value="Ответить" name="'.$comment->id.'">'; ?>
            <? if (isset($loggedIn) && ($comment->senders_id == $_SESSION['id'] || $comment->recipients_id == $_SESSION['id']))
                echo '<input class="delete_comment" type="button" value="Удалить" name="'.$comment->id.'">'; ?>
            <? if ($comment->isInheritor != TRUE) {echo '</li>'; continue;} ?>
                <div class="quotefield">
                    <div class="quote">
                        <?
                            if ($comment->parent_text == NULL) echo 'Цитируемый комментарий удален';
                            else echo 'В ответ на комментарий пользователя '.$comment->parent_first_name.' '.$comment->parent_last_name.
                            ' от '.$comment->parent_date_time.':<br>'.$comment->parent_text;
                        ?>
                    </div>
                </div>
            </li>
        <? endforeach; ?>
        <? if ($allCommentsLoaded == '') echo '<input class="show_more" type="button" value="Показать еще" name="'.$id.'">';
            else echo '<li class="comment">'.$allCommentsLoaded.'</li>'; ?>
    </ul->
</div>