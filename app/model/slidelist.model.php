<?php

    class Slidelist extends Model{
        
        protected $table = 'slide_list';

        public function __construct() {

            global $lang;
            if($lang !== 'en'){
                $this->table = 'slide_list_'.$lang;
            }

            if(!$this->database){

                $dns = DBTYPE . ':dbname=' . DBNAME . ';host=' . DBHOST . ';charset=utf8';

                $this->database = new PDO($dns, DBUSER, DBPASS);
                if (is_object($this->database)) {
                    $this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    return $this->database;
                }
                else {
                    return false;
                }
            }
        }
        public function getList($language = 'en'){

            if(!is_null($language) && $language == 'en'){
                $this->table = 'slide_list';
            }
            else {
                $this->table = 'slide_list_'.$language;
            }
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
        
        public function getSlide($step, $position, $language = 'en'){

            if(!is_null($language) && $language!='en'){
                $this->table = 'slide_list_'.$language;
            }

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

        public function update($data, $id, $language = 'en'){
            if(!is_null($language) && $language != 'en'){
                $this->table = 'slide_list_'.$language;
            }
            if(!filter_var($id, FILTER_VALIDATE_INT)){
                new Error(666, 'Invalid Update Parameter. (model.class.php, 130)');
                return false;
            }
            $fields = array_keys($data);
            $holders = array();
            foreach($fields as $i => $field){
                $fields[$i] = '`' . $field . '` = :' . $field;
            }

            $sql = 'UPDATE `' . $this->table . '` SET ' . implode(', ', $fields) . ' WHERE `id' . $this->table . '` = :id';

            $stmt = $this->database->prepare($sql);
            if(!$stmt && SYSTEM_STATUS == 'development'){
                dsql($sql . ' (model.class.php, 142)');
                dbga($this->database->errorInfo());
            }

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            foreach($data as $field => &$value){
                if(empty($value) || is_null($value)) { $value == 'NULL'; }
                $g = $stmt->bindParam(':' . $field, $value);
            }

            $q = $stmt->execute();

            if(!$q && SYSTEM_STATUS == 'development'){
                dbga($stmt->errorInfo());
                $response = false;
            }

            else {
                $response = true;
            }

            return $response;
        }
    }
    