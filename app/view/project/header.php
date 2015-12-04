<?php
if(!isset($page) || $page !== 'start') { 
?>

<div class="walking-steps">
    <div class="step step1">
        <div class="slides">
            <?php ?>
            <ul>
                <li><a class="slide done"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide done"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide working"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">Understanding Your Needs:</span>
        <span class="percentage">18%</span>
    </div>
    <div class="step step2">
        <div class="slides">
            <?php ?>
            <ul>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">Understand the technology:</span>
        <span class="percentage">0%</span>
    </div>
    <div class="step step3">
        <div class="slides">
            <?php ?>
            <ul>
                
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">Try it out:</span>
        <span class="percentage">0%</span>
    </div>
    <div class="step step4">
        <div class="slides">
            <?php ?>
            <ul>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
                <li><a class="slide"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">Find a partner:</span>
        <span class="percentage">0%</span>
    </div>
    
</div>













<?php } ?>
<?php /*
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-12">
            <h1><?php printTitle($currentSlide, $slide->title); ?></h1>
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="step">
                STEP 1: UNDERSTAND YOUR NEEDS
            </div>
            <div class="step">
                STEP 2: UNDERSTAND THE TECH
            </div>
            <div class="step">
                STEP 3: TRY IT OUT
            </div>
            <div class="step">
                STEP 4: FIND A PARTNER
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
                    /*
                    elseif($i == 1 && $slide_number > 1){
                        $status = '2';
                    }
                    */
                    /*
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
                for($i = 1; $i < count($slideindex[3]) + 1; $i++) {
                    if($currentSlide === '3.' . $i) {
                        $status = '1'; }
                    elseif( ((array_search((string)'3.' . $i, $slideindex['fullIndex'], true) < array_search((string)$currentSlide, $slideindex['fullIndex'], true)) && ($i < $slide_number)) || ($step_number > 3) ) {
                        $status = '2';
                    }
                    /*
                    elseif($i == 1 && $slide_number > 1){
                        $status = '2';
                    }
                    */
                    
                    /*
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
                    /*
                    elseif($i == 1 && $slide_number > 1){
                        $status = '2';
                    }
                    */
                    
                    /*
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
<?php }  */ ?>
