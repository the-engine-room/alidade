<?php $origin =  !isset($original) ? null : $original[0]; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="/project/slide/<?php echo $nextSlide; ?><?php echo (!is_null($original) ? '/?p=' . $projecthash : ''); ?> " method="post">
                <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                <input type="hidden" name="current_project" value="<?php echo $_SESSION['project']; ?>">
                <h2><?php echo $slide->title; ?></h2>
                <?php
                
                if(!is_null($original)) { ?>
                <input type="hidden" name="slide_update" value="<?php echo $_SESSION['project']; ?>">
                <?php }
                if(isset($edit) && $edit == true ) { ?>
                <input type="hidden" name="edit" value="true">
                <?php }
                
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
                <?php if($currentSlide !== '1.6') { ?>
                <div class="row">
                    <div class="text-center">
                        
                        <?php
                        if(isset($inProcess) && $inProcess == true){
                            if(!is_null($prevSlide) && !empty($prevSlide)) { ?>
                            <div class="col-xs-6 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
                                <a href="/project/slide/<?php echo $prevSlide; ?>?p=<?php echo $projecthash; ?>&back" class="btn btn-main btn-lg btn-block"><i class="fa fa-angle-left"></i> Back</a>
                            </div>
                            <?php
                            }
                            else {
                            ?>
                            
                            
                            <?php 
                            }
                        }
                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-3">
                            <button type="submit" class="btn btn-main btn-lg btn-block">Forward <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </form>   
        </div>
        
        
    </div>
</div>