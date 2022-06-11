<?php
require_once "./db.php";

class RegisterModel
{
    private $db;

    function __construct()
    {
        global $db;
        $this->db = $db;
    }

    public function checkIfUserExists($username)
    {
        $stmt = $this->db->prepare("SELECT login FROM users WHERE login = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        return $user;
    }
}
