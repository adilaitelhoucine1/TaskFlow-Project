<?php
require_once 'task.php';

class Bug extends Task {
    private $bug_id;
    private $severity;

    public function getBugId() {
        return $this->bug_id;
    }

    public function setBugId($bug_id) {
        $this->bug_id = $bug_id;
    }

    public function getSeverity() {
        return $this->severity;
    }

    public function setSeverity($severity) {
        $this->severity = $severity;
    }

    public function AddBugWithTask($title, $description, $status, $assignee_id, $type, $severity)
    {
        $connection = $this->getConnection();
        $connection->beginTransaction();
    
        try {
            
            $sqlTask = "INSERT INTO task (title, description, status, assignee_id, type) VALUES (?, ?, ?, ?, ?)";
            $stmtTask = $connection->prepare($sqlTask);
            $stmtTask->execute([$title, $description, $status, $assignee_id, $type]);
            $taskId = $connection->lastInsertId();
    
            $sqlBug = "INSERT INTO bug (task_id, severity) VALUES (?, ?)";
            $stmtBug = $connection->prepare($sqlBug);
            $stmtBug->execute([$taskId, $severity]);
    
            $connection->commit();
    
            return $taskId;
        } catch (Exception $e) {
            $connection->rollBack();
    
            throw new Exception("Erreur lors de l'ajout du bug avec la tâche : " . $e->getMessage());
        }
    }
    

    public function ShowBugs() {
        $sql = "SELECT t.*, b.severity FROM task t 
                INNER JOIN bugs b ON t.id = b.task_id 
                WHERE t.type = 'bug'";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // public function UpdateBugSeverity($bugId, $severity) {
    //     $sql = "UPDATE bugs SET severity = ? WHERE task_id = ?";
    //     $stmt = $this->getConnection()->prepare($sql);
    //     $stmt->execute([$severity, $bugId]);
    // }
}
