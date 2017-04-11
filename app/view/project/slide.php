<?php
    $origin = !isset($original) ? null : $original[0];
    $slideListMenu = $slideMenu;
    reset($slideListMenu);
    while(key($slideListMenu) != $currentSlide ) { next($slideListMenu); }
    $backSlide = prev($slideListMenu);
    $backKey = key($slideListMenu);

?>
<div class="container-fluid slide-<?php echo $currentSlide; ?> step-<?php echo substr($currentSlide, 0, 1); ?> " id="slide-page" >
    <div class="row slide-container">
        <div class="col-md-2 col-sm-4 hidden-xs" id="slide-sidebar">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="col-md-10 col-sm-8 col-xs-12" id="slide-content">
            <?php
            if($currentSlide == '1.3'){
                if(!empty($origin->answer) && !empty($origin->extra) ) {
                    $extra = !empty($origin->extra) ? $origin->extra : '';
                    $answer = explode('##break##', $origin->answer);
                    $answer = array_map('trim', $answer);
                }

                if(!empty($backSlide)) {
                ?>
            <a class="back-link" href="/project/slide/<?php echo $backKey; ?>/?p=<?php echo $hash; ?>&edit"><i class="fa fa-chevron-left"></i> BACK: <?php echo $backSlide; ?></a>
            <?php } ?>
            <h1><?php echo $currentSlide . ' ' . $slide->title; ?></h1>

            <form action="/project/slide/<?php echo $nextSlide . '/?p=' . $projecthash ; ?> " method="post" id="mainForm">
                <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                <input type="hidden" name="current_project" value="<?php echo $_SESSION['project']; ?>">
                <input type="hidden" name="hash"  value="<?php echo $projecthash; ?>">
                <input type="hidden" name="next_slide"  value="<?php echo $nextSlide; ?>">
                <?php if(!is_null($original)) { ?>
                <input type="hidden" name="slide_update" value="<?php echo $_SESSION['project']; ?>">
                <?php } if(isset($edit) && $edit == true ) { ?>
                <input type="hidden" name="edit" value="true">
                <?php } ?>
                <input type="hidden" name="extra" value="<?php echo(!empty($extra) ? $extra : 'no'); ?>" id="extra13">
                <div class="row">
                    <div class="col-md-7">
                        <p>This is a very important part of the process. If you think deeply now about your users, you will be more likely to choose a tool that is a great fit for everyone.</p>
                        <p>You will need to do different kinds of research depending on whether your users are inside or outside your organisation.</p>

                        <div class="13-buttons <?php echo (isset($extra) && $extra != 'no' ? 'hide' : ''); ?>">
                            <p>Choose one of the following options:</p>
                            <a href="#" class="btn btn-alidade btn-lg picker" data-target="#pick-1">People in our organisation</a> or <a href="#" class="btn btn-alidade btn-lg picker" data-target="#pick-2">People outside our organisation</a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-research">
                            <h3>Research Finding</h3>
                            "To work well, technology for transparency and accountability initiatives need to be integrated into people’s existing ways of doing things... Case after case and study after study show that significant behaviour change cannot be expected to ensue from telling potential users what is good for them.” — Rosemary McGee and Ruth Carlitz, <a target="_blank" href="https://www.ids.ac.uk/publication/learning-study-on-the-users-in-technology-for-transparency-and-accountability-initiatives-assumptions-and-realities">Learning Study on ‘the Users’ in Technology for Transparency and Accountability Initiatives</a>, p.30.
                        </div>
                        <div class="box box-research">
                            <h3>Research Finding</h3>
                            Less than one-quarter of organisations we spoke to did any field research with users (8/32). They often told us that they regretted not spending more time on thinking about who would use the tool, and how they would use it.
                        </div>
                    </div>
                </div>
                <div class="row <?php echo ((isset($extra) && $extra != 'no') ? 'hide' : ''); ?> picks" id="pick-1">
                    <div class="col-md-7">
                        <h3>We only need people in our organisation to use the tool.</h3>
                        <p><small>Wait! I changed my mind. <a href="#" class="picker" data-target="#pick-2">We want people outside our organisation to use the tool.</a></small></p>
                    </div>
                    <div class="col-md-5"></div>

                    <div class="col-md-7">
                        <p><strong>1. Describe the people that will use the tool</strong><br />
                        List any people or groups that you hope will use the tool.</p>
                        <textarea id="13-a1" name="a[1]" class="form-control" rows="8"><?php echo ((isset($extra) && $extra == '#pick-1') ? $answer[0] : ''); ?></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-tips">
                            <h3>tips</h3>
                            <p>Think about some of the best ways to get this information:</p>
                            <ul>
                                <li>If it’s a small group, try one-on-one conversations or a short meeting with the users. </li>
                                <li>If your group is larger or based in different places, try short emails with a few questions.</li>
                                <li>Consider a very quick (3-4-question) online survey using a free tool like Google forms or Typeform.</li>
                                <li>Ask someone else who knows these people well.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <p><strong>2. How are your potential users approaching the issue now?</strong><br />
                        Are any of them already using an existing tool effectively?</p>
                        <textarea id="13-a2" name="a[2]" class="form-control" rows="8"><?php echo ((isset($extra) && $extra == '#pick-1') ? $answer[1] : ''); ?></textarea>
                    </div>
                    <div class="col-md-5">
                    </div>

                    <div class="col-md-7">
                        <p><strong>3. Could anything prevent them from using a new tool?</strong><br />
                        Look for any issues that could stop people from using your tool. Thinking about this in advance will help you plan. <br />
                        Here are some questions to help you start:</p>
                        <ul>
                            <li>Do they already think they need a tool, or will you have to persuade them to use it? </li>
                            <li>Do they have the technical skills they need? Will they have enough time to learn how a new tool works? </li>
                            <li>Are there costs involved, and can they afford them?</li>
                        </ul>
                        <p>There may be other questions that are worth asking in your organization. Take your time to write them down.</p>
                        <textarea id="13-a3" name="a[3]" class="form-control" rows="8"><?php echo ((isset($extra) && $extra == '#pick-1') ? $answer[2] : ''); ?></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-tips">
                            <h3>tips</h3>
                            Not everyone will take a new tool to heart. Engaging people can increase the use of your tool:
                            <ul>
                                <li>providing training</li>
                                <li>create tutorials</li>
                                <li>ask proficient users to help out</li>
                            </ul>
                            Maybe something else would work better for your organization. Take time and find the best solution.}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <?php if(!is_null($nextSlide) && !empty($nextSlide)) { ?>
                        <button type="submit" class="btn btn-alidade btn-lg">NEXT: <?php echo $slideMenu[$nextSlide]; ?></button>
                        <?php } ?>
                    </div>
                </div>


                <div class="row <?php echo ((isset($extra) && $extra == '#pick-1') ? 'hide' : ''); ?>  picks" id="pick-2">

                    <div class="col-md-7">
                        <h3>We want people outside our organisation to use the tool.</h3>
                        <p><small>Wait! I changed my mind. <a href="#" class="picker" data-target="#pick-1">We need people inside our organisation to use the tool.</a></small></p>
                    </div>
                    <div class="col-md-5"></div>

                    <div class="col-md-7">
                        <p><strong>1. Describe your target audience</strong><br />
                        Write down what you already know about them. What do they have in common? <br />
                        Include demographic information such as age, location, occupation or gender, etc.<br />
                        If your user group contains many different types of people, break them down into sub-groups.<br />
                        Write a profile of your intended user. Pretend you are describing them to someone who knows nothing about them.</p>

                        <p>There may be other questions that are worth asking in your organization. Take your time to write them down.</p>
                        <textarea id="13-b1" name="b[1]" class="form-control" rows="8"><?php echo ((isset($extra) && $extra == '#pick-2') ? $answer[0] : ''); ?></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-example">
                            <h3>example</h3>
                            ‘residents of districts X, Y and Z in City A’<br />
                            ‘men aged 18-25'<br /><br />
                            Our typical user cares about their local area but does not have time to attend public meetings or demonstrations. They are generally dissatisfied with the quality of public service delivery but isn't sure that complaining about it will help to improve it.  They don't often contact the authorities to make a complaint or ask for changes to services, but if they do they usually to do so through phone calls to the general phone number for their local area.
                        </div>
                        <div class="box box-tips">
                            <h3>tips</h3>
                            Think about the best ways to get this information:
                            <ul>
                                <li>Talk with people who are like the users you are trying to reach.  If the group is small, try one-on-one conversations or arranging a short meeting with them. </li>
                                <li>If your group is larger or based in different places, try meetings or finding places where they already group together.</li>
                                <li>You will not be the first organisation to try to reach those people. Are similar initiatives reaching that same population, and how did they go? Are there networks or community groups where conversations with your target users are already happening?</li>
                                <li>Think about who might be left out by these methods, and try to find ways of reaching them too.</li>
                            </ul>
                        </div>
                        <div class="box box-resources">
                            <h3>Resources</h3>
                            Transparency and Accountability Initiative's Fundamentals guide gives good guidance on  thinking about your users.
                            <ul>
                                <li>The Digital Principles' section on Designing with the User gives useful guidelines and resources.</li>
                                <li>Tactical Tech's Know Your Audience guide has useful steps for finding out more about your users.</li>
                                <li>Keystone Accountability's Learning from Constituents offers detailed guidelines on how to get information about your users, from surveys to formal dialogue processes.</li>
                                <li>The UK Government Digital Service's digital principles and guide to writing user stories are also useful resources.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <p><strong>2. Why would they want to use your tool? What will they get out of it?</strong><br />
                        Write why you think your users would be interested in the tool. <br />
                        This means making assumptions. You will check them later in Step 3. </p>
                        <textarea id="13-b2" name="b[2]" class="form-control" rows="8"><?php echo ((isset($extra) && $extra == '#pick-2') ? $answer[1] : ''); ?></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-example">
                            <h3>Example</h3>
                            We assume that our users will want to send feedback about a clinic they have used because they think it will improve the service they are given. We assume that they will be more likely to send feedback if they can use their phones to do so, because this will make it easier and cheaper for them.
                        </div>

                        <div class="box box-casestudy">
                            <h3>Case study</h3>
                            We decided to use Facebook in the project. Later, we found out that it was very popular only with white middle-class people, not the black, working-class communities the project was trying to reach.
                        </div>
                    </div>

                    <div class="col-md-7">
                        <p><strong>3. What technology tools does your target audience already use?</strong><br />
                        Some questions that might help:</p>
                        <ul>
                            <li>Do users have habits build around those tools?</li>
                            <li>Are there specific times or places that your typical user accesses information or interacts with other people?</li>
                            <li>What are the main methods your typical member uses to achieve this? </li>
                            <li>Do they prefer to use particular tools for some activities, and different tools (like email) for others? Find out why.</li>
                        </ul>
                        <textarea id="13-b3" name="b[3]" class="form-control" rows="8"><?php echo ((isset($extra) && $extra == '#pick-2') ? $answer[2] : ''); ?></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-example">
                            <h3>Example</h3>
                            Our typical user does not use internet-based messaging services like WhatsApp because mobile data is currently too expensive for them. They get information about politics through newspapers rather than the internet, and prefer to access information through their phone rather than a desktop computer. They use social media (mainly Facebook) for talking to friends several times a week, but do not use it for talking about other topics. They only rarely use email.
                        </div>

                        <div class="box box-casestudy">
                            <h3>Case study</h3>
                            "We expected, as everyone said, that everyone would use SMS. All the techies were crazy about it. Then when you really talk to [a person with a similar project] he says that 99% of the complaints came in by telephone, and 1% by SMS. That is a striking number. He says, 'well, you can be try to be as fancy as you want, but it does not work.'"
                        </div>
                    </div>





                    <div class="col-md-7">
                        <p><strong>4. Could anything prevent them from using a new tool?</strong><br />
                        Look for any issues that could stop people from using your tool. Thinking about this in advance will help you plan.<br />
                        Here are some questions to help you start:</p>
                        <ul>
                            <li>Do they already think they need a tool, or will you have to persuade them to use it? </li>
                            <li>Do they have the technical skills they need? Will they have enough time to learn how a new tool works? </li>
                            <li>Are there costs involved, and can they afford them?</li>
                        </ul>
                        <p>
                        There may be other questions that are worth asking for your target user. Take your time to write them down.
                        </p>
                        <textarea id="13-b4" name="b[4]" class="form-control" rows="8"><?php echo ((isset($extra) && $extra == '#pick-2') ? $answer[3] : ''); ?></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-example">
                            <h3>Example</h3>
                            Many people in our target community have smartphones and intermittent data coverage, but data is expensive. People might not think that our tool is worth their money.<br />
                            They might also be suspicious of us because similar initiatives often come to their area looking for participants but haven't told them about the results. So we'll have to be careful about how we introduce and market our project.<br />
                            People might not use the tool if it's too complicated, and we don't have enough the resources to train them, so we will have to test it with them to make sure that it's really easy to use.)
                        </div>

                        <div class="box box-tips">
                            <h3>tips</h3>
                            Be aware that not everyone will take a new tool to heart. Think how to engage people to increase use:
                            <ul>
                            <li>providing training sessions</li>
                            <li>create tutorials</li>
                            <li>point people to forums where they can ask others for help.</li>
                            </ul>
                            Other options may work best for your organization. Take time and find the best.
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php if(!is_null($nextSlide) && !empty($nextSlide)) { ?>
                        <button type="submit" class="btn btn-alidade btn-lg">NEXT: <?php echo $slideMenu[$nextSlide]; ?></button>
                        <?php } ?>
                    </div>
                </div>


            </form>
            <?php
            } else {
            ?>
            <div class="row">
              <div class="col-md-10 col-sm-8 col-xs-12">
                <?php if(!empty($backSlide)) { ?>
                <a class="back-link" href="/project/slide/<?php echo $backKey; ?>/?p=<?php echo $hash; ?>&edit"><i class="fa fa-chevron-left"></i> BACK: <?php echo $backSlide; ?></a>
                <?php } ?>
                <h1><?php echo $currentSlide . ' ' . $slide->title; ?></h1>
              </div>
            </div>

            <div class="row">
                <div class="col-md-7 col-sm-8 col-xs-12">
                    <form action="/project/slide/<?php echo $nextSlide . '/?p=' . $projecthash ; ?> " method="post"  id="mainForm">
                        <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                        <input type="hidden" name="hash"  value="<?php echo $projecthash; ?>">
                        <input type="hidden" name="next_slide"  value="<?php echo $nextSlide; ?>">
                        <input type="hidden" name="current_project" value="<?php echo $_SESSION['project']; ?>">
                        <input type="hidden" id="extra-holder" value="<?php echo $origin->extra; ?>">

                        <?php
                        /** check for preselected options in slide 4.2 **/
                        if($currentSlide == '4.2') {
                          $selection = !empty($selection) ? implode(';', $selection) : '';

                        ?>
                        <input type="hidden" name="preselected" id="preselected" value="<?php echo $selection; ?>">
                        <?php } ?>

                        <?php

                        if(!is_null($original)) { ?>
                        <input type="hidden" name="slide_update" value="<?php echo $_SESSION['project']; ?>">
                        <?php }
                        if(isset($edit) && $edit == true ) { ?>
                        <input type="hidden" name="edit" value="true">
                        <?php }
                        /** check if this is a recap slide **/
                        if($slide->slide_type == 4){
                          $boxes = injectBox($slide->description);
                          $text = $boxes['content'];
                          echo injectRecap($text);

                        } else {

                          $boxes = injectBox($slide->description);
                          $text = $boxes['content'];

                          $prevAnswer = injectPrevAnswer($text);
                          if($prevAnswer){
                            $text = $prevAnswer['content'];
                          }

                          // multiple answer slides
                          if( in_array( $currentSlide, $multiSlides )){
                            echo injectMultipleAnswerField($text, 'answer', $origin);
                          }
                          else {
                            switch($slide->slide_type){
                              case 1:
                                echo $text;
                                break;
                              case 2:
                                echo injectAnswerField($text, 'answer', $origin);
                                break;
                              case 3:
                                echo injectAnswerField($text, 'answer', $origin);
                                break;
                              default:
                                $text = injectParam($text, 'project', $_SESSION['project']);
                                $text = injectParam($text, 'step', $step_number);
                                echo $text;
                                break;
                            }
                          }
                        }


                        ?>
                        <div class="row" id="slide-buttons">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <?php
                                if($slide->slide_type == 4) {
                              ?>
                              <a href="/printer/output/<?php echo $_SESSION['project'] . '/' . substr($currentSlide, 0, 1); ?>" target="_blank" class="btn btn-alidade btn-lg">Download PDF</a>
                              <?php
                                }
                              ?>
                                <?php
                                if(isset($inProcess) && $inProcess == true){
                                    if($currentSlide == '3.5') {
                                ?>
                                <p></p>
                                <p>Do you need more help to choose, build or implement a tool?</p>
                                <button type="submit" class="btn btn-alidade btn-lg">Yes, we need help</button> or <a href="/project/slide/4.8?p=<?php echo $hash; ?>" class="btn btn-alidade btn-lg">No, we don't</a>
                                <?php
                                }
                                elseif(!is_null($nextSlide) && !empty($nextSlide)) {
                                ?>
                                <button type="submit" class="btn btn-alidade btn-lg">NEXT: <?php echo $slideMenu[$nextSlide]; ?></button>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-12">
                  <aside>
                  <?php
                  if($slide->slide_type == 4) {
                    echo '<img class="img-responsive" src="/assets/images/tool/RecapStep' . $slide->step . '.svg" alt="' . $slide->title . '">';
                  }
                  elseif($slide->slide_type == 1){
                    echo '<img class="img-responsive center-block" src="/assets/images/six-rules/Step' . $slide->step . '.svg" alt="' . $slide->title . '"><p></p>';

                  }
                  ?>
                  <?php echo (!empty($boxes) && isset($boxes) ? implode(' ', $boxes['boxes']) : ''); ?>
                  </aside>
                </div>
            </div>
        <?php  } ?>
      </div>
    </div>
</div>

<?php
if ($prevAnswer) {
// load modal box for the previous answer editing functionality
?>

<div class="modal fade editPrevAnswer" tabindex="-1" role="dialog" aria-labelledby="editPrevAnswer">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="/save" method="post" class="saveAnswer">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"><?php echo $prevAnswer['slide']->title; ?></h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="slide" value="<?php echo $prevAnswer['slide']->idslides; ?>">
                <div class="form-group">
                    <?php
                    if($prevAnswer['multi'] == true){
                        $parts = array_map('trim', explode('##break##', $prevAnswer['slide']->answer));
                        foreach($parts as $i => $part){
                    ?>
                    <textarea class="form-control answer" rows="8" id="answer-<?php echo $i; ?>" name="answer[<?php echo $i; ?>]"><?php echo $part; ?></textarea>
                    <?php
                        }
                    } else { ?>
                    <textarea class="form-control" rows="8" id="answer" name="answer"><?php echo $prevAnswer['slide']->answer; ?></textarea>
                    <?php } ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>

<?php } ?>

<?php if($currentSlide == '1.0'){ ?>
  <div class="modal fade welcome" tabindex="-1" role="dialog" aria-labelledby="welcome">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title" id="myModalLabel">Hello!</h2>
        </div>
        <div class="modal-body">
          <h4>Thanks for using Alidade! We hope it helps you.</h4>
          <p>Follow the steps to create a strategy plan for your tech project. You can skip steps and complete them in any order.</p>
          <p>Used Alidade before? <a href="#" class="register-from-modal" data-toggle="modal" data-target="#user-forms">Login</a>.</p>
          <p>Want to save your progress for later? <a href="#" class="register-from-modal" data-toggle="modal" data-target="#user-forms">Register</a>.</p>
          <p>All your data will be saved automatically until you close this page.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-alidade btn-lg" data-dismiss="modal">Let's get started</button>
        </div>
      </div>
    </div>
  </div>

<?php } ?>
