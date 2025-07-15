<?php

class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function signup() {
      $user = $this->model('User');
      $user->signup($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['confirm-password']);
    }
}
