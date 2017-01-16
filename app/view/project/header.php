<?php
if(!isset($page) || $page !== 'start') {
$currs = explode('.', $currentSlide);
?>
<?php
$piece = ($inTour ? 'tour' : 'slide');
?>

<div class="walking-steps">
    <div class="step step1 <?php echo ($currs[0] == 1 ? '' : 'hidden-xs'); ?>">
        <div class="slides hidden-xs">
            <?php ?>
            <ul>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.1']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 1); ?>" href="/project/<?php echo $piece; ?>/1.1<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.2']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 2); ?>" href="/project/<?php echo $piece; ?>/1.2<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.3']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 3); ?>" href="/project/<?php echo $piece; ?>/1.3<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.4']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 4); ?>" href="/project/<?php echo $piece; ?>/1.4<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.5']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 5); ?>" href="/project/<?php echo $piece; ?>/1.5<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.6']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 6); ?>" href="/project/<?php echo $piece; ?>/1.6<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.7']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 7); ?>" href="/project/<?php echo $piece; ?>/1.7<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.8']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 8); ?>" href="/project/<?php echo $piece; ?>/1.8<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.9']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 9); ?>" href="/project/<?php echo $piece; ?>/1.9<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.10']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 10); ?>" href="/project/<?php echo $piece; ?>/1.10<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['1.11']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, 11); ?>" href="/project/<?php echo $piece; ?>/1.11<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">1. Understanding Your Needs:</span>
        <span class="percentage"><?php echo ( ($currs[0] == 1 ? $currs[1] : count($slideindex[1]) )  . '/' . count($slideindex[1])); ?></span>
    </div>
    <div class="step step2 <?php echo ($currs[0] == 2 ? '' : 'hidden-xs'); ?>">
        <div class="slides hidden-xs">
            <?php ?>
            <ul>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['2.1']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, 1); ?>" href="/project/<?php echo $piece; ?>/2.1<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['2.2']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, 2); ?>" href="/project/<?php echo $piece; ?>/2.2<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['2.3']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, 3); ?>" href="/project/<?php echo $piece; ?>/2.3<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['2.4']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, 4); ?>" href="/project/<?php echo $piece; ?>/2.4<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['2.5']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, 5); ?>" href="/project/<?php echo $piece; ?>/2.5<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['2.6']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, 6); ?>" href="/project/<?php echo $piece; ?>/2.6<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['2.7']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, 7); ?>" href="/project/<?php echo $piece; ?>/2.7<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">2. Understand the technology:</span>
        <span class="percentage"><?php echo ($currs[0] == 2 ? $currs[1] : ( $currs[0] > 2 ?  count($slideindex[2]) : 0 )) . '/' . count($slideindex[2]); ?></span>
    </div>
    <div class="step step3 <?php echo ($currs[0] == 3 ? '' : 'hidden-xs'); ?>">
        <div class="slides hidden-xs">
            <?php ?>
            <ul>
                
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['3.1']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, 1); ?>" href="/project/<?php echo $piece; ?>/3.1<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['3.2']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, 2); ?>" href="/project/<?php echo $piece; ?>/3.2<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['3.3']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, 3); ?>" href="/project/<?php echo $piece; ?>/3.3<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['3.4']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, 4); ?>" href="/project/<?php echo $piece; ?>/3.4<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['3.5']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, 5); ?>" href="/project/<?php echo $piece; ?>/3.5<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['3.6']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, 6); ?>" href="/project/<?php echo $piece; ?>/3.6<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['3.7']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, 7); ?>" href="/project/<?php echo $piece; ?>/3.7<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">3. Try it out:</span>
        <span class="percentage"><?php echo ( ($currs[0] == 3 ? $currs[1] : ( $currs[0] > 3 ? count($slideindex[3]) : 0 )) . '/' . count($slideindex[3])); ?></span>
    </div>
    <div class="step step4 <?php echo ($currs[0] == 4 ? '' : 'hidden-xs'); ?>">
        <div class="slides hidden-xs">
            <?php ?>
            <ul>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.1']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 1); ?>" href="/project/<?php echo $piece; ?>/4.1<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.2']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 2); ?>" href="/project/<?php echo $piece; ?>/4.2<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.3']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 3); ?>" href="/project/<?php echo $piece; ?>/4.3<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.4']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 4); ?>" href="/project/<?php echo $piece; ?>/4.4<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.5']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 5); ?>" href="/project/<?php echo $piece; ?>/4.5<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.6']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 6); ?>" href="/project/<?php echo $piece; ?>/4.6<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.7']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 7); ?>" href="/project/<?php echo $piece; ?>/4.7<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.8']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 8); ?>" href="/project/<?php echo $piece; ?>/4.8<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.9']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 9); ?>" href="/project/<?php echo $piece; ?>/4.9<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="<?php echo $slideMenu['4.10']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 10); ?>" href="/project/<?php echo $piece; ?>/4.10<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">4. Find a partner:</span>
        <span class="percentage"><?php echo (($currs[0] == 4 ? $currs[1] : ( $currs[0] > 4 ? count($slideindex[4]) : 0 ))  . '/' . count($slideindex[4])); ?></span>
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
