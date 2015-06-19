<?php

    class Slidelist extends Model{
        
        protected $table = 'slide_list';
        
        
        public function getList(){
            
            $sql = 'SELECT * FROM `' . $this->table . '` ORDER BY `step` ASC, `position` ASC';
            $stmt = $this->database->prepare($sql);
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    