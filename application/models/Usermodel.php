<?php
class Usermodel extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    function checkLength($value, $min, $max)
    {
        if (mb_strlen($value) < $min || mb_strlen($value) > $max)
            return FALSE;
        return TRUE;
    }

    function checkRegData($data)
    {
        foreach($data as $value) {
            if ($value != $this->clean($value)) return 1;
        }
        if (!$this->checkLength($data['password'], 8, 20)) return 2;
        if (!$this->checkLength($data['username'], 4, 20)) return 3;
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) return 4;
        if (!$this->isUsernameUnique($data['username'])) return 5;
        return FALSE;
    }

    function isUsernameUnique($username)
    {
        $this->db->select('username')
            ->from('users')
            ->where('username', $username);
        $query = $this->db->get();
        $answer = $query->row();
        if (isset($answer))
            return FALSE;
        return TRUE;
    }

    public function checkAuthentication($username, $password) {
        $this->db->select('id, first_name, last_name, password')
            ->from('users')
            ->where('username', $username);
        $query = $this->db->get();
        $answer = $query->row();
        if (isset($answer) && password_verify($password, $answer->password))
            return $answer;
        return FALSE;
    }

    public function getProfileData($id) {
        $this->db->select('first_name, last_name')
            ->from('users')
            ->where('id', $id);
        $query = $this->db->get();
        $answer = $query->row();
        if (isset($answer))
            return $answer;
        return FALSE;
    }

    public function getProfilesList() {
        $this->db->select('first_name, last_name, id')
            ->from('users');
        $query = $this->db->get();
        $answer = $query->result();
        if (isset($answer))
            return $answer;
        return FALSE;
    }

    public function createUser($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->db->set($data);
        $this->db->insert('users');
    }
}
?>