<?php $origin =  !isset($original) ? null : $original[0]; ?>
<div class="container" id="slide-content">
    <div class="row">
        <div class="col-md-12">
            <?php
                if($currentSlide == '1.11'){
            ?>
            <div class="tour-content">
            <h2>1.11</h2>
            <div class="alert alert-info tour-alert">
                <h2><i class="fa fa-exclamation-circle"></i> This is a preview that shows you how the Tool Selection Assistant works.</h2>
                <p>This step summarises all your decisions at the end of each step (the text below is an example). You can show it to colleagues, donors or advisers to explain what you want. </p>
                <p>There are three more steps in the full guide. To try it out, <a href="/user/create">register here</a> (or if you've already created an account, <a href="/user/login">login here</a>).</p>
            </div>
            
            <h3>Recap of Step 1</h3>
            <p><span style="line-height: 1.42857;">Look back at the information you have submitted. Is anything missing?</span><br></p>
            <h3>Step 1 Checklist</h3>
                <ul>
                    <li>
                        <a href="#" class="ajx tsa-tooltip">Project objective</a>&nbsp;
                        <div class="tsa-tooltip-wrap">
                            <p>Our project aims to allow users of a clinic to monitor the quality of service provision at 10-15 clinics in our city. </p>
                            <p><em></em></p>
                        </div>
                    </li>
                    <li><a href="#" class="ajx tsa-tooltip">How a tool could help</a>&nbsp;<div class="tsa-tooltip-wrap"><p>A mobile data collection tool could allow clinic users to rate how well the clinic had met their needs. It could work more quickly than a paper feedback form, and the data would be easier to analyse and process. </p><p><em></em></p></div></li>
                    <li><a href="#" class="ajx tsa-tooltip">Description of users</a>&nbsp;<div class="tsa-tooltip-wrap"><p>Clinic users at the 35 clinics in our city: both women and men, aged 25-50. Many are on low incomes, and most of them have mobile phones - feature phones, not smartphones </p><p><em></em></p></div></li>
                    <li><a href="#" class="ajx tsa-tooltip">Incentives for using a tool</a>&nbsp;<div class="tsa-tooltip-wrap"><p>They will be able to find out information about which clinics are treating their patients well, and choose a better clinic for them<br>They will be able to submit information in a simple way using a tool that they already have.  </p><p><em></em></p></div></li>
                    <li><a href="#" class="ajx tsa-tooltip">Users' skills and experience</a>&nbsp;<div class="tsa-tooltip-wrap"><p>They mainly use feature phones that are only capable of sending SMS messages (though a small number have smartphones, but access to mobile data is limited). They don't tend to look up information online, but they do get information through radio. They mainly use phones to communicate with their friends and family, and less so for other purposes. </p><p><em></em></p></div></li>
                    <li><a href="#" class="ajx tsa-tooltip">Obstacles</a>&nbsp;<div class="tsa-tooltip-wrap"><p>Many people in our target community have smartphones and intermittent data coverage, but data is expensive. People might not think that our tool is worth their money.<br>They might also be suspicious of us because similar initiatives often come to their area looking for participants but haven't told them about the results. So we'll have to be careful about how we introduce and market our project.<br><br>People might not use the tool if it's too complicated, and we don't have enough the resources to train them, so we will have to test it with them to make sure that it's really easy to use </p><p><em></em></p></div></li>
                </ul>
                
                <p>Output your answers into a document that you can save or print:</p><p><a href="/assets/example-project.pdf" class="btn btn-main printer" target="_blank"><i class="fa fa-file-pdf-o"></i> Download [PDF]</a> </p>
                    
                    <h3 style="color: rgb(0, 0, 0);">Next</h3><p><span style="line-height: 1.42857;">What is missing from your list? Show the document with colleagues or contacts you trust - they can help you spot gaps.&nbsp;</span><span style=" line-height: 21.5873px; text-align: right;">The Engine Room will happily look at your document and help if we can.&nbsp;</span><a href="mailto:post@theengineroom.org" target="_blank" style=" line-height: 21.5873px; text-align: right; background-color: rgb(255, 255, 255);">Get in touch!</a></p><p><span style="line-height: 1.42857;"> </span></p>


                    <p><span style="line-height: 1.42857;">Try </span><a href="http://tsadev.zardtech.com/page/get-help#users" style="line-height: 1.42857; background-color: rgb(255, 255, 255);">these links</a><span style="line-height: 1.42857;"> for other resources that can help.&nbsp;</span><span style="line-height: 22.8571px;">Once you have information that's good enough, move on to the next section.</span></p><div class="row">
                    
            </div>
            </div>
            <?php                    
                }
                else { 
                
            ?>
            
            <form action="/project/tour/<?php echo $nextSlide; ?>" method="post" class="tour-content">
                <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                <h2><?php echo $slide->title; ?></h2>
                
                <div class="alert alert-info tour-alert">
                    <h2><i class="fa fa-exclamation-circle"></i> This is a preview that shows you how the Tool Selection Assistant works.</h2>
                    <p>Information you add into the text boxes will <strong>not</strong> be saved.</p>
                    <p>Registering lets you start your own projects, save your progress and create PDF or Word documents summarising your work. <a href="/user/create">Register here</a> (or if you've already created an account, <a href="/user/login">login here</a>).</p>
                </div>

                <?php
                switch($slide->slide_type){
                    case 1:
                        echo $slide->description;
                        break;
                    case 2:
                        echo injectAnswerField($slide->description, 'answer', $origin);
                        break;
                    case 3:
                        echo injectAnswerField($slide->description, 'answer', $origin);
                        break;
                    default:
                        $text = injectParam($slide->description, 'project', $_SESSION['project']);
                        $text = injectParam($text, 'step', $step_number);
                        echo $text;
                        break;
                }
                ?>
                <div class="row">
                    <div class="text-center">                        
                        <?php
                        if(isset($inTour) && $inTour == true){
                            if(!is_null($prevSlide) && !empty($prevSlide)) { ?>
                            <div class="col-xs-6 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
                                <a href="/project/tour/<?php echo $prevSlide; ?>?p=<?php echo $projecthash; ?>&back" class="btn btn-main btn-lg btn-block"><i class="fa fa-angle-left"></i> Back</a>
                            </div>
                            <?php
                            }
                            if(!is_null($nextSlide) && !empty($nextSlide)) {
                            ?>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <button type="submit" class="btn btn-main btn-lg btn-block">Forward <i class="fa fa-angle-right"></i></button>
                            </div>
                            <?php 
                            }
                        }
                        ?>
                        <?php if($currentSlide == '1.6') { ?>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <a href="/project/tour/1.11?skipped" class="btn btn-main btn-lg btn-block">Skip user research <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
            </form>
            
            <?php
                }
            ?>
        </div>
        
        
    </div>
</div>
