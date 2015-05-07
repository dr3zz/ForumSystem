<?php


class AdminController extends HomeController
{

    private $db;


    public function onInit()
    {
        $this->title = "Admin";
        $this->db = new AdminModel();

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

    public function editUser($id = null)
    {
        if ($this->isPost) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $isAdmin = 0;
            if (isset($_POST['isAdmin'])) {
                $isAdmin = 1;
            }
            $id = $_POST['id'];
            $isUpdate = $this->db->updateUser($id, $firstName, $lastName, $isAdmin);

            if ($isUpdate) {
                $this->addInfoMessage("Update user successful");
                return $this->redirect('admin', 'controlPanel');
            } else {
                $this->addErrorMessage($isUpdate);
                return $this->redirectToUrl("/admin/edit/user");

            }

        }
        if ($id == null) {
            $this->redirect('admin', 'controlPanel');
        }

        $this->user = $this->db->getUserById($id);
        if (!$this->user) {
            $this->redirect('admin', 'controlPanel');
        }
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
            case 'posts' :
                return $this->renderView('posts');
            default:
                return $this->redirectToUrl('/admin/controlPanel');
        }
    }
}