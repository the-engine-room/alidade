<?php
    
    class Slide extends Model {
        protected $table = 'slides';
        protected $dates = true;

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
        
        public function projectSlideIndex($project){
            $sql = 'SELECT DISTINCT(CONCAT_WS(".", step, slide)) as indexer, step FROM ' . $this->table . ' WHERE project = :id ORDER BY step ASC, slide ASC';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $project, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (slide.model.php, 20)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
        
        public function findPreviousAnswer($hash, $step, $slide){
            $sql.='
            SELECT 
                `slides`.*, 
                `slide_list`.`title`, 
                `slide_list`.`description`,
                `projects`.`hash` 
            FROM `slides`
            INNER JOIN `slide_list` ON (`slide_list`.`step` = `slides`.`step` AND `slide_list`.`position` = `slides`.`slide`) 
            INNER JOIN `projects` ON `projects`.`idprojects` = `slides`.`project`  
            WHERE 
                `projects`.`hash` = :hash AND `slides`.`step` = :step and `slides`.`slide` = :slide 
            ORDER BY `slides`.`modified_at` DESC 
            LIMIT 1';
            $stmt = $this->database->prepare($sql);
            
            $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
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