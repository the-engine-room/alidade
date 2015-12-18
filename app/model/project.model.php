<?php

    class Project extends Model {
        
        protected $table = 'projects';
        protected $dates = true;
        
        public function findUserProjects($user){
            
            $sql .= 'SELECT * FROM `' . $this->table . '` AS `p`
                        WHERE `p`.`user` = :user
                        ORDER BY `p`.`modified_at` DESC';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':user', $user, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (project.model.php, 19)');
                return false;
            }
            else {
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $Slides = new Slide;
                foreach($projects as $k => $p){
                    $projects[$k]['slides'] = $Slides->findProjectSlides($p['idprojects']);
                }
                
                return $projects;
            }
        }
        
        public function findProject($id){
            $sql .= 'SELECT * FROM `' . $this->table . '` AS `p`
                        WHERE `p`.`idprojects` = :id';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (project.model.php, 40)');
                return false;
            }
            else {
                $project = $stmt->fetch(PDO::FETCH_ASSOC);
                $Slides = new Slide;
                $project['slides'] = $Slides->findProjectSlides($project['idprojects']);
                
                return $project;
            }
        }
        
        public function getIndex($p){
            $sql = "SELECT DISTINCT(CONCAT_WS('.',  step, slide)) AS slide_step, step FROM slides WHERE project = :id GROUP BY slide_step";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $p, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (project.model.php, 59)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    