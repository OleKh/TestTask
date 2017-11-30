<?php
 class Controller {
    public $model;
    public $view;
    const HTTP_PATH = 'http://test-task/';

    function __construct (){
        $this->model = new Model();
    }

    function generate ($content_view, $template_view, $data = null){
          include 'app/views/'.$template_view;
    }

}