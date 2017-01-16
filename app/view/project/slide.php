<?php $origin =  !isset($original) ? null : $original[0]; ?>
<div class="container" id="slide-content">
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
                
                
                $prevAnswer = injectPrevAnswer($slide->description);
                if($prevAnswer){
                    $slide->description = $prevAnswer['content'];
                }
                
                
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
                                <a href="/project/slide/<?php echo $prevSlide; ?>?p=<?php echo $projecthash; ?>&back" class="btn btn-main btn-lg btn-block"><i class="fa fa-angle-left"></i> Back</a>
                            </div>
                            
                            <?php if($currentSlide == '1.6') { ?>
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <a href="/project/slide/1.11?skipped" class="btn btn-main btn-lg btn-block">Skip user research <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <?php } ?>
                            
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
                        
                    </div>
                </div>
                
            </form>   
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
                    <textarea class="form-control" rows="8" id="answer" name="answer"><?php echo $prevAnswer['slide']->answer; ?></textarea>    
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