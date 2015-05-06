<?php

class HomeController extends BaseController {

    private $db;


    public function onInit()
    {
        $this->title = "Home";
        $this->db = new QuestionsModel();

    }
    public function index(){
        $this->categories = $this->db->getAllCategories();
        $this->questions = $this->db->getAll();
        $this->setFormToken();
        $this->renderView();
    }

    public function category($id) {
        $this->questions = $this->db->getQuestionByCategoryId($id);
        $this->categories = $this->db->getAllCategories();

        $this->setFormToken();
        $this->renderView('index');
    }


}