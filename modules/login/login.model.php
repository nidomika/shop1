<?php
class LoginModel
{
    private $db;

    function __construct()
    {
        $this->db = $GLOBALS["db"];
    }

    public function getUserIdByUsernameAndPassword($username, $password)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE login = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();
        if ($user != false) {
            return $user["id"];
        }
        return false;
    }
}
