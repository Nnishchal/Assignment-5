<?php

class Admin{

  public function __construct() {

  }

  public function getAllReminders(){
    $db = db_connect();
    $query = $db->prepare("SELECT * FROM notes ORDER BY created_at DESC;");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

    public function getReminderCount(){
        $db = db_connect();
        $query = $db->prepare("SELECT user, COUNT(*) as reminder_count FROM notes GROUP BY user ORDER BY reminder_count DESC;");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

  public function getUserWithMostReminders(){
    $db = db_connect();
    $query = $db->prepare("SELECT user, COUNT(*) as total_reminders FROM notes GROUP BY user ORDER BY total_reminders DESC LIMIT 1;");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['user'];
  }

  public function getAllLoginAttempts(){
    $db = db_connect();
    $query = $db->prepare("SELECT username, COUNT(*) as login_count  FROM logs GROUP BY username ORDER BY login_count DESC;");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

}