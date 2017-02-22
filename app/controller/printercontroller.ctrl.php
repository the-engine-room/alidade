<?php
    //require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html2pdf_v4.6.0' . DS . 'src/Html2Pdf.php');
    // require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'dompdf' . DS . 'autoload.inc.php');
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html_to_doc.inc.php');

    use Dompdf\Dompdf;
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
            $content = '<html>
                          <head>
                            <style>
                              html, @page { margin: 1cm 1.5cm; }
                              h1, h2, h3, h4 { font-family: "Oswald"; font-weight: normal; text-transform: uppercase; }
                              h1 { margin-top: 0cm; color: #454354; }
                              body { font-family: "Lato"; color: #555555; }
                              p.small { font-size: 10px; }
                              header h1 { font-size: 57px; line-height: 65px;   }
                              a { color: #DE694B; text-decoration: none; }
                              ul.chars { list-style: none; }
                              ul.chars li h4 { margin-top: 0px; }
                            </style>
                          </head>
                          <body>

                            <header >
                              <h1 >
                                <img width="120" height="57" title="Alidade" alt="Logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAA5CAYAAAD9YO8bAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjUzRkQ4NkJERjc4OTExRTZBNkExRjI0MTMzNjUzNkYxIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjUzRkQ4NkJFRjc4OTExRTZBNkExRjI0MTMzNjUzNkYxIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NTNGRDg2QkJGNzg5MTFFNkE2QTFGMjQxMzM2NTM2RjEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NTNGRDg2QkNGNzg5MTFFNkE2QTFGMjQxMzM2NTM2RjEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4njWYxAAAHDklEQVR42uyd22sUVxzH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" />
                                Alidade
                              </h1>
                              <p>
                                This document was produced by <a href="https://alidade.tech">Alidade</a>, (<a href="https://alidade.tech">https://alidade.tech</a>), an interactive guide that guides social change organisations to the right technology tool for their projects.
                                <br />
                                It summarises your research on your users’ needs, your technology requirements and needs for help from partners.
                                <br />
                                You can use it to:
                              </p>
                              <ul>
                                <li>Agree what you need with your colleagues.</li>
                                <li>Explain your requirements to a technical partner.</li>
                                <li>Demonstrate to a funder that you have done your homework.</li>
                              </ul>
                              <h1>' . $data['title'] . '</h1>
                            </header>';
            }
            else {
                $content = '<h1>' . $data['title'] . '</h1>';
            }
            switch($step){
                case 1:
                    $content .= '<h2>1. Understand Your Needs</h2>';
                    $content .= '<p>Researching your users’ needs and your users</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 1);
                    //dbga($thisSlide);
                    $content .= '   <h3>Your Project\'s Objective</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 2);
                    $content .= '   <h3>How a tool could help achieve your projects objective</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';

                    $thisSlide = $Slide->findSlide($project, $step, 3);
                    $content .= ' <h3>Who you expect to use the tool</h3>
                                  <p><strong>' . (($thisSlide->extra == '#pick-1') ? 'We need people inside our organisation to use the tool.' : 'We need people outside our organisation to use the tool.'). '</strong></p>
                                  <p>' . (is_null($thisSlide->extra) ? '' : '<br /> ' . $thisSlide->choice) . '</p>';
                    // we need to parse a multiline response here
                    $answer = explode('##break##', $thisSlide->answer);
                    $content .= ' <h4>Who is your target audience</h4>
                                  <p>' . $answer[0] . '</p>
                                  <h4>What tools your audience already uses</h4>
                                  <p>' . $answer[1] . '</p>
                                  <h4>What might prevent them from adopting a new tool?</h4>
                                  <p>' . $answer[2] . '</p>';
                    break;
                case 2:
                    $content .=     '<h2>2. Understand The Tech</h2><p>Finding and comparing the technology tools that are available.</p>';
                    $thisSlide =    $Slide->findSlide($project, $step, 1);
                    $content .=     '<h3>YOUR REQUIREMENTS</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 2);
                    $content .= '   <h3>EXISTING TOOLS THAT HAVE THE FEATURES YOU NEED</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 3);
                    $content .= '   <h3>PROJECTS THAT HAVE USED SIMILAR TOOLS</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra)  ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 4);
                    $content .= '   <h3>RISKS AND WAYS TO MITIGATE THEM</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 5);
                    switch($thisSlide->choice){
                      case 1:
                        $choice = '<p>We will <strong>use an existing tool</strong></p>';
                        break;
                      case 2:
                        $choice = '<p>We will <strong>adapt an existing tool</strong></p>';
                        break;
                      case 3:
                        $choice = '<p>We will <strong>build a new tool</strong></p>';
                        break;
                      default:
                        $choice = null;
                        break;
                    }
                    $content .= '   <h3>TOOL THAT IS THE BEST OPTION</h3>' .
                                    $choice .
                                    '<p>' . nl2br($thisSlide->answer) . '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 6);
                    $content .= '   <h3>YOUR CAPACITY TO BUILD YOUR OWN TOOL</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';

                    break;
                case 3:
                    $content .= '<h2>3. Try it out!</h2>';
                    $thisSlide = $Slide->findSlide($project, $step, 1);
                    $content .= '   <h3>USER STORIES FOR YOUR TOOL</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';

                    $thisSlide = $Slide->findSlide($project, $step, 2);
                    $content .= '   <h3>PLANNING A TRIAL</h3>';
                    $answer = explode('##break##', $thisSlide->answer);
                    $content .= ' <h4>Describe how long you will take to trial each tool.</h4>
                                  <p>' . nl2br($answer[0]) . '</p>
                                  <h4>Open-ended questions</h4>
                                  <p>' . nl2br($answer[1]) . '</p>
                                  <h4>Training or introduction to the trial plan</h4>
                                  <p>' . nl2br($answer[2]) . '</p>';

                    $thisSlide = $Slide->findSlide($project, $step, 3);
                    $content .= '   <h3>LESSONS FROM THE TRIAL</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    break;

                case 4:
                    $content .= '<h2>4. Get Help, if you need it</h2>';
                    $thisSlide = $Slide->findSlide($project, 4, 1);
                    $choices = explode(';', $thisSlide->extra);
                    $content .= '   <h3>YOU HAVE DECIDED THAT YOU NEED HELP WITH</h3>';
                    $content .= '<ul>';
                    foreach($choices as $choice){
                        switch($choice){
                          case 1:
                            $content .= '<li>Help to choose the right tool</li>';
                            break;
                          case 2:
                            $content .= '<li>Design a tool</li>';
                            break;
                          case 3:
                            $content .= '<li>Build a tool</li>';
                            break;
                          case 4:
                            $content .= '<li>Help our organisation to implement a tool</li>';
                            break;
                          case 5:
                            $content .= '<li>Maintain a tool that we have already introduced</li>';
                            break;
                          case 6:
                            $content .= '<li>Give ongoing support to people using the tool</li>';
                            break;

                        }
                    }
                    $content .= '</ul>';

                    $thisSlide = $Slide->findSlide($project, 4, 2);
                    $answer = explode('##break##', $thisSlide->answer);
                    $titles = array(
                      'attributes an adviser on choosing or implementing a tool should have',
                      'attributes someone who will design a tool with you should have',
                      'attributes someone who will build a tool with you should have',
                      'attributes someone who maintains your tool or provides user support should have'

                    );
                    $content .= '   <h3>DESCRIBE YOUR PERFECT TECHNICAL PARTNER</h3>';
                    $content .= '<ul class="chars">';
                    foreach($answer as $i=>$a){
                      $content .= (!empty($a) ? '<li><h4>' . $titles[$i] . '<h4><p>' . nl2br($a) . '</p></li>' : '');
                    }
                    $content .= '</ul>';

                    $thisSlide = $Slide->findSlide($project, 4, 3);
                    $content .= '   <h3>LIST OF POSSIBLE CONTRACTORS</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 4);
                    $content .= '   <h3>SHORTLIST OF POSSIBLE CONTRACTORS</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 5);
                    $content .= '   <h3>POTENTIAL RISKS</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) .
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, 4, 6);
                    $content .= '   <h3>DETAILED DESCRIPTION OF WORK FOR CONTRACTOR</h3>
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

            $content .= '<p class="small">The guide was built by <a href="https://www.theengineroom.org">The Engine Room</a>, <a href="http://pawa254.org">Pawa254</a> and the <a href="http://www.networksociety.co.za">Network Society Lab</a> at the University of the Witwatersrand. It is part of a research project supported by <a href="http://www.makingallvoicescount.org/">Making All Voices Count</a></p>';

            if($type == 'pdf'){
                $content .= '</body></html>';
                // reference the Dompdf namespace


                // instantiate and use the dompdf class
                $dompdf = new Dompdf();
                $dompdf->loadHtml($content);

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');

                // Render the HTML as PDF
                $dompdf->render();

                // Output the generated PDF to Browser
                $dompdf->stream($data['title'] . '.pdf', array('Attachment' => false));
                /*
                $html2pdf = new HTML2PDF('P','A4','en');
                //$html2pdf->addFont('Oswald', 'Medium', ROOT . DS . 'public/assets/fonts/Oswald-Medium.ttf');
                $html2pdf->addFont('OpenSans', 'Regular', ROOT . DS . 'public/assets/fonts/OpenSans-Regular.ttf');
                $html2pdf->setDefaultFont('OpenSans');
                $html2pdf->WriteHTML($content);
                $html2pdf->Output('Alidade-' . $step . '.pdf'); */
            }
            elseif($type == 'doc'){
                $doc = $htmltodoc= new HTML_TO_DOC();
                $content = '<body>' . $content . '</body>';
                $doc->createDoc($content,"Alidade-" . $step, true);
            }
        }

    }
