<?php
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html2pdf_v4.03' . DS . 'html2pdf.class.php');
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html_to_doc.inc.php');
    
    class PrinterController extends Controller {
        
        public function output( $project, $step, $type = 'pdf' ){
            $Project = new Project;
            $Slide = new Slide;
            
            $data = $Project->findProject($project);
            
            $steps = array();
            foreach($data['slides'] as $slide){
                if($slide->step == $step) {
                    $steps[] = $slide;
                }
            }
            if($type == 'pdf'){ 
            $content = '<style type="text/css">
                        <!--
                            page {  }
                            h1 { font-size: 16mm; text-align: left; color: yellowgreen; font-weight: 700; margin: 10mm 0mm 5mm 0mm; }
                            h2 {color: #042a2b; font-weight: bold; margin: 5mm 0mm; }
                            h3 {  color: #042a2b; font-weight: normal; margin: 5mm 0mm 2mm; }
                            p { background: #FFFFFF; line-height: 140%; color: #042a2b;   }
                            p.small { font-size: 4mm; color: #666; margin: 8mm 0mm;  }
                            p.small a { color: #666;  }
                        -->
                        </style>
                        <page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
                         
                            <p class="small">Produced by the Tool Selection Assistant, (<a href="https://toolselect.theengineroom.org">https://toolselect.theengineroom.org</a>) a guide that helps choose the right tool for transparency and accountability projects. </p>
                            
                        
                        <h1>' . $data['title'] . '</h1>';
            }
            else {
                $content = '<h1>' . $data['title'] . '</h1>';
            }
            
            
            
            switch($step){
                case 1:
                    $content .= '<h2>Understand Your Needs</h2>';
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
                    $content .= '<h2>Understand The Tech</h2>';
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
                    $content .= '<h2>Try it out!</h2>';
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
                    $content .= '<h2>Find help</h2>';
                    
                    $thisSlide = $Slide->findSlide($project, 4, 2);            
                    $content .= '   <h3>Areas where support is needed:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, 4, 3);            
                    $content .= '   <h3>Requirements for the technical provider:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 4);            
                    $content .= '   <h3>List of potential technical partners:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 5);            
                    $content .= '   <h3>Ways in which you could build up internal capacity:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 6);            
                    $content .= '   <h3>Technical partners or advisers best suited to the project:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';                   
                    $thisSlide = $Slide->findSlide($project, 4, 7);            
                    $content .= '   <h3>Name of technical partner chosen:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';                   
                    
                    
                    break;
                
                case 'all':
                    
                    /**  BOF STEP 1 **/
                    $content .= '<h2>Understand Your Needs</h2>';
                    $thisSlide = $Slide->findSlide($project, 1, 3);
                    //dbga($thisSlide);
                    $content .= '   <h3>Description of the project:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 1, 4);            
                    $content .= '   <h3>How a technology tool will help achieve the projects objective:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, 1, 5);            
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
                    
                    $thisSlide = $Slide->findSlide($project, 1, 5);            
                    $content .= '<h3>Type of users:</h3>
                                    <p>' .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    '</p>';
                    
                    
                    
                    $thisSlide = $Slide->findSlide($project, 1, 7);            
                    
                    $content .= '   <h3>Need for user research:</h3>
                                    <p>' . (empty($thisSlide) ? 'I am already confident that I know how people will use the tool ' : 'I am conducting research into my users\' needs.' ) . '</p>';
                    
                    $content .= '   <h3>Who might use the tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 1, 8);            
                    $content .= '   <h3>Why users might be interested in using this type of tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 1, 9);            
                    $content .= '   <h3>Potential users\' experience in using this type of tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 1, 10);            
                    $content .= '   <h3>Factors that could prevent or deter users from using the tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    /** EOF STEP 1 **/
                    /** BOF STEP 2 **/
                    $content .= '<h2>Understand the Tech</h2>';
                    $thisSlide = $Slide->findSlide($project, 2, 2);            
                    $content .= '   <h3>What things the tool must be able to do:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 2, 3);            
                    $content .= '   <h3>Existing tools that have these functions:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 2, 4);            
                    $content .= '   <h3>Other projects that have used these kinds of tools for similar purposes:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 2, 6);            
                    $content .= '   <h3>Decision to use an existing tool, adapt an existing tool or build a new tool</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    /** EOF STEP 2 **/
                    /** BOF STEP 3 **/
                    $content .= '<h2>Try it out!</h2>';
                    $thisSlide = $Slide->findSlide($project, 3, 4);            
                    $content .= '   <h3>Methods for trialling the tool(s):</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, 3, 5);            
                    $content .= '   <h3>Results from trial:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 3, 6);            
                    $content .= '   <h3>Steps (if any) to be taken following trial:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';                   
                    /** EOF STEP 3 **/
                    
                    
                    /** BOF STEP 4 **/
                    $content .= '<h2>Find Help</h2>';
                    $thisSlide = $Slide->findSlide($project, 4, 2);            
                    $content .= '   <h3>Areas where support is needed:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, 4, 3);            
                    $content .= '   <h3>Requirements for the technical provider:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 4);            
                    $content .= '   <h3>List of potential technical partners:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 5);            
                    $content .= '   <h3>Ways in which you could build up internal capacity:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';                
                                    
                                    
                    $thisSlide = $Slide->findSlide($project, 4, 6);            
                    $content .= '   <h3>Technical partners or advisers best suited to the project:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';                   
                    $thisSlide = $Slide->findSlide($project, 4, 7);            
                    $content .= '   <h3>Name of technical partner chosen:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>'; 
                    break;
            }
            
            $content .= '<p class="small">The guide was built by The Engine Room (<a href="https://www.theengineroom.org">https://www.theengineroom.org</a>), Pawa254 (<a href="http://pawa254.org">http://pawa254.org</a>) and the Network Society Lab (<a href="http://www.networksociety.co.za">www.networksociety.co.za</a>) at the University of the Witwatersrand. It is part of a research project supported by Making All Voices Count (<a href="http://www.makingallvoicescount.org/">www.makingallvoicescount.org/</a>)</p>';
                
            if($type == 'pdf'){
                $content .= '</page>';
                $html2pdf = new HTML2PDF('P','A4','en');
                $html2pdf->WriteHTML($content);
                $html2pdf->Output('TSA-Step-' . $step . '.pdf');
            }
            elseif($type == 'doc'){
                $doc = $htmltodoc= new HTML_TO_DOC();
                $content = '<body>' . $content . '</body>';
                $doc->createDoc($content,"TSA-Step-" . $step, true);
            }
        }    
        
    }
    
