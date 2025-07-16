<?php

class Reports extends Controller {

  public function index(){
    $admin = $this->model('Admin');
    $reminders = $admin->getAllReminders();
    $user_with_most_reminders = $admin->getUserWithMostReminders();
    $login_attempts = $admin->getAllLoginAttempts();
    $reminder_count = $admin->getReminderCount(); 
    $this->view('reports/index', [
                'reminders' => $reminders,
                'most_reminders' => $user_with_most_reminders,
                'login_attempts' => $login_attempts,
                'reminder_count' => $reminder_count
                ]);
    die;
  }

}