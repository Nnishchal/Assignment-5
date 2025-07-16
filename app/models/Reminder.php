<?php

class Reminder {

    public function __construct() {

    }

    public function createReminder($title, $deadline){
        $db = db_connect();
        $user = $_SESSION['username'];
        $query = $db->prepare("INSERT INTO notes (title, deadline, completed, created_at, user) VALUES (:title, :deadline, 0, NOW(), :user);");
        $query->execute([
                        'title' => $title,
                        'deadline' => $deadline,
                        'user' => $user,
                        ]);
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Reminder is added!'
        ];
        header('Location: /reminders');
    }

    public function getReminders(){
        $db = db_connect();
        $query = $db->prepare("SELECT * FROM notes WHERE user = :user");
        $query->execute(['user' => $_SESSION['username']]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteReminder($uid){
        $db = db_connect();
        $query = $db->prepare("DELETE FROM notes WHERE uid = :uid;");
        $query->execute(['uid' => $uid]);
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Reminder is deleted!'
        ];
        header('Location: /reminders');
    }

    public function completeReminder($uid, $value){
        $db = db_connect();
        $query = $db->prepare("UPDATE notes SET completed = :value WHERE uid = :uid;");
        $query->execute(['uid' => $uid, 'value' => $value]);
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Reminder is completed!'
        ];
        header('Location: /reminders');
    }
}