<?php


class QuestionsController extends BaseController {
    public function onInit() {
        $this->title = "Home";
        $this->db = new QuestionsModel();
    }

    public function create() {
        if(!$this->isLoggedIn) {
            $this->redirect('home','index');
        }
        if ($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $this->getFormToken()) {
                $this->addErrorMessage("Warning CSRF! ");
                $this->unsetFormToken();
                return $this->redirectToUrl('/');
            }
            $title = $_POST['title'];
            $content = $_POST['content'];
            if(isset($_POST['category'])) {
                $categoryId = $_POST['category'];
            }else {
                $categoryId = null;
            }
            $tags = array();
            if(!empty($_POST['check_tags'])) {
                foreach($_POST['check_tags'] as $tag){
                    $tags[] = $tag;
                }
            }


            $userId = $_SESSION['user']['id'];

            $isValid = true;
            if($title == null || strlen($title)  <  1) {
                $this->addErrorMessage("Title is invalid");
                $isValid = false;
            }
            if($content == null || strlen($content)  <  1) {
                $this->addErrorMessage("content is invalid");
                $isValid = false;
            }
            if($categoryId == null) {
                $this->addErrorMessage("Please select a valid category");
                $isValid = false;
            }

            if($isValid){
                if($this->db->createQuestion($title,$content,$userId,$categoryId)) {
                    $this->addInfoMessage("Question created.");
                    if(count($tags) > 0) {

                        $questionId = $this->db->lastQuestionId($userId);
                       var_dump($this->db->insertQuestionTag($questionId,$tags));
                        $this->db->insertQuestionTag($questionId,$tags);
                    }

                   $this->addInfoMessage($questionId);
                    $this->redirectToUrl('/');
                }
                else {
                    $this->addErrorMessage("Error creating question.");
                }
            }


        }
        $this->categories = $this->db->getAllCategories();
        $this->tags = $this->db->getAllTags();
        $this->renderView(__FUNCTION__);
    }
    public function view($id) {
        $this->question = $this->db->viewQuestion($id);
        if(empty($this->question)){
            $this->addErrorMessage("Invalid quiestion");
            $this->redirectToUrl('/');
        }
        $this->db->addVisit($id);

        $this->renderView('view');
    }

    public function addComment() {
        if($this->isPost) {

        }
    }



}