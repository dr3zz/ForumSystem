<?php


class AdminController extends HomeController
{

    private $db;


    public function onInit()
    {
        if (!$this->isAdmin) {

            $this->title = "unahtorized";
            $this->renderView('authorized');

            die();
        }
        $this->title = "Admin";
        $this->db = new AdminModel();

    }

    public function index()
    {
        $this->redirectToUrl("/");
    }

//
//    public function index()
//    {
//        $this->categories = $this->db->getAllCategories();
//        $this->questions = $this->db->getAll();
//        $this->setFormToken();
//        $this->renderView();
//    }
//
//    public function category($id)
//    {
//        $this->questions = $this->db->getQuestionByCategoryId($id);
//        $this->categories = $this->db->getAllCategories();
//        var_dump($this->categories);
//        $this->setFormToken();
//        $this->renderView('index');
//    }

    public function controlPanel()
    {
        $this->renderView('admin-panel');
    }
//    public  function posts() {
//
//    }

    public function posts($id = 0)
    {
        if ($id == null) {
            $this->pageId = 1;
        } else {
            $this->pageId = $id;
        }
        $this->categories = $this->db->getAllCategories();
        $count = $this->db->getNumberOfRows();

        $this->questions = $this->db->getAll($id);
        if (count($this->questions) == 0) {
            $this->redirectToUrl('/');
        }

        $this->pagination = $this->getRows($count);
        $this->renderView(__FUNCTION__);
    }

    public function deletePost($id) {

        if($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $this->getFormToken()) {
                $this->addErrorMessage("Warning CSRF! ");
                $this->unsetFormToken();

                return $this->redirectToUrl('/admin/controlPanel');
            }
            $questionId = $_SESSION['questionId'];
            $isUpdate = $this->db->setDeleteFlagToPost($questionId);
            if($isUpdate) {
                if ($isUpdate) {
                    $this->addInfoMessage("Question deleted");
                    return $this->redirectToUrl('/admin/posts');
                } else {
                    $this->addErrorMessage("Error on deleting question");
                    return $this->redirectToUrl("/admin/posts/");
                }
            }

        }
        $this->post = $this->db->getPostById($id);
        if (!$this->post) {
            $this->redirect('admin', 'controlPanel');
        }
        $answersCount = $this->db->getAnswersCountByQuestionId($id);
        $this->answersCount = 0;
        if($answersCount['count'] > 0) {
            $this->answersCount = $answersCount['count'];
        }
        $_SESSION['questionId'] = $id;
        $this->setFormToken();
        $this->renderView(__FUNCTION__);
    }

    public function editPost($id)
    {
        $this->title .= ' Edit user post';

        if ($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $this->getFormToken()) {
                $this->addErrorMessage("Warning CSRF! ");
                $this->unsetFormToken();

                return $this->redirectToUrl('/admin/controlPanel');
            }
            $title = $_POST['title'];
            $content = $_POST['content'];
            $id = $_POST['postId'];
            if($id != $_SESSION['questionId']) {
                $this->addErrorMessage('Invalid question try again');
                return $this->redirectToUrl('/admin/editPost/' . $_SESSION['questionId']);
            }

            if (isset($_POST['category'])) {
                $categoryId = $_POST['category'];
            } else {
                $categoryId = null;
            }
            $isValid = true;
            if ($title == null || strlen($title) < 1) {
                $this->addErrorMessage("Title is invalid");
                $isValid = false;
            }
            if ($content == null || strlen($content) < 1) {
                $this->addErrorMessage("content is invalid");
                $isValid = false;
            }
            if ($categoryId == null) {
                $this->addErrorMessage("Please select a valid category");
                $isValid = false;
            }
            if ($isValid) {
                $isUpdate = $this->db->updatePost($id, $title, $content, $categoryId);
                if ($isUpdate) {
                    $this->addInfoMessage("Successful edit question");
                  return $this->redirectToUrl('/admin/posts/');
                } else {
                    $this->addErrorMessage("Error on editing question");
                    $this->addErrorMessage($_SESSION['questionId']);
                    return $this->redirectToUrl("/admin/editPost/" . $id);
                }
            }else{

                return $this->redirectToUrl("/admin/editPost/" . $id);
            }

        }
        $this->post = $this->db->getPostById($id);
        if (!$this->post) {
            $this->redirect('admin', 'controlPanel');
        }
        $_SESSION['questionId'] = $id;
        $this->categories = $this->db->getAllCategories();
        $this->tags = $this->db->getAllTags();
        $this->setFormToken();
        $this->renderView(__FUNCTION__);
    }

    public function editUser($id)
    {
        if ($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $this->getFormToken()) {
                $this->addErrorMessage("Warning CSRF! ");
                $this->unsetFormToken();
                return $this->redirectToUrl('/admin/controlPanel');
            }
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $isAdmin = 0;
            if (isset($_POST['isAdmin'])) {
                $isAdmin = 1;
            }
            $id = $_POST['id'];
            $isUpdate = $this->db->updateUser($id, $firstName, $lastName, $isAdmin);

            if ($isUpdate) {
                $this->addInfoMessage($isUpdate);
                return $this->redirect('admin', 'controlPanel');
            } else {
                $this->addErrorMessage($isUpdate);
                return $this->redirectToUrl("/admin/edit/user");

            }

        }

        $this->user = $this->db->getUserById($id);
        if (!$this->user) {
            $this->redirect('admin', 'controlPanel');
        }
        $this->setFormToken();
        $this->renderView('edit-user');
    }

    public function edit($param)
    {
        $this->getParam($param);
    }

    private function getParam($param)
    {

        switch ($param) {
            case 'category' :
                return $this->renderView('categories');
            case 'tags' :
                return $this->renderView('tags');
            case 'user' :
                $this->users = $this->db->getUsers();
                $this->renderView('users');
                break;

            default:
                return $this->redirectToUrl('/admin/controlPanel');
        }
    }
}