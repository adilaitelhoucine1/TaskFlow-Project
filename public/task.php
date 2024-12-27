<?php
require_once 'Connect.php';

 class Task extends Connect{
    private $id;
    private $title;
    private $description;
    private $status;
    private $assigned_id;
    
    // public function __construct($id , $title , $description , $status , $assigned_id) {
    //         $this->id=$id;
    //         $this->title=$title;
    //         $this->description=$description;
    //         $this->status=$status;
    //         $this->assigned_id=$assigned_id;
    // } 
     public function getId(){
        return $this->id;
     }

     public function setId($id){
        $this->id=$id;
     }


     public function getTitle(){
        return $this->title;
     }

     public function setTitle($title){
        $this->title=$title;
     }

     public function getDescription(){
        return $this->description;
     }
     public function setStatus($status){
        $this->status=$status;
     }

     public function getStatus(){
        return $this->status;
     }
     public function setAsignee_id($assigned_id){
        $this->assigned_id=$assigned_id;
     }

     public function getAssigned_id(){
        return $this->assigned_id;
     }

     public function AddTask($title ,$description , $status , $assigned_id , $type){
        $sql="INSERT INTO task (title,description,status,assignee_id,type) VALUES( ? , ? , ? , ? , ? )";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$title , $description , $status , $assigned_id,$type]);
        return $this->getConnection()->lastInsertId();
     }

     public function getTasksByStatus($status) {
      $sql = "SELECT task.*, users.name as assignee_name 
              FROM task 
              LEFT JOIN users ON task.assignee_id = users.id 
              WHERE task.status = ?";
      $stmt = $this->getConnection()->prepare($sql);
      $stmt->execute([$status]);
      return $stmt->fetchAll();
  }

  public function updateTaskStatus($taskId, $newStatus) {
   $sql = "UPDATE task SET status = ? WHERE id = ?";
   $stmt = $this->getConnection()->prepare($sql);
   $stmt->execute([$newStatus, $taskId]);
}



 }

// $task=new Task(1,"adil", "test","done",2);
// $task->AddTask("ismail","brief","done",2);
// $task=new Task();
// $tasks=$task->getTasksByStatus("En cours");
// foreach($tasks as $task){
//     echo $task['title'] . "<br>";
// // }

?>
