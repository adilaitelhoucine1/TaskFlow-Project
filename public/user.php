<?php

require_once 'Connect.php';

 class user  extends Connect{
    private $id;
    private $name;
    // public function __construct($id,$name){

    //     $this->id=$id;
    //     $this->name=$name;

    // }

    public function getId(){
        return $this->id;
     }

     public function setId($id){
        $this->id=$id;
     }


     public function getName(){
        return $this->name;
     }

     public function setName($name){
        $this->name=$name;
     }


     public function AddUser($name){
        $sql="INSERT INTO users (name) VALUES(?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$name]);
     }


     public function ShowMyTask($user_id){
        $sql="SELECT * FROM Task Where assignee_id = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll();
        return $result;
     }

     public function existUser($name) {
        $sql = "SELECT * FROM users WHERE name = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        return $result ? true : false; 
    }
    public function ShowAllUsers(){
        $sql="SELECT * FROM users ";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
 }

//  $user = new User();
//  $tasks = $user->ShowMyTask(2); 
 
//  foreach ($tasks as $task) {
//      echo "Task ID: " . $task['id'] . "<br>";
//      echo "Title: " . $task['title'] . "<br>";
//      echo "Description: " . $task['description'] . "<br>";
//      echo "Status: " . $task['status'] . "<br>";
//      echo "Assigned to: " . $task['assignee_id'] . "<br><br>";
//  }



?>