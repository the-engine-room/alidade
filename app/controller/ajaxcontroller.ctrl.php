<?php

    // adding this in for added pdf functionalities
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html2pdf_v4.03' . DS . 'html2pdf.class.php');

    class AjaxController extends Controller {
        
        
        public function print_recap($project, $step){
            $Project = new Project;
            $Slide = new Slide;
            
            $data = $Project->findProject($project);
            
            
            
            //dbga($data);
            
            $steps = array();
            foreach($data['slides'] as $slide){
                if($slide->step == $step) {
                    $steps[] = $slide;
                }
            }
            
            $content = '
                        
                        <style type="text/css">
                        <!--
                            h3 {background: #e3e3e3;  padding:5mm 8mm;  font-weight: bold; width: 100%;   }
                            p {background: #FFFFFF;  padding:3mm; }
                        -->
                        </style>
                        <page>
                        <h1>' . $data['title'] . '</h1>';
                            
            
            
            
            switch($step){
                case 1:
                    
                    $thisSlide = $Slide->findSlide($project, $step, 3);
                    //dbga($thisSlide);
                    $content .= '   <h3>Description of the project:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 4);            
                    $content .= '   <h3>How a technology tool will help achieve the projects objective:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, $step, 5);            
                    $content .= '<h3>Type of users:</h3>
                                    <p>' .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    '</p>';
                    $content .= '<h3>Will any of the users be people that you have not engaged with before?</h3>
                                    <p>' .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $content .= '<h3>Areas where more research is needed:</h3>
                                    <p>' . nl2br($thisSlide->answer) . '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, $step, 5);            
                    $content .= '<h3>Type of users:</h3>
                                    <p>' .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    '</p>';
                    
                    
                    
                    $thisSlide = $Slide->findSlide($project, $step, 7);            
                    
                    $content .= '   <h3>Need for user research:</h3>
                                    <p>' . (empty($thisSlide) ? 'I am already confident that I know how people will use the tool ' : 'I am conducting research into my users\' needs.' ) . '</p>';
                    
                    $content .= '   <h3>Who might use the tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 8);            
                    $content .= '   <h3>Why users might be interested in using this type of tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 9);            
                    $content .= '   <h3>Potential users\' experience in using this type of tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 10);            
                    $content .= '   <h3>Factors that could prevent or deter users from using the tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    
                                                
                    break;
                case 2:
                    
                    $thisSlide = $Slide->findSlide($project, $step, 2);            
                    $content .= '   <h3>What things the tool must be able to do:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 3);            
                    $content .= '   <h3>Existing tools that have these functions:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 4);            
                    $content .= '   <h3>Other projects that have used these kinds of tools for similar purposes:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 6);            
                    $content .= '   <h3>Decision to use an existing tool, adapt an existing tool or build a new tool</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    break;
                case 3:
                    $thisSlide = $Slide->findSlide($project, $step, 4);            
                    $content .= '   <h3>Methods for trialling the tool(s):</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, $step, 5);            
                    $content .= '   <h3>Results from trial:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 6);            
                    $content .= '   <h3>Steps (if any) to be taken following trial:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';                        
                    break;
                case 4:
                    
                    break;
            }
            
                        
            $content .= '</page>';
            //echo $content;
            
            $html2pdf = new HTML2PDF('P','A4','en');
            $html2pdf->WriteHTML($content);
            $html2pdf->Output('TSA-Step-' . $step . '.pdf');
            
        }    
        
        
        public function save_project_name(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /home');
            }
            else {
                
                $user = $Auth->getProfile();
                $this->user = $user;
                $this->set('user', $user);
                
                if(isset($_GET['project']) && is_numeric($_GET['project'])) {
                    $project = (integer)$_GET['project'];    
                    
                    
                    $Project = new Project;
                    $data = array('title' => $_GET['title']);
                    $q = $Project->update($data, $project);
                    //$q = true;
                    if(!$q){
                        $response = array('code' => 'danger', 'message' => 'Could not save this name.');
                    }
                    else {
                        $response = array('code' => 'success', 'message' => $data['title']);
                    }
                    echo json_encode($response);
                }
            }
        }
        
        public function getprojectslide(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /home');
            }
            else {
                
                $user = $Auth->getProfile();
                $this->user = $user;
                $this->set('user', $user);
                
                if(isset($_GET['project']) && is_numeric($_GET['project']) && isset($_GET['slide']) && !empty($_GET['slide']) ) {
                    $expl = explode('.', $_GET['slide']);
                    $project = (integer)$_GET['project'];
                    $slide = (integer)$expl[1];
                    $step = (integer)$expl[0];
                    
                    $params = array(
                                'project' => $project,
                                'slide' => $slide,
                                'step' => $step
                                );
                    
                    $Slide = new Slide;
                    $response = $Slide->find($params);
                    
                    if(!empty($response)){
                        $response = $response[0];
                        $ret = array('code' => 'success',
                                     'answer' => nl2br($response->answer),
                                     'choice' => (is_null($response->choice) ? '' : $response->choice),
                                     'extra'=> (is_null($response->extra) ? '' : nl2br($response->extra)));
                        
                        echo json_encode($ret);
                    }
                    else {
                        echo json_encode(array('code' => 'danger'));
                    }
                }
            }
        }
        
        
    
        public function save_slide(){
            $status = false;
            
            if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $Auth = new Auth($url);
                $user = $Auth->getProfile();
                if(!$Auth->isLoggedIn() || $user->role != 'root' ){
                    header('Location: /home');
                    
                }
                else {
                    $SlideList = new Slidelist;
                    $step = $_POST['step'];
                    $position = $_POST['position'];
                    
                    $slide = $SlideList->find(array('step' => $step, 'position' => $position));
                    $slide = $slide[0];
                    
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    
                    
                    $update = $SlideList->update(array('title' => $title, 'description' => $description), $slide->idslide_list );
                    if($update){
                        $response['code'] = 'success';
                        $response['icon'] = 'tick';
                        $response['message'] = '<strong>Awww yeah!</strong> The slide has been correctly updated.';
                    }
                    else {
                        $response['code'] = 'danger';
                        $response['icon'] = 'times';
                        $response['message'] = '<strong>Whooops!</strong> Something went wrong and your changes have not been saved.';
                    }
                    $status = $response;
                    echo json_encode($status);
                }
            }
            
            return $status;
        }
   
   
    }