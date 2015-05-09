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



    public function getPostById($id)
    {
        $statement = self::$db->prepare("SELECT q.id,q.content,q.title, u.username,q.created_at,q.category_id,c.name
FROM questions q
left join users u
on u.id = q.user_id
left join categories c
on c.id = q.category_id
where q.id = ?");
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
        return $statement->affected_rows > 0;
    }

    public function updatePost($id, $title, $content, $categoryId)
    {

        $statement = self::$db->prepare("
            UPDATE questions SET title = ?, content = ?, category_id = ?,update_at = now() WHERE id = ?");
        $statement->bind_param('ssii', $title, $content, $categoryId, $id);
        $statement->execute();

        return $statement->affected_rows > 0;
    }

    public function setDeleteFlagToPost($id) {
        $statement = self::$db->prepare("
            UPDATE questions SET  is_deleted = 1 WHERE id = ?");
        $statement->bind_param('i', $id);
        $statement->execute();

        return $statement->affected_rows > 0;
    }

    public function getAnswersCountByQuestionId($id) {
        $statement = self::$db->prepare(
            "SELECT count(a.id) as count FROM answers a left outer join questions q on q.id = a.questions_id where q.id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

}