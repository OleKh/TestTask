<?php

class Register extends Controller
{

    public $page_name;

    function __construct($page_name)
    {
        $this->page_name = $page_name;
        $this->model = new Model_Register();
    }

    function action_index()
    {
        $data = array();
        if (!empty($_POST['login']) &&
            !empty($_POST['password']) &&
            !empty($_POST['email'])
        ) {
            if (!$this->_validate($_POST)) {
                $data['message'] = 'Data are not valid. Please try again.';;
                $this->generate('main.phtml', 'template.phtml', $data);
                return;
            }
            $data['login'] = $_POST['login'];
            $data['password'] = $_POST['password'];
            $data['email'] = $_POST['email'];
            if ($login_id = $this->model->save($data)) {
                $data['login_id'] = $login_id;
                $this->sendLink($data);
                $data['message'] = 'Login Information are saved correctly.
                The link has been sent to you by email. Please check emails. ';;
                $this->generate('main.phtml', 'template.phtml', $data);
            } else {
                $data['message'] = 'Personal Information Are Saved  Incorrectly. Please try again.';;
                $this->generate($this->page_name . '.phtml', 'template.phtml', $data);
            }

        } else {
            $this->generate($this->page_name . '.phtml', 'template.phtml', $data);
        }
    }

    public function sendLink($data)
    {
        $params = 'link=1&login_id=' . $data['login_id'] . '&login=' . $data['login'] . '&pass=' . $data['pass'] . '&email=' . $data['email'];
        $params = base64_encode($params);
        $link = 'http://' . $_SERVER['SERVER_NAME'] . '/link.php?q=' . $params;
        $to = $data['email'];
        $subject = 'Link to fill form';
        $message = $link;
        $headers = 'From: site@localhost.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        return true;
    }

    protected function _validate($data)
    {
        if (!preg_match('#^[a-zA-Z]{1,10}$#isu', $data['login'])) {
            return false;
        }

        if (!preg_match('#^[\d]{4}$#isu', $data['password'])) {
            return false;
        }
        return true;
    }


}