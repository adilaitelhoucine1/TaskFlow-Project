<?php

session_start();
include_once 'user.php';
include_once 'task.php';
include_once 'bug.php';
include_once 'feature.php';

if (isset($_GET['task_id']) && isset($_GET['new_status'])) {
    $task_id = $_GET['task_id'];
    $new_status = $_GET['new_status'];
    //  echo $task_id;
    //  echo $new_status;
    $task=new Task();
     $task->updateTaskStatus($task_id, $new_status);
     header('Location: index.php');

}
?>
