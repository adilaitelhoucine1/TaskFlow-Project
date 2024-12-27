<?php
 class Feature extends Task{
    private $feature_id;
    private $functionality;

    public function getFeatureId() {
        return $this->feature_id;
    }

    public function setFeatureId($feature_id) {
        $this->feature_id = $feature_id;
    }

    public function getFunctionality() {
        return $this->functionality;
    }

    public function setFunctionality($functionality) {
        $this->functionality = $functionality;
    }

    // public function AddFeature($title, $description, $status, $assignee_id, $type, $functionality) {
    //     $connection = $this->getConnection();
    //     $connection->beginTransaction();
        
    //     try {
    //         // Ajouter la tâche et récupérer son ID
    //         $taskId = $this->AddTask($title, $description, $status, $assignee_id, $type);
            
    //         // Vérifier si le taskId est valide
    //         if (!$taskId) {
    //             throw new Exception("L'ajout de la tâche a échoué, taskId invalide.");
    //         }
    
    //         // Ajouter la fonctionnalité avec le taskId
    //         $sql = "INSERT INTO feature (task_id, functionality) VALUES (?, ?)";
    //         $stmt = $connection->prepare($sql);
    //         $stmt->execute([$taskId, $functionality]);
            
    //         $connection->commit();
    //         return $taskId;
            
    //     } catch (PDOException $e) {
    //         if ($connection->inTransaction()) {
    //             $connection->rollBack();
    //         }
    //         throw $e;
    //     }
    // }
    public function AddFeatureWithTask($title, $description, $status, $assignee_id, $type, $functionality)
    {
        $connection = $this->getConnection();
        $connection->beginTransaction();
    
        try {
            
            $sqlTask = "INSERT INTO task (title, description, status, assignee_id, type) VALUES (?, ?, ?, ?, ?)";
            $stmtTask = $connection->prepare($sqlTask);
            $stmtTask->execute([$title, $description, $status, $assignee_id, $type]);
            $taskId = $connection->lastInsertId();
    
            $sqlBug = "INSERT INTO feature (task_id,fonction) VALUES (?, ?)";
            $stmtBug = $connection->prepare($sqlBug);
            $stmtBug->execute([$taskId, $functionality]);
    
            $connection->commit();
    
            return $taskId;
        } catch (Exception $e) {
            $connection->rollBack();
    
            throw new Exception("Erreur lors de l'ajout du bug avec la tâche : " . $e->getMessage());
        }
    }
    

    public function ShowFeatures() {
        $sql = "SELECT t.*, f.functionality FROM task t 
                INNER JOIN feature f ON t.id = f.task_id 
                WHERE t.type = 'feature'";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
 }


?>