<?php
session_start();

include "../config.php";
include "DataBase.Class.php";
include "Template.Class.php";

class Task
{
    public ?object $mysql;
    public ?object $temlate_obj;
    public int $user_id;

    public function __construct($user_id)
    {
        $this->mysql = DataBase::getInstance();
        $this->temlate_obj = Template::getInstance();
        $this->user_id = $user_id;
    }

    public function getTaskList()
    {
        //$data = [];
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) {
            $sql = "SELECT t.*,s.status_name,u.name  FROM tasks t JOIN statuses s ON t.status_id = s.id JOIN users u ON t.user_id = u.id";
            $taskList = $this->mysql->completeQuery($sql);
        } else {
            $sql = "SELECT t.*,s.status_name  FROM tasks t JOIN statuses s ON t.status_id = s.id WHERE user_id = ?";
            $stmt = $this->mysql->prepare($sql);
            $stmt->execute([$this->user_id]);
            $taskList = $stmt->fetchAll();
        }
        echo json_encode($taskList, JSON_UNESCAPED_UNICODE);
    }

    public function getStatusesList()
    {
        $sql = "SELECT * FROM statuses";
        $statusList = $this->mysql->completeQuery($sql);
        echo json_encode($statusList, JSON_UNESCAPED_UNICODE);
    }

    public function createTask()
    {
        $sql = "INSERT INTO tasks (user_id, title, description, status_id) VALUES (?,?,?,?)";
        $stmt = $this->mysql->prepare($sql);
        $stmt->execute([$_POST['user_id'], $_POST['title'], $_POST['description'], 1]);
        echo json_encode(true, JSON_UNESCAPED_UNICODE);
    }

    public function saveTask()
    {
        $currentDateTime = date("Y-m-d H:i:s");
        $sql = "UPDATE tasks SET status_id = ?,answ = ?,tags = ?,updated_at = ?  WHERE id = ?";
        $stmt = $this->mysql->prepare($sql);
        $stmt->execute([$_POST['status_id'], $_POST['answ'], $_POST['tags'], $currentDateTime, $_POST['id']]);
        echo json_encode(true, JSON_UNESCAPED_UNICODE);
    }
}

$task_obj = new Task($_GET['user_id']);

if (isset($_GET['get_task']) && $_GET['get_task'] == 1) {
    $data = $task_obj->getTaskList();
}

if (isset($_GET['get_statuses']) && $_GET['get_statuses'] == 1) {
    $data = $task_obj->getStatusesList();
}

if (isset($_GET['create_task']) && $_GET['create_task'] == 1) {
    $data = $task_obj->createTask();
}

if (isset($_GET['save_task']) && $_GET['save_task'] == 1) {
    $data = $task_obj->saveTask();
}
