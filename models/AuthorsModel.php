<?php

class AuthorsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM questions ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function createAuthor($name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO questions VALUES(NULL, ?)");
        $statement->bind_param("s", $name);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function deleteAuthor($id) {
        $statement = self::$db->prepare(
            "DELETE FROM questions WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        return $statement->affected_rows > 0;
    }
}
