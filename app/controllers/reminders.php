<?php

class Reminders extends Controller{

  public function index(){
    $reminder = $this->model('Reminder');
    $reminders = $reminder->getReminders();
    $this->view('reminders/index', ['reminders' => $reminders]);
    die;
  }

  public function create(){
    $subject = $_REQUEST['reminder-title'];
    $due_date = $_REQUEST['reminder-due'];
    $reminder = $this->model('Reminder');
    $reminder->createReminder($subject, $due_date);
    die;
  }

  public function delete(){
    $uid = $_REQUEST['id'];
    $reminder = $this->model('Reminder');
    $reminder->deleteReminder($uid);
    die;
  }

  public function complete(){
    $uid = $_REQUEST['id'];
    $value = $_REQUEST['completed'];
    $value = ($value == '1') ? 1 : 0;
    $reminder = $this->model('Reminder');
    $reminder->completeReminder($uid, $value);
    die;
  }
}