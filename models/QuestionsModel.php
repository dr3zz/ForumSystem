<?php


class QuestionsModel extends BaseModel
{


    public function getNumberOfRows($id = null)
    {
        if ($id != null) {
            $statement = self::$db->prepare("SELECT id from questions where category_id = ?");
            $statement->bind_param('i', $id);
            $statement->execute();
            $statement->store_result();
            return $statement->num_rows;
        } else {
            $statement = self::$db->query('select id from questions');
        }

        return mysqli_num_rows($statement);
    }

    public function getAll($id)
    {
        if ($id > 0) {
            $id = $id - 1;
        }
        $pageSize = DEFAULT_PAGE_SIZE;
        $statement = self::$db->prepare(
            "SELECT q.id,q.content,q.title, u.username,q.created_at,q.visits,count(a.id) as answersCount
FROM questions q
left join users u
on u.id = q.user_id
left join answers a
on q.id = a.questions_id

group by q.id limit ?, ?");
        $id = $id * $pageSize;
        $statement->bind_param('ii', $id, $pageSize);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionByCategoryId($categoryId, $id)
    {
        if ($id > 0) {
            $id = $id - 1;
        }
        $pageSize = DEFAULT_PAGE_SIZE;
        $statement = self::$db->prepare(
            "SELECT q.id,q.content,q.title, u.username,q.created_at,q.visits,q.category_id, count(a.id) as answersCount
FROM questions q
left outer  join users u
on u.id = q.user_id
left outer join answers a
on a.questions_id = q.id
group by q.id
HAVING q.category_id = ?
ORDER BY q.id
limit ?, ?");
        $id = $id * $pageSize;
        $statement->bind_param('iii', $categoryId, $id, $pageSize);
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

    public function addAnswerToQuestion($questionId, $name, $comment, $email = null, $isRegistered = 0)
    {
        if ($email == null) {
            $email = '';
        }
        $statement = self::$db->prepare(
            "INSERT INTO answers (name,email,comment,questions_id,is_registered) VALUES(?, ?, ?, ?, ?)");
        $statement->bind_param("sssii", $name, $email, $comment, $questionId, $isRegistered);
        $statement->execute();
        return $statement->affected_rows > 0;
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

    public function viewAnswersByQuestionId($questionId)
    {

        $statement = self::$db->prepare(
            "SELECT name, comment,is_registered,posted_at as timediff FROM answers where questions_id = ? ORDER BY id");
        $statement->bind_param("i", $questionId);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQL_ASSOC);

    }
}