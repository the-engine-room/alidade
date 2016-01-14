<?php $origin =  !isset($original) ? null : $original[0]; ?>
<div class="container" id="slide-content">
    <div class="row">
        <div class="col-md-12">
            <form action="/project/tour/<?php echo $nextSlide; ?><?php echo (!is_null($original) ? '/?p=' . $projecthash : ''); ?> " method="post">
                <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                <h2><?php echo $slide->title; ?></h2>
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
                        if(isset($inProcess) && $inProcess == true){
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
        </div>
        
        
    </div>
</div>