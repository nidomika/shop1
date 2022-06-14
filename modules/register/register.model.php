<?php
class RegisterModel
{
    private $db;

    function __construct()
    {
        $this->db = $GLOBALS["db"];
    }

    public function checkIfUserExists($username)
    {
        $stmt = $this->db->prepare("SELECT login FROM users WHERE login = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        return $user;
    }

    public function saveUser($userData, $hobbies)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO `users` (`name`, `last_name`, `email`, `login`, `password`, `address`, `city`, `zip_code`, `country`, `education`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute($userData);

        if (isset($hobbies)) {
            $id = $this->db->lastInsertId();
            $stmt = $this->db->prepare("INSERT INTO `hobbies` (`user_id`, `hobby`) VALUES (?, ?)");

            foreach ($hobbies as $hobby) {
                $stmt->execute([$id, $hobby]);
            }
        }
    }
}
