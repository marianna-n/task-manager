<?php

class Auth
{
    public ?object $mysql;
    public ?object $temlate_obj;
    public $title = "Авторизация";

    public function __construct()
    {
        $this->mysql = DataBase::getInstance();
        $this->temlate_obj = Template::getInstance();
    }

    public function index()
    {

        $fullpath = __DIR__ . '/../views/auth.tpl.php';

        $this->temlate_obj->renderTemplate($fullpath, $this->title);
    }

    public function checkUserPassword(string $email, string $password)
    {
        $email = trim($email);
        $stmt = $this->mysql->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($row = $stmt->fetch()) {
            if (!password_verify($password, $row['password'])) {
                $_SESSION['errors'] = 'Wrong email or password';
                return false;
            }
        } else {
            $_SESSION['errors'] = 'Wrong email or password';
            return false;
        } 

        foreach ($row as $key => $value) {
            if ($key != 'password') {
                $_SESSION['user'][$key] = $value;
            }
        }
        $_SESSION['success'] = 'Successfully login';
        return true;
    }

    public function check_auth(): bool
    {
        return isset($_SESSION['user']);
    }
}
