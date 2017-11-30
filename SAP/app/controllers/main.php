<?php
class Main extends Controller {

    public $page_name;

    function __construct ($page_name){
        $this->page_name = $page_name;
    }

    function action_index (){
        $this->generate($this->page_name.'.phtml', 'template.phtml', array());
    }

}