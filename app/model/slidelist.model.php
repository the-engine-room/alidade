<?php

    class Slidelist extends Model{
        
        protected $table = 'slide_list';
        
        
        public function getList(){
            
            $sql = 'SELECT *, CONCAT_WS(".", `step`, `position`) AS `indexer` FROM `' . $this->table . '` ORDER BY `step` ASC, `position` ASC';
            $stmt = $this->database->prepare($sql);
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function listed(){
            $slidelist = self::getList();
            $slideIndex = array();
            foreach($slidelist as $s){
                $slideIndex[$s->step][] = $s->position;
                $slideIndex['fullIndex'][] = $s->step . '.' . $s->position;
            }
            return $slideIndex;
            
        }
        
        public function getSlide($step, $position){
        
            $sql = 'SELECT * FROM `' . $this->table . '` AS `s`
                    WHERE
                        `s`.`step` = :step AND
                        `s`.`position` = :position 
                    ORDER BY `s`.`step` ASC, `s`.`position` ASC';
            
            
            $stmt = $this->database->prepare($sql);
            
            $stmt->bindParam(':position', $position, PDO::PARAM_INT);
            $stmt->bindParam(':step', $step, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (slidelist.model.php, 42)');
                return false;
            }
            else {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }        
        }
        
        public function getIndex(){
            $sql = 'SELECT * FROM `view_slide_index`';
            $stmt = $this->database->prepare($sql);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (slidelist.model.php, 59)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }        
        }
        
    }
    