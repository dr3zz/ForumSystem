<?php


class QuestionsModel extends BaseModel
{


    public function getAll()
    {
        $statement = self::$db->query(
            "SELECT q.id,q.content,q.title, u.username,q.created_at,q.visits,q.answersCount FROM questions q
join users u
on u.id = q.user_id ORDER BY q.id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionByCategoryId($id)
    {
        $statement = self::$db->prepare(
            "SELECT q.id,q.content,q.title, u.username,q.created_at,q.visits,q.answersCount FROM questions q
        join users u on u.id = q.user_id WHERE q.category_id = ? ORDER BY q.id");
        $statement->bind_param('i', $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTags()
    {
        $statement = self::$db->query(
            "SELECT id,name FROM tags ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllCategories()
    {
        $statement = self::$db->query(
            "SELECT c.id, c.name, count(q.id) as count FROM categories c left outer join questions q on c.id = q.category_id group by c.id,c.name");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function createQuestion($title, $content, $userId, $categoryId)
    {
        if ($title == '' || $content == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO questions (title,content,user_id,category_id) VALUES(?, ?, ?, ?)");
        $statement->bind_param("ssii", $title, $content, $userId, $categoryId);
        $statement->execute();

        return $statement->affected_rows > 0;
    }

    public function insertQuestionTag($questionId, $array)
    {


        foreach ($array as $tag) {
            $statement = self::$db->prepare(
                "INSERT INTO questions_tags (questions_id,tags_id) VALUES(?, ?)");
            $statement->bind_param("ii", $questionId, $tag);
            $statement->execute();
        }


        return $statement->affected_rows > 0;

    }


    public function viewQuestion($id)
    {
        $statement = self::$db->prepare(
            "SELECT q.title,q.content, u.username,q.created_at,q.id FROM questions q join users u on u.id = q.user_id WHERE q.id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();


        return $statement->get_result()->fetch_assoc();
    }

    public function addVisit($id)
    {
        $statement = self::$db->prepare(
            "UPDATE questions SET visits = visits + 1 WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function lastQuestionId($userId)
    {
        $statement = self::$db->prepare(
            "SELECT id FROM questions where user_id=? ORDER BY id DESC limit 1");
        $statement->bind_param("i", $userId);
        $statement->execute();

        return $statement->get_result()->fetch_assoc()['id'];

    }
}