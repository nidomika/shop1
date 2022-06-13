<?php
function generateRandomString($length = 69)
{
    return substr(str_shuffle(str_repeat($x = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", ceil($length / strlen($x)))), 1, $length);
}

class SessionModel
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function create($userId)
    {
        $sessionKey = generateRandomString();
        $stmt = $this->db->prepare("INSERT INTO `sessions` (`user_id`, `session_key`) VALUES (?, ?)");
        echo $sessionKey;
        $stmt->execute([$userId, $sessionKey]);
        $session = $stmt->fetch();

        return $sessionKey;
    }

    public function delete($sessionId)
    {
        $stmt = $this->db->prepare("DELETE FROM `sessions` WHERE `id` = ?");
        $stmt->execute([$sessionId]);
    }

    public function getUserBySessionKey($sessionKey)
    {
        $stmt = $this->db->prepare("SELECT `user_id` FROM `sessions` WHERE `session_key` = ?");

        $stmt->execute([$sessionKey]);
        $userId = $stmt->fetch();
        if ($userId != false) {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `id` = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch();

            return $user;
        }

        return false;
    }
}
