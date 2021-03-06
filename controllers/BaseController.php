<?php

abstract class BaseController
{
    protected $controllerName;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isPost = false;
    protected $isLoggedIn;
    protected $isAdmin;

    function __construct($controllerName)
    {
        $this->controllerName = $controllerName;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }
        if (isset($_SESSION['user'])) {
            $this->isLoggedIn = true;
            if ($_SESSION['user']['isAdmin']) {
                $this->isAdmin = true;
            } else {
                $this->isAdmin = false;
            }
        }


        $this->onInit();
    }

    public function onInit()
    {
        // Implement initializing logic in the subclasses
    }

    public function index()
    {
        $this->renderView();
    }

    public function renderView($viewName = 'index', $includeLayout = true)
    {
        if (!$this->isViewRendered) {
            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';
            if ($includeLayout) {
                $headerFile = 'views/layouts/' . $this->layoutName . '/header.php';
                include_once($headerFile);
            }
            include_once($viewFileName);
            if ($includeLayout) {
                $footerFile = 'views/layouts/' . $this->layoutName . '/footer.php';
                include_once($footerFile);
            }
            $this->isViewRendered = true;
        }
    }

    public function redirectToUrl($url)
    {
        header("Location: " . $url);
        die;
    }

    public function redirect(
        $controllerName, $actionName = null, $params = null)
    {
        $url = '/' . urlencode($controllerName);
        if ($actionName != null) {
            $url .= '/' . urlencode($actionName);
        }
        if ($params != null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }

    public function setFormToken()
    {
        $_SESSION['formToken'] = hash('sha256', microtime());
    }

    public function getFormToken()
    {
        return $_SESSION['formToken'];
    }

    public function unsetFormToken()
    {
        unset($_SESSION['formToken']);
    }

    function addMessage($msg, $type)
    {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };
        if(empty($_SESSION['messages'])) {
            array_push($_SESSION['messages'],
                array('text' => $msg, 'type' => $type));
        }
        foreach($_SESSION['messages'] as $messages) {
            if(!in_array($msg,$messages)) {
                array_push($_SESSION['messages'],
                    array('text' => $msg, 'type' => $type));
            }
        }
    }

//    function addMessage($msg, $type)
//    {
//        if (!isset($_SESSION['messages'])) {
//            $_SESSION['messages'] = array();
//        };
//        array_push($_SESSION['messages'],
//            array('text' => $msg, 'type' => $type));
//    }

    function addInfoMessage($msg)
    {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg)
    {
        $this->addMessage($msg, 'error');
    }

    protected function getRows($rows)
    {
        $resultArray = array();
        $count = 1;
        while ($rows > 0) {
            $resultArray[] = $count;
            $rows = $rows - DEFAULT_PAGE_SIZE;
            $count++;
        }

        return $resultArray;
    }

}
