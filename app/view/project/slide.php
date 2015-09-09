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
                <div class="text-center">                    
                    <button type="submit" class="btn btn-primary btn-lg">go ahead!</button>
                </div>
                <?php } ?>
            </form>   
        </div>
        
        
    </div>
</div>