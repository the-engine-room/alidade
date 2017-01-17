<?php

    /** checks if user has a role
     * var object $user from Auth->getProfile() (Session->getSession())
     * returns boolean
     * */
    function hasRole($user, $role){
        
        if(ucfirst($user->role) == 'Root'){
            return true;
        }
        else {
            if($user->role == ucwords($role)){
                return true;
            }
            else {
                return false; 
            }
        }        
    }
    
    
    
    /** Prints out Bootstrap alerts
     * finds key of response and
     * uses it to format the alert
     * as wished
     * */
    function printResponse($response){
        foreach($response as $type => $text){
            switch($type) {
                case 'success':
                    $icon = 'check';
                    break;
                case 'danger':
                    $icon = 'exclamation-triangle';
                    break;
                case 'warning':
                    $icon = 'exclamation-circle';
                    break;
                case 'info':
                    $icon = 'info';
                    break;
            }
            echo '<div class="alert alert-' . $type . '  alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-' . $icon . '"></i> ' . $text . '
                    
                </div>';
        }
    }
    
    /** Parse responses from deletion
     * and passes off the info to printResponse
     * */
    function parseResponse($response){
        $res = array();
        $r = explode(':', $response);
       
        switch($r[0]){
            case 'd':
                if($r[1] == 'err') {
                    $res['danger'] = 'Could not delete the desired element.';
                }
                elseif($r[1] == 'ok') {
                    $res['success'] = 'Element permanently deleted.';
                }
                break;
            default:
                break;
        }
        return $res;
    }
    
    /**
     * verify that an array index exists and is not empty or null.
     * can also do some type control.
     * */
    function verify($var, $strict = false, $type = 'string'){
        if(!isset($var) || empty($var) || is_null($var)){
            return false;
        }
        else {
            if($strict){
                switch($type){
                    case 'number':
                        if(is_numeric($var)){
                            return true;
                        }
                        break;
                    case 'string':
                        return true;
                        break;
                    case 'array':
                        if(is_array($var)){
                            return true;
                        }
                        break;
                    default:
                        return false;
                        break;
                }
            }
            else {
                return true;    
            }
            
        }
    }
    
    /** prints friendly arrays
     * used mainly for debugging
     * */
    function dbga($array){
        echo '<div class="dbg"><pre>';
        print_r($array);
        echo '</pre></div>';
    }
    
    function dsql($sql){
        echo '<div class="dbg"><pre>';
        echo $sql;
        echo '</pre></div>';
    }
    
        
    /**
     *DateTime printers
     **/
    function dateFormat($timestamp){
        return date('D, j M Y, H:i', $timestamp);
    }
    
    function dateFormatNoTime($timestamp){
        return date('D, j M Y', $timestamp);
    }

    function dbDate($date){
        return date('Y-m-d H:i:s', strtotime($date));
    }
    function dbDateNoTime($string){
        $d = explode('/', $string);
        return implode('-', array_reverse($d)); 
    }
    
    
    /** inject textarea and parse tags in text **/
    function injectAnswerField($string, $name = 'answer', $origin = null){
        return str_replace('[--answer--]', '<textarea id="answer" name="'.$name.'" class="form-control" rows="8">' . (!is_null($origin) ? $origin->answer : '' ) . '</textarea>', $string);
    }
    
    function injectParam($string, $param, $value){
        return str_replace('[--'.$param.'--]', $value, $string);        
    }
    
    function injectPrevAnswer($string){
        preg_match('/\[--prev\|\d\.\d\--]/', $string, $matches);
        if(!empty($matches) && is_array($matches)){
            $p = explode('|', $matches[0]);
            $slide = str_replace('--]', '', $p[1]);
            $parts = explode('.', $slide);
            $step = $parts[0];
            $slide = $parts[1];
            
            // palce slide model here and use getPreviousANswer method
            $Slides = new Slide;
            $hash = filter_var($_GET['p'], FILTER_SANITIZE_SPECIAL_CHARS);
            $slide = $Slides->findPreviousAnswer($hash, $step, $slide);
            
            $previous = "<div class=\"previous-answer\"><h3>" . $slide->step . "." . $slide->slide . " "  . $slide->title . "</h3><p id=\"answerBox\">" . nl2br($slide->answer) . "</p><a href=\"#\" class=\"prev-answer\" data-toggle=\"modal\" data-target=\".editPrevAnswer\">I need to change this answer.</a></div>";    
            
            $string = str_replace($matches[0], $previous, $string);
            return array('content' => $string, 'slide' => $slide);
        }
        else {
            return false;
        }
    }
    
    function injectBox($string){
        preg_match_all('/\[--box\|(?<name>\w+)--](.+?)\[--endbox--]/im', $string, $matches);
        $boxes = array();
        $fullMatches = $matches[0];
        $names = $matches['name'];
        $texts = $matches[2];
        foreach($fullMatches as $index => $match){
            $string = str_replace($match, '', $string);
        }
        foreach($names as $i => $box){
            
            $boxes[] = '<div class="box box-' . $box . '"><h3>' . ($box=='casestudy' ? 'case study' : $box) . '</h3>' . $texts[$i] . '</div>';
        }
        return array('content' => $string, 'boxes' => $boxes);        
    }
    
    /** title printing, parsing position **/
    function printTitle($slide, $slideTitle){
        $cur = explode('.', $slide);
        switch($cur[0]){
            case 1:
                $title .= 'Understanding your needs';
                break;
            case 2:
                $title .= 'Understanding the tech';
                break;
            case 3:
                $title .= 'Trying tools out';
                break;
            case 4:
                $title .= 'Finding help';
                break;
            default:
                $title .= 'Quick tips';
                break;
        }
        
        echo $title . ' - ' . $slideTitle;
        
    }
    
    
    /** check slide position and status, return css class **/
    function checkSlidePosition($currentStep, $currentSlide, $indexStep, $indexSlide){
        $check = '';
        
        if($currentStep == $indexStep){
            if($currentSlide == $indexSlide){
                return 'working';
            }
            elseif($currentSlide > $indexSlide) {
                return 'done';
            }
        }
        elseif($currentStep > $indexStep) {
            return 'done';
        }
        return null;
    }
    
    
    /** Print js scripts from controller-defined variable $js **/
    function print_scripts($js, $inject=false){
        if(is_array($js)){
            foreach($js as $path){
                echo '<script src="' . $path . '"></script>';
            }
        }
        else {
            if($inject == true){
                echo '<script>' . $js . '</script>';
            }
           else { 
                echo '<script src="' . $js . '"></script>';
           }
        }
    }
    /** Print css links from controller-defined variable $css **/
    function print_styles($css){
        if(is_array($css)){
            foreach($css as $path){
                echo '<link type="text/css" rel="stylesheet" href="' . $path . '">';
            }
        }
        else {
            echo '<link type="tex/css" rel="stylesheet" href="' . $css . '">';
        }
    }