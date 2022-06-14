<?php
function generateRandomString($length = 69)
{
    return substr(str_shuffle(str_repeat($x = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", ceil($length / strlen($x)))), 1, $length);
}

class SessionModel
{
    private $db;

    function __construct()
    {
        $this->db = $GLOBALS["db"];
    }

    public function create($userId)
    {
        $sessionKey = generateRandomString();
        $stmt = $this->db->prepare("INSERT INTO `sessions` (`user_id`, `session_key`) VALUES (?, ?)");
        $stmt->execute([$userId, $sessionKey]);
        $session = $stmt->fetch();

        return $sessionKey;
    }

    public function delete($sessionKey)
    {
        $stmt = $this->db->prepare("DELETE FROM `sessions` WHERE `session_key` = ?");
        $stmt->execute([$sessionKey]);
    }

    public function getUserBySessionKey($sessionKey)
    {
        $stmt = $this->db->prepare("SELECT `user_id` FROM `sessions` WHERE `session_key` = ?");
        $stmt->execute([$sessionKey]);
        $session = $stmt->fetch();

        if ($session != false) {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `id` = ?");
            $stmt->execute([$session["user_id"]]);
            $user = $stmt->fetch();

            return $user;
        }

        return false;
    }
}
