<?php


class AdminModel extends QuestionsModel
{

    public function getUsers()
    {

        $id = $_SESSION['user']['id'];

        $statement = self::$db->prepare(
            "SELECT id,username FROM users WHERE username != 'admin' and id != ? ORDER BY id");

        $statement->bind_param('i', $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQL_ASSOC);
    }

    public function getUserById($id)
    {
        $statement = self::$db->prepare("SELECT id,username,email,first_name,last_name,isAdmin FROM users where id = ?");
        $statement->bind_param('s', $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function updateUser($id, $firstName, $lastName, $isAdmin)
    {

        $statement = self::$db->prepare(
            "UPDATE users SET first_name = ? ,last_name = ?, isAdmin = ? WHERE id = ?");
        $statement->bind_param("ssii", $firstName, $lastName, $isAdmin, $id);
        $statement->execute();
//        var_dump($statement);

        return $statement->affected_rows > 0;
    }
}