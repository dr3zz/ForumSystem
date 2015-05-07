<?php

class HomeController extends BaseController
{

    private $db;


    public function onInit()
    {
        $this->title = "Home";
        $this->db = new QuestionsModel();

    }

    public function index($id = null)
    {
        if ($id == null) {
            $this->pageId = 1;
        } else {
            $this->pageId = $id;
        }
        $this->categories = $this->db->getAllCategories();
        $count = $this->db->getNumberOfRows();

        $this->questions = $this->db->getAll($id);
        if(count($this->questions) == 0) {
            $this->redirectToUrl('/');
        }

        $this->pagination = $this->getRows($count);
        $this->setFormToken();
        $this->renderView(__FUNCTION__);
    }

    public function category($categoryId, $id = null)
    {
        $this->categoryId = $categoryId;
        if ($id == null) {
            $this->pageId = 1;
        } else {
            $this->pageId = $id;
        }
        $this->questions = $this->db->getQuestionByCategoryId($categoryId, $id);
        if(count($this->questions) == 0) {
            $this->redirectToUrl('/');
        }
        $this->categories = $this->db->getAllCategories();
        $count = $this->db->getNumberOfRows($categoryId);
        $this->pagination = $this->getRows($count);
        $this->setFormToken();
        $this->renderView('category');
    }


}