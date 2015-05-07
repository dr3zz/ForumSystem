<?php


class AccountController extends BaseController
{
    private $db;


    public function onInit()
    {
        $this->db = new AccountModel();

    }

    public function register()
    {
        $this->title = 'register';
        if($this->isLoggedIn) {
            $this->redirect('home','index');
        }
          if ($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $this->getFormToken()) {
                $this->addErrorMessage("Warning CSRF! ");
                $this->unsetFormToken();
                return $this->redirectToUrl('register');
            }
            $username = $_POST['username'];
            $email = $_POST['email'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $password = $_POST['password'];
            $isValid = true;
            if ($username == null || strlen($username) < 3 || preg_match('/[^a-zA-Z0-9]/', $username) === 1) {
                $this->addErrorMessage("Username is invalid");
                $isValid = false;
            }
            if ($password == null || strlen($password) < 4 || strlen($password) > 18) {
                $this->addErrorMessage("Password should be in range [4...18]");
                $isValid = false;
            }
            if ($email == null || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $this->addErrorMessage("Email is invalid");
                $isValid = false;
            }
            if ($firstName == null || !ctype_alpha($firstName)) {
                $this->addErrorMessage("First name is invalid");
                $isValid = false;
            }

            if ($lastName == null || !ctype_alpha($lastName)) {
                $this->addErrorMessage("Last name is invalid");
                $isValid = false;
            }
            if (!$isValid) {
               return $this->redirect('account', 'register');
            }

            $isRegister = $this->db->register($username,$email, $password,$firstName,$lastName);
            if ($isRegister) {
                  $user = $this->getUser($username);
                  $this->setLoggedUser($user);
                  $this->addInfoMessage("Successful register");
                  $this->redirect('home', 'index');
              } else {
                  $this->addErrorMessage("Register failed");
              }

        }


        $this->setFormToken();
        $this->renderView(__FUNCTION__);


    }

    public function login()
    {
        $this->title = 'login';
        if($this->isLoggedIn) {
            $this->redirect('home','index');
        }
        if ($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $this->getFormToken()) {
                $this->addErrorMessage("Warning CSRF! ");
                $this->unsetFormToken();
                return $this->redirectToUrl('login');
            }
            $username = $_POST['username'];
            $password = $_POST['password'];
            $isLoggedIn = $this->db->login($username, $password);

            if ($isLoggedIn) {
                $user = $this->getUser($username);
                $this->setLoggedUser($user);
                $this->addInfoMessage("Successful login");

                return $this->redirect('home', 'index');
            } else {
                $this->addErrorMessage("Login failed");


            }
        }
        $this->setFormToken();
        $this->renderView(__FUNCTION__);
    }

    private function setLoggedUser($user){
        $_SESSION['user'] = array();
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['username'] = $user['username'];
        $_SESSION['user']['email'] = $user['email'];
        if($user['isAdmin'] == 1) {
            $_SESSION['user']['isAdmin'] = true;
        }else {
            $_SESSION['user']['isAdmin'] = false;
        }

    }
    public function getUser($username) {
        return $this->db->getLoggedUser($username);
    }


    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['formToken']);
        $this->addInfoMessage("BYE BYE");

        $this->redirectToUrl('/');

    }
}