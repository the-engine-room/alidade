<?php
    
    class Slide extends Model {
        protected $table = 'slides';
        protected $dates = true;
        #code
        
        public function findProjectSlides($p){
            
            $sql = 'SELECT * FROM `' . $this->table . '` AS `s`
                    WHERE `s`.`project` = :p
                    ORDER BY `s`.`step` ASC, `s`.`slide` ASC';
            
            
            $stmt = $this->database->prepare($sql);
            
            $stmt->bindParam(':p', $p, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (slide.model.php, 20)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
        
        public function findSlide($p, $step, $slide){
            
            $sql = 'SELECT * FROM `' . $this->table . '` AS `s`
                    WHERE `s`.`project` = :p
                    AND `s`.`step` = :step
                    AND `s`.`slide` = :slide
                    ORDER BY `s`.`step` ASC, `s`.`slide` ASC';
            
            
            $stmt = $this->database->prepare($sql);
            
            $stmt->bindParam(':p', $p, PDO::PARAM_INT);
            $stmt->bindParam(':step', $step, PDO::PARAM_INT);
            $stmt->bindParam(':slide', $slide, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (slide.model.php, 20)');
                return false;
            }
            else {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
        }
        
        
    }
    