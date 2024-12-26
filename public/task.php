<?php
require_once 'Connect.php';

 class Task extends Connect{
    private $id;
    private $title;
    private $description;
    private $status;
    private $assigned_id;
    
    public function __construct($id , $title , $description , $status , $assigned_id) {
            $this->id=$id;
            $this->title=$title;
            $this->description=$description;
            $this->status=$status;
            $this->assigned_id=$assigned_id;
    } 
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

     public function AddTask($title ,$description , $status , $assigned_id){
        $sql="INSERT INTO task (title,description,status,assignee_id) VALUES( ? , ? , ? , ? )";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$title , $description , $status , $assigned_id]);
     }

 }

$task=new Task(1,"adil", "test","done",2);
$task->AddTask("ismail","brief","done",2);
?>