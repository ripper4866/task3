<?php
class Commentsmodel extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function getCommentsList($id, $byWhosId = "recipients", $limit = 0, $offset = 0) {
        $this->db->select('commentAuthor.first_name, commentAuthor.last_name, comment.date_time, comment.text, 
            comment.id, comment.senders_id, comment.recipients_id, comment.isInheritor, comment.title, comment.theme,
            parentAuthor.first_name as parent_first_name, parentAuthor.last_name as parent_last_name,
            parent.date_time as parent_date_time, parent.text as parent_text')
            ->from('comments as comment')
            ->join('users as commentAuthor', 'commentAuthor.id=comment.senders_id', 'left')
            ->join('comments as parent', 'parent.id=comment.parentId', 'left')
            ->join('users as parentAuthor', 'parentAuthor.id=parent.senders_id', 'left');
        $this->db->where('comment.'.$byWhosId.'_id', $id);
        $this->db->order_by('date_time', 'DESC');
        if ($limit > 0) $this->db->limit($limit+1, $offset);
        else if ($offset > 0) {
            $this->db->limit(1000000000, $offset);
        }
        $query = $this->db->get();
        $comments = $query->result();
        if (!isset($comments)) return FALSE;
        if (count($comments) <= $limit || $limit == 0) {
            if (count($comments) == 0 && $offset == 0) $allCommentsLoaded = 'Комментариев пока нет.';
            else $allCommentsLoaded = 'Все комментарии загружены';
        }
        else $allCommentsLoaded = '';
        if ($limit > 0) $end = array_pop($comments);
        array_push($comments, $allCommentsLoaded);
        return $comments;
    }

    public function setComment($data) {
        $this->checkData($data);
        $this->db->set($data);
        $this->db->insert('comments');
    }

    public function getCommentsParent($id) {
        $this->db->select('first_name, last_name, date_time, text');
        $this->db->from('users');
        $this->db->join('comments', 'users.id = comments.senders_id', 'right');
        $this->db->where('comments.id', $id);
        $query = $this->db->get();
        $comment = $query->row();
        return $comment;
    }

    public function deleteComment($id) {
        $this->db->delete('comments', array('id' => $id));
    }
}
?>