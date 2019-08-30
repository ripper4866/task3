<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Commentsmodel');
    }

    public function postNewComment() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['commentTitle'];
            $theme = $_POST['commentTheme'];
            $text = $_POST['commentText'];
            if (isset($_POST['parentId'])) $parentId = $_POST['parentId'];
            else $parentId = NULL;
            $recipients_id = $_POST['recipients_id'];
            if (empty($title)) $title = 'Не указано';
            if (empty($theme)) $theme = 'Не указано';
            if (empty($text) || empty($recipients_id)) return;
            $data = array(
                'senders_id'    => $_SESSION['id'],
                'recipients_id' => $recipients_id,
                'text'          => $text,
                'isInheritor'   => !is_null($parentId),
                'parentId'      => $parentId,
                'theme'         => $theme,
                'title'         => $title
            );
            $checkRegData = $this->Commentsmodel->setComment($data);
            echo json_encode(array(
                'result'    => 'success'
            ));

        }
    }

    public function getMoreComments() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $comments = $this->Commentsmodel->getCommentsList($id, "recipients", 0, 5);
            $html = "";
            $allCommentsLoaded = array_pop($comments);
            foreach ($comments as $comment) {
                $html .= '
                    <li class="comment">'.$comment->first_name.' '.$comment->last_name.
                    '<br>'.$comment->date_time.
                    '<br>'.$comment->text.'<br>
                    <input type="button" form="commentform" value="Ответить"></li>';
            }
            $html .= '<li class="comment">'.$allCommentsLoaded.'</li>';
            echo json_encode(array(
                'result'    => 'success',
                'html'      => $html
            ));
        }
    }

    public function deleteComment() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $comments = $this->Commentsmodel->deleteComment($id);
            echo json_encode(array(
                'result'    => 'success'
            ));
        }
    }

    public function answerComment() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $comment = $this->Commentsmodel->getCommentsParent($id);
            $html = '
                <div id="commentform" class="quote" name="'.$id.'">
                    <h6>В ответ на комментарий пользователя '.$comment->first_name.' '.$comment->last_name.
                    ' от '.$comment->date_time.':</h6>
                    '.$comment->text.'
                </div>';
            echo json_encode(array(
                'result'    => 'success',
                'html'      => $html
            ));
        }
    }

    public function getProfilesList() {
        return $this->Commentsmodel->getCommentsList();
    }

}
?>