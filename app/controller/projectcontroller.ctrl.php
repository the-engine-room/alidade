<?php

    class Projectcontroller extends Controller {

        var $multiSlides = array( '3.2', '4.2', '4.5' );

        public function start(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
              // setup a disposable user that we can later just edit and amend for our needs
              header('Location: /user/disposable');
            }

            else {

                $user = $Auth->getProfile();
                $this->set('userRole', $user->role);

                if(isset($_POST['title'])){


                    $ProjectHash = md5( $_SESSION[APPNAME]['USR'] . time() . $_SESSION[APPNAME][SESSIONKEY]);

                    $data['user'] = $user->id;
                    $data['hash'] = $ProjectHash;
                    $data['title'] = $_POST['title'];

                    $idproject = $this->Project->create($data);

                    if(is_numeric($idproject)) {

                        $_SESSION['project'] = $idproject;
                        header('Location: /project/slide/1.0');

                    }
                }
                else {
                    $this->set('title', 'Start a new project');
                    $this->set('page', 'start');
                }
            }
        }

        /** urls are in the form of /project/slide/1.2 **/
        public function slide($cur){

            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                //header('Location: /user/login');
                header('Location: /user/disposable');
            }

            else {

                $user = $Auth->getProfile();
                $this->set('user', $user);
                $this->set('userRole', $user->role);
                $this->set('multiSlides', $this->multiSlides);
                $this->set('inProcess', true);


                if(!isset($_SESSION['plan']) || $cur === '1.1'){
                    $_SESSION['plan'] = array();
                    $project = $_SESSION['project'];
                }

                $position = explode('.', $cur);

                $step_no    = (int)$position[0];
                $slide_no   = (int)$position[1];

                $Slide = new Slide;
                $Slidelist = new Slidelist;

                $slidelist = $Slidelist->getList();

                $slideIndex = array();
                foreach($slidelist as $s){
                    $slideIndex[$s->step][] = $s->position;
                    $slideIndex['fullIndex'][] = $s->step . '.' . $s->position;
                }

                $projectSlides = $Slide->findProjectSlides($project);

                $this->set('step_number', $step_no);
                $this->set('slide_number', $slide_no);
                $this->set('slidelist', $slidelist);
                $this->set('slideindex', $slideIndex);

                if(!empty($_SESSION['project'])) {
                    $loaded_project = $this->Project->findOne($_SESSION['project']);
                    $this->set('projecthash', $loaded_project->hash);
                    $idProject=$loaded_project->idprojects;
                }


                $slide = $Slidelist->find(array(
                                            'position'  =>  $slide_no,
                                            'step'      =>  $step_no
                                            ));

                $nextSlide = $slideIndex['fullIndex'][array_search($cur, $slideIndex['fullIndex'], true) + 1];
                $prevSlide = $slideIndex['fullIndex'][array_search($cur, $slideIndex['fullIndex'], true) - 1];


                $this->set('nextSlide', $nextSlide);
                $this->set('prevSlide', $prevSlide);
                $this->set('currentSlide', $cur);

                $this->set('slide', $slide[0]);
                $this->set('contents', $slide[0]->description);

                //check if we have a hash for a project
                if($_GET['p']){
                    $hash = $_GET['p'];
                    $this->set('hash', $hash);
                    $project = $this->Project->find(array('hash' => $hash));

                    if(!empty($project) && is_object($project[0])) {
                        $_SESSION['project'] = $project[0]->idprojects;
                        $idProject = $project[0]->idprojects;
                    }

                    $slidecontent = $Slide->find(array(
                                                       'project'    => $project[0]->idprojects,
                                                       'step'       => $step_no,
                                                       'slide'      => $slide_no,
                                                       ));
                    //$slidecontent[0]->full_project = $project[0];
                    if($slidecontent){
                        $this->set('original', $slidecontent);
                    }
                    if(isset($_GET['edit'])){
                        $this->set('edit', true);
                    }
                    if(isset($_GET['back'])){
                        $this->set('back', true);
                    }
                }
                /** access the selection from other slides as well **/
                if($cur == '4.2'){
                  $getSlideOptions =$Slide->find(array(
                                                     'project'    => $project[0]->idprojects,
                                                     'step'       => 4,
                                                     'slide'      => 1,
                                                     ));
                  $this->set('selection', explode(';', $getSlideOptions[0]->extra));
                }
                if(isset($_POST) && !empty($_POST)){
                    $_SESSION['plan'][$_POST['current_slide']] = $_POST;

                    $slide_position = explode('.', $_POST['current_slide']);

                    $slide = array();
                    $slide['project'] = $_SESSION['project'];
                    $slide['step'] = $slide_position[0];
                    $slide['slide'] = $slide_position[1];
                    $slide['status'] = 2;
                    $slide['choice'] = (!empty($_POST['choice']) ? $_POST['choice'] : null);
                    $slide['extra'] = (!empty($_POST['extra']) ? $_POST['extra'] : null);

                    if($_POST['current_slide'] == '1.3'){
                        // special slide with multiple answer boxes
                        $extra = filter_var($_POST['extra'], FILTER_SANITIZE_SPECIAL_CHARS);
                        $answer = ( $extra == '#pick-1' ? $_POST['a'] : $_POST['b'] );
                        $answer = implode('##break## ', $answer);
                    }
                    // do that for the other multifields too
                    elseif(in_array($_POST['current_slide'], $this->multiSlides)){
                        $answer = implode('##break## ', $_POST['answer']);
                    }
                    //Parse Answers
                    elseif(is_array($_POST['answer'])){
                        $answer = array_filter($_POST['answer']);

                        // implode checkboxes in step 4.2
                        if($slide['step'] == 4 && $slide['slide'] == 2){
                            $answer = implode(', ', $answer);
                        }
                        else {
                            $answer = $answer[0];
                        }
                    }
                    else {
                        $answer = $_POST['answer'];
                    }

                    /** Slide 4.1 has options instead of radios **/
                    if($_POST['current_slide'] == '4.1'){
                        $options = array_keys($_POST['option']);
                        $slide['extra'] = implode(';', $options);
                        $answer = '';
                        $this->set('selection', $options);
                    }


                    $slide['answer'] = $answer;

                    // creating or updating ?
                    if(isset($_POST['slide_update']) && !empty($_POST['slide_update'])){
                        $toUpdate = $Slide->find(array('step'   => $slide['step'],
                                                       'slide'  => $slide['slide'],
                                                       'project'=> $slide['project']
                                                       ));



                        $Slide->update($slide, $toUpdate[0]->idslides);

                        /** add a filter to sort out exiting pages **/
                        if(isset($_POST['edit']) && $_POST['edit'] === 'true'){

                            $this->set('edit', true);
                            //header('Location: /user/projects/?cd=2');
                        }

                    }
                    else {
                        // check if we are skipping stuff
                        /*if($slide['step'] == 1 && $slide['position'] == 11 && (isset($_GET['skipped']))){
                            $slide['answer'] ==
                        }*/

                        $r = $Slide->create($slide);
                        // Check values in the choice @ the end of Step 3
                        if($slide['step'] == 3 && $slide['slide'] == 7 ) {
                            $choice = $_POST['choice'];
                            if(!in_array('no', $choice)){
                                header('Location: /project/slide/4.10?p='.$hash);
                            }
                        }
                    }
                }

                /** Conditional Logic bits **/
                // Skip a slide if user does not select "New tool" on 2.5
                if(isset($_POST) && !empty($_POST)){
                  if($slide['step'] == 2 && $slide['slide'] == 5 && $slide['choice'] != 3){
                    header('Location: /project/slide/2.7?p='.$hash);
                  }
                }

                $projectSlideIndex = $this->Project->getIndex($idProject);

                // rearraange the index for our purposes
                foreach($projectSlideIndex as $p){
                    $projectIndex[$p['step']][] = $p['slideStep'];
                }
                $this->set('projectIndex', $projectIndex);

                $menu = array();
                foreach($slidelist as $slide){
                    $menu[$slide->indexer] = $slide->title;
                }
                $this->set('slideMenu', $menu);



            }
        }


         /** urls are in the form of /project/slide/1.2 **/

        public function tour($cur){


            $this->set('inTour', true);
            $_SESSION['tour'] = array();
            if(!isset($_SESSION['plan']) || $cur === '1.1'){
                $_SESSION['plan'] = array();

                //$project = $_SESSION['project'];
            }

            $position = explode('.', $cur);

            $step_no    = (int)$position[0];
            $slide_no   = (int)$position[1];

            if($step_no == 1){

                $Slide = new Slide;
                $Slidelist = new Slidelist;


                $slidelist = $Slidelist->getList();

                $slideIndex = array();
                foreach($slidelist as $s){
                    $slideIndex[$s->step][] = $s->position;
                    $slideIndex['fullIndex'][] = $s->step . '.' . $s->position;
                }

                $projectSlides = $_SESSION['tour']; //Slide->findProjectSlides($project);

                $this->set('step_number', $step_no);
                $this->set('slide_number', $slide_no);
                $this->set('slidelist', $slidelist);
                $this->set('slideindex', $slideIndex);

                $slide = $Slidelist->find(array(
                                            'position'  =>  $slide_no,
                                            'step'      =>  $step_no
                                            ));

                $nextSlide = $slideIndex['fullIndex'][array_search($cur, $slideIndex['fullIndex'], true) + 1];
                $prevSlide = $slideIndex['fullIndex'][array_search($cur, $slideIndex['fullIndex'], true) - 1];
                /*
                echo $cur;
                echo array_search($cur, $slideIndex['fullIndex']) + 1;
                dbga($slideIndex);
                */

                $this->set('nextSlide', $nextSlide);
                $this->set('prevSlide', $prevSlide);
                $this->set('currentSlide', $cur);

                $this->set('slide', $slide[0]);
                $this->set('contents', $slide[0]->description);
                //check if we have a hash for a project



                if(isset($_POST) && !empty($_POST)){

                    $_SESSION['plan'][$_POST['current_slide']] = $_POST;
                    $_SESSION['tour'][$cur] = $_POST;

                    $slide_position = explode('.', $_POST['current_slide']);


                    $slide = array();
                    $slide['project'] = $_SESSION['project'];
                    $slide['step'] = $slide_position[0];
                    $slide['slide'] = $slide_position[1];
                    $slide['status'] = 2;
                    $slide['choice'] = (!empty($_POST['choice']) ? $_POST['choice'] : null);
                    $slide['extra'] = (!empty($_POST['extra']) ? $_POST['extra'] : null);

                    //Parse Answers
                    if(is_array($_POST['answer'])){
                        $answer = array_filter($_POST['answer']);

                        // implode checkboxes in step 4.2
                        if($slide['step'] == 4 && $slide['slide'] == 2){
                            $answer = implode(', ', $answer);
                        }
                        else {
                            $answer = $answer[0];
                        }
                    }
                    else {
                        $answer = $_POST['answer'];
                    }
                    $slide['answer'] = $answer;

                    // creating or updating ?

                    /*
                    if(isset($_POST['slide_update']) && !empty($_POST['slide_update'])){
                        $toUpdate = $Slide->find(array('step'   => $slide['step'],
                                                       'slide'  => $slide['slide'],
                                                       'project'=> $slide['project']
                                                       ));



                        $Slide->update($slide, $toUpdate[0]->idslides);

                        /** add a filter to sort out exiting pages **//*
                        if(isset($_POST['edit']) && $_POST['edit'] === 'true'){

                            $this->set('edit', true);
                            //header('Location: /user/projects/?cd=2');
                        }

                    }
                    else {
                        // check if we are skipping stuff
                        /*if($slide['step'] == 1 && $slide['position'] == 11 && (isset($_GET['skipped']))){
                            $slide['answer'] ==
                        }*//*

                        $r = $Slide->create($slide);
                        // Check values in the choice @ the end of Step 3
                        if($slide['step'] == 3 && $slide['slide'] == 7 ) {
                            $choice = $_POST['choice'];
                            if(!in_array('no', $choice)){
                                header('Location: /project/slide/4.10');
                            }
                        }
                    }
                    */
                }



                $projectSlideIndex = $this->Project->getIndex($idProject);
                // rearraange the index for our purposes
                foreach($projectSlideIndex as $p){
                    $projectIndex[$p['step']][] = $p['slideStep'];
                }
                $this->set('projectIndex', $projectIndex);

            }
            else {

                header('Location: /user/forbidden');

            }
        }


    }
