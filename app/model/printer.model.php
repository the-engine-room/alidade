<?php

    class Printer extends Model {

      public function getSection($project, $step){
        $Slide = new Slide;
        $content = '<section>';
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
          case 2;
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
        }
        $content .= '</section>';
        return $content;
      }
    }
