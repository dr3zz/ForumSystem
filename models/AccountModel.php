<?php


class AccountModel extends BaseModel
{
    public function register($username, $email, $password, $firstName, $lastName)
    {
        $statement = self::$db->prepare("SELECT COUNT(id)from users WHERE username=? or email=?");
        $statement->bind_param('ss', $username, $email);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if ($result['COUNT(id)']) {
            return false;
        }
//        $username = mysqli_real_escape_string($username);
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $registerStatement = self::$db->prepare("INSERT INTO users(username,email,pass_hash,first_name,last_name) VALUES(?, ?, ?, ?, ?)");
        $registerStatement->bind_param("sssss", $username, $email, $hash_pass, $firstName, $lastName);
        $registerStatement->execute();
        return true;
    }

    public function login($username, $password)
    {
        $statement = self::$db->prepare("SELECT id,username,pass_hash FROM users WHERE username = ?");
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if (password_verify($password, $result['pass_hash'])) {

            return true;
        }

        return false;


    }

    public function getLoggedUser($username){
        $statement = self::$db->prepare("SELECT id,username,isAdmin,email FROM users WHERE username = ?");
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

}