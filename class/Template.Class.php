<?php
class Template
{
    public static function getInstance(): Template
    {
        $instance = new Template();
        return $instance;
    }

    public function renderTemplate($fullpath, $title, $data = []): bool
    {
        if (file_exists($fullpath)) {
            ob_start();
            require_once $fullpath;
            $html = ob_get_clean();
        } else {
            throw new Exception("{$fullpath} not found.");
        }

        echo $html;
        return true;
    }
}
