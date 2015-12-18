<?php

    class User extends Model {
        
        protected $table = 'users';
        protected $dates = true;
        
        
        public function profilePage($id){
            $sql = 'SELECT * FROM `' . $this->table . '`
                    WHERE `idusers` = :id ';
             
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (user.model.php, 24)');
                return false;
            }
            else {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }   
            
        }
        
        public function find($params){
            $sql = 'SELECT * FROM ' . $this->table . '
                    WHERE ';
            $clauses = array();
            foreach($params as $field => $value) {
                $clauses[] = $field . ' = :' . $field;
            }
            $sql .= implode(' AND ', $clauses);
            
            $stmt = $this->database->prepare($sql);

            
            foreach($params as $field => &$value){
                $stmt->bindParam(':'.$field, $value);
            }
            
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (user.model.php, 53)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
        
        public function validateToken($token){
            if(!is_null($token) && !empty($token) && $token!==false) { 
                $user = self::find(array('token' => $token));
                
                if($user !== false && !empty($user) && $user[0]->token == $token ){
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        
        public function getUserList () {
            
            $sql = 'SELECT users.idusers AS id, users.name, users.email, UNIX_TIMESTAMP(sessions.modified_at) AS modified_at FROM users
                    INNER JOIN sessions ON sessions.user = users.idusers 
                    ORDER BY users.role ASC';
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            $Users = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            if(is_array($Users)){
                
                
                $User = new User;
                foreach($Users as $key => $user) {
                    
                    $Users[$key]->permissions = $User->getRolePermissions($user->role);
                }
            }
            return $Users;
        }
        
        
        public function create($data){
            $sql = 'INSERT INTO `' . $this->table . '` (`created_at`, `name`, `email`, `password`, `role`)
                    VALUES (:created_at, :name, :email, :password, :role)';
            
            $data['created_at'] = date('Y-m-d H:i:s', time() );
            $data['role'] = (empty($data['role']) || !isset($data['role']) ? 'user' : $data['role'] ); 
            
            $stmt = $this->database->prepare($sql);
            
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->bindParam(':role', $data['role'], PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $data['created_at']);
            
            $q = $stmt->execute();
            
            if(!$q){
                $einfo = $stmt->errorInfo();
                $response = false;
                new Error(602, $einfo[2]);
            }
            else {
                $response = $this->database->lastInsertId();
            }
            
            return $response;
        }
        
    }