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
                    elseif( (array_search((string)'1.' . $i, $slideindex['fullIndex'], true) < array_search((string)$currentSlide, $slideindex['fullIndex'], true)) && ($i < $slide_number) ) {
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
                for($i = 1; $i<10; $i++) {
                ?>    
                <div class="slide-position slide-position-0 step-2" style="width: 11.1111%;"></div>
                <?php    
                }
                ?>
            </div>
            <div class="step">
                <?php
                for($i = 1; $i<8; $i++) {
                ?>    
                <div class="slide-position slide-position-0 step-3" style="width: 14.2857%;"></div>
                <?php    
                }
                ?>
            </div>
            <div class="step">
            <?php
            for($i = 1; $i<15; $i++) {
            ?>    
            <div class="slide-position slide-position-0 step-4" style="width: 7.1428%;"></div>
            <?php    
            }
            ?>
        </div>
    
        
        </div>
    </div>
</div>