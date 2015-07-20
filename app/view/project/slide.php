<?php $origin =  !isset($original) ? null : $original[0]; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3><?php echo "PROJECT:" . $_SESSION['project'] ; ?></h3>
            <h3><?php echo "CURRENT:" . $currentSlide; ?></h3>
            <form action="/project/slide/<?php echo $nextSlide; ?>" method="post">
                <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                <input type="hidden" name="current_project" value="<?php echo $_SESSION['project']; ?>">
                <h2><?php echo $slide->title; ?></h2>
                <?php
                
                if(!is_null($original)) { ?>
                <input type="hidden" name="slide_update" value="<?php echo $_SESSION['project']; ?>">
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
                        echo $slide->description;
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