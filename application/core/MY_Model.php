<?php
class MY_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function clean($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    function checkData($data)
    {
        foreach($data as $value) {
            $value != $this->clean($value);
        }
    }
}
?>