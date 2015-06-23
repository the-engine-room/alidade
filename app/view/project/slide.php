
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="/project/slide/<?php echo $nextSlide; ?>" method="post">
                <h2><?php echo $slide->title; ?></h2>
                <?php
                switch($slide->slide_type){
                    case 1:
                        echo $slide->description;
                        break;
                    case 2:
                        echo injectAnswerField($slide->description);
                        break;
                    case 3:
                        echo injectAnswerField($slide->description);
                        break;
                    default:
                        echo $slide->description;
                        break;
                }
                ?>
                <?php if($currentSlide !== '1.6') { ?> 
                <div class="text-center">
                    <input type="hidden" name="current_slide"  value="<?php echo $currentSlide; ?>">
                    <button type="submit" class="btn btn-primary btn-lg">go ahead!</button>
                </div>
                <?php } ?>
            </form>   
        </div>
        
        
    </div>
</div>