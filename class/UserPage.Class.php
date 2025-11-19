<?php


class UserPage
{
    public ?object $mysql;
    public ?object $temlate_obj;
    public $title = "Home";

    public function __construct()
    {
        $this->mysql = DataBase::getInstance();
        $this->temlate_obj = Template::getInstance();
    }

    public function index()
    {
        $data = [];
        if ($this->check_admin()) {
            $sql = "SELECT * FROM statuses";
            $statusList = $this->mysql->completeQuery($sql);
            $data['statuses'] = $statusList;
            $fullpath = __DIR__ . '/../views/adminpage.tpl.php';
        } else {
            $fullpath = __DIR__ . '/../views/userpage.tpl.php';
        }
        $this->temlate_obj->renderTemplate($fullpath, $this->title, $data);
    }

    private function check_admin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 2;
    }

    public function registerUser(): bool
    {
        $fullpath = __DIR__ . '/../views/register.tpl.php';
        return $this->temlate_obj->renderTemplate($fullpath, 'Авторизация');
    }

    public function saveNewUser(array $data): bool
    {
        $data['email'] = trim($data['email']);
        $data['name'] = trim($data['name']);
        $stmt = $this->mysql->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$data['email']]);
        if ($stmt->fetchColumn()) {
            $_SESSION['errors'] = 'This email is already taken';
            return false;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        unset($data['register']);
        $stmt = $this->mysql->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute($data);
        $_SESSION['success'] = 'You have successfully registered';

        return true;
    }
}
