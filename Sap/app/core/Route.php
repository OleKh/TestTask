<?php

class Route
{

    public $filename;
    public $controller_name;
    public $action_name;

    function __construct($controller_name, $action_name)
    {
        $this->controller_name = $controller_name;
        $this->action_name = $action_name;
        self::route();
    }

    public function route()
    {
        $model_name = 'Model_' . $this->controller_name;
        $page_name = $this->controller_name;
        $this->action_name = 'action_' . $this->action_name;
        $model_file = strtolower($model_name) . '.php';
        $model_path = "app/models/" . $model_file;

        if (file_exists($model_path)) {
            include "app/models/" . $model_file;
        }

        $controller_file = strtolower($this->controller_name) . '.php';
        $controller_path = "app/controllers/" . $controller_file;
        $filename = $this->controller_name;

        try {
            if (!file_exists($controller_path))
                throw new Exception('404 ошибка - страница ' . $filename . ' не найдена');
            else
                include "app/controllers/" . $controller_file;
        } catch (Exception $e) {
            die ($e->getMessage());
        }

        $controller = new $this->controller_name($page_name);
        $action = $this->action_name;

        try {
            if (!method_exists($controller, $action))
                throw new Exception('404 ошибка - страница ' . $this->action_name . ' не найдена');
            else
                $controller->$action();
        } catch (Exception $e) {
            die ($e->getMessage());
        }
    }
}