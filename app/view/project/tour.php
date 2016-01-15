<?php $origin =  !isset($original) ? null : $original[0]; ?>
<div class="container" id="slide-content">
    <div class="row">
        <div class="col-md-12">
            <?php
                if($currentSlide == '1.11'){
            ?>
            <h2>There are 3 more steps and lots more in the full blown tool!</h2>
            
            <p>You can get reports in PDF and MS Word format to share with colleagues, partners and stakeholders, links to resources and guidance in the full tool.</p>
            <p>If you think this was helpful and want to learn more, <a href="/user/create">register now</a> and start your new project research!</p>
            <?php                    
                }
                else { 
                
            ?>
            
            <form action="/project/tour/<?php echo $nextSlide; ?>" method="post">
                <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                <h2><?php echo $slide->title; ?></h2>
                
                <div class="alert alert-info">
                    <h2><i class="fa fa-exclamation-circle"></i> This is a tour, or trial of the tool, if you will.</h2>
                    Please note that, since this is the trial tour, your answers are <strong>not</strong> being saved, registered or memorised in any way.<br />
                    To get the full experience, please <a href="/user/create">register</a> or <a href="/user/login">login</a>.
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