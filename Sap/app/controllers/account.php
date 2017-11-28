<?php

class Account extends Controller
{

    public $page_name;

    function __construct($page_name)
    {
        $this->page_name = $page_name;
        $this->model = new Model_Account();
    }

    function action_index()
    {
        $data = array();
        if (isset($_REQUEST['q']) && !empty($_REQUEST['q'])) {
            $params = base64_decode($_REQUEST['q']);
            $paramsArr = explode('&', $params);
            foreach ($paramsArr as $param) {
                $paramArr = explode('=', $param);
                if ($paramArr[0] == 'login_id') {
                    $data['login_id'] = $paramArr[1];
                }
            }
        }

        if (!empty($_POST['login_id']) &&
            !empty($_POST['firstname']) &&
            !empty($_POST['telephone'])
        ) {
            if (!$this->_validate($_POST)) {
                echo 'Data not valid';
                return;
            }
            $data['login_id'] = $_POST['login_id'];
            $data['firstname'] = $_POST['firstname'];
            $data['lastname'] = $_POST['lastname'];
            $data['dob'] = $_POST['dob'];
            $data['sex'] = $_POST['sex'];
            $data['address'] = $_POST['address'];
            $data['telephone'] = $_POST['telephone'];
            if ($account_id = $this->model->save($data)) {
                $data['message'] = 'Personal information are saved correctly.';;
                $this->generate('main.phtml', 'template.phtml', $data);
            } else {
                $data['message'] = 'Personal information are not saved. Please try again.';
                $this->generate('main.phtml', 'template.phtml', $data);
            }
        } else {
            $this->generate($this->page_name . '.phtml', 'template.phtml', $data);
        }
    }

    protected function _validate($data)
    {
        return true;
    }
}