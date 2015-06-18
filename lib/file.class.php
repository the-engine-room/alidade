<?php

    class File extends Model {
        
        public $path;
        public $file;
        public $ext;
        
        protected $table;
        
        protected $dates = true;
        
        /**
         * receives the POST data from an HTML form
         * processes file upload and saves
         * to database, depending on filetype
         * */
        
        public function upload($file, $type, $reference = null, $referenceType = null, $multiple = false, $profile = false){
            $user_file = $_FILES[$file];
            
            
            /** if we have no error, proceed to elaborate and upload **/
            if($user_file['error'] == UPLOAD_ERR_OK){
                $filename = $this->filename($user_file);
                $this->file = $filename;
                $path = DIR_UPLOADS . DS . $filename;
                if(!move_uploaded_file($user_file['tmp_name'], $path)){
                    return false;
                }
                else {
                    $data = array();
                    $this->path = $path;
                    $data['path'] = $this->file;
                    
                    if($type === 'image'){
                        $size = getimagesize($this->path);
                        $data['width']  = $size[0];
                        $data['height'] = $size[1];
                        
                        if($profile == true) {
                            $data['alt_text'] = "Profile Picture";
                            
                            if($this->ext == 'jpg') {
                                $profile_pic = imagecreatefromjpeg($this->path);
                                
                            }
                            elseif($this->ext == 'png') {
                                $profile_pic = imagecreatefrompng($this->path);
                            }
                            
                            
                            if($data['width'] > $data['height']) {
                                $biggestSide = $data['width'];
                            }
                            else {
                                $biggestSide = $data['height'];
                            }
                             
                            
                            $cropPercent = .5;
                            $cropWidth   = $biggestSide*$cropPercent;
                            $cropHeight  = $biggestSide*$cropPercent;
                            
                            //getting the top left coordinate
                            $c1 = array("x"=>( $data['width']-$cropWidth)/2, "y"=>( $data['height']-$cropHeight)/2);
                            
                            $thumbSize = 60;
                            $midSize = 260;
                            
                            $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
                            $mid = imagecreatetruecolor($midSize, $midSize);
                            
                            imagecopyresampled($thumb, $profile_pic, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
                            imagecopyresampled($mid, $profile_pic, 0, 0, $c1['x'], $c1['y'], $midSize, $midSize, $cropWidth, $cropHeight);
                            
                            if($this->ext == 'jpg'){
                                imagejpeg($thumb, DIR_UPLOADS . DS . 'thumbnail_' . $filename, 85);
                                imagejpeg($mid, DIR_UPLOADS . DS . 'mid_' . $filename, 85);
                            }
                            elseif($this->ext == 'png') {
                                imagepng($thumb, DIR_UPLOADS . DS . 'thumbnail_' . $filename );
                                imagepng($mid, DIR_UPLOADS . DS . 'mid_' . $filename );
                            }
                        }
                        
                        
                        $this->table = 'images';
                        
                        $image = $this->create($data);
                        
                        if(is_numeric($image) && !is_null($reference) && !is_null($referenceType)){
                            $xref = new Xref('object', $image, TBL_IMAGES, $reference, $referenceType);
                            $xref->createXref();                            
                        }
                    }
                    
                    
                    
                }
                
            }
            /** else, we raise exceptions and errors! **/
            else {
                
            }
            
        }
        
        /**
         * generates filename and maintains
         * correct file extension
         * (MIME check with Finfo!)
         * */
        public function filename($file){
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $ext = array_search(
                $finfo->file($file['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                true);
            
            if(empty($ext) || !$ext || is_null($ext)) {
                return false;
            }
            
            else {
                $this->ext = $ext;
                $filename = time() . sha1_file( $file['tmp_name']) . rand(1, 15000) . '.' . $ext;
                return $filename;
            }
            
        
        }
    }
    