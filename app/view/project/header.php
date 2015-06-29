<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Tool Selection Assistant <small><?php echo $currentSlide; ?></small></h1>           
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="step">
                STEP 1
            </div>
            <div class="step">
                STEP 2
            </div>
            <div class="step">
                STEP 3
            </div>
            <div class="step">
                STEP 4
            </div>
        
            <div class="step">
                <?php
                for($i = 1; $i< count($slideindex[1]) + 1; $i++) {
                    
                    if($currentSlide === '1.' . $i) {
                        $status = '1'; }
                    elseif(
                           ((array_search((string)'1.' . $i, $slideindex['fullIndex'], true) < array_search((string)$currentSlide, $slideindex['fullIndex'], true))
                           && ($i < $slide_number))
                           || ($step_number > 1)) {
                        $status = '2';
                    }
                    elseif($i == 1 && $slide_number > 1){
                        $status = '2';
                    }
                    else {
                        $status = '0';    
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-1" style="width: <?php echo round( (100/count($slideindex[1])) , 4); ?>%;"></div>
                <?php    
                }
                ?>
            </div>
            <div class="step">
                <?php
                for($i = 1; $i< count($slideindex[2]) + 1; $i++) {
                    if($currentSlide === '2.' . $i) {
                        $status = '1'; }
                    elseif( ((array_search((string)'2.' . $i, $slideindex['fullIndex'], true) < array_search((string)$currentSlide, $slideindex['fullIndex'], true)) && ($i < $slide_number)) || ($step_number > 2) ) {
                        $status = '2';
                    }
                    elseif($i == 1 && $slide_number > 1){
                        $status = '2';
                    }
                    else {
                        $status = '0';    
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-2" style="width: <?php echo round( (100/count($slideindex[2])) , 4); ?>%;"></div>
                <?php    
                }
                ?>
            </div>
            <div class="step">
                <?php
                for($i = 1; $i< count($slideindex[3]) + 1; $i++) {
                    if($currentSlide === '3.' . $i) {
                        $status = '1'; }
                    elseif( ((array_search((string)'3.' . $i, $slideindex['fullIndex'], true) < array_search((string)$currentSlide, $slideindex['fullIndex'], true)) && ($i < $slide_number)) || ($step_number > 3) ) {
                        $status = '2';
                    }
                    elseif($i == 1 && $slide_number > 1){
                        $status = '2';
                    }
                    else {
                        $status = '0';    
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-3" style="width: <?php echo round( (100/count($slideindex[3])) , 4); ?>%;"></div>
                <?php    
                }
                ?>
            </div>
            <div class="step">
            <?php
                for($i = 1; $i< count($slideindex[4]) + 1; $i++) {
                    if($currentSlide === '4.' . $i) {
                        $status = '1'; }
                    elseif( (array_search((string)'4.' . $i, $slideindex['fullIndex'], true) < array_search((string)$currentSlide, $slideindex['fullIndex'], true)) && ($i < $slide_number) ) {
                        $status = '2';
                    }
                    elseif($i == 1 && $slide_number > 1){
                        $status = '2';
                    }
                    else {
                        $status = '0';    
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-4" style="width: <?php echo round( (100/count($slideindex[4])) , 4); ?>%;"></div>
                <?php    
                }
                ?>
        </div>
    
        
        </div>
    </div>
</div>

