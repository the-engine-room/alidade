<?php
if(!isset($page) || $page !== 'start') {
$currs = explode('.', $currentSlide);
?>
<?php
$piece = ($inTour ? 'tour' : 'slide');
?>


    <div class="step step1 <?php echo ($currs[0] == 1 ? '' : 'hidden-xs'); ?>">
		<header>
			<h3>STEP 1</h3>
		</header>
		<ul>
			<?php for($i = 1; $i < 12; $i++){ ?>
			<li>
				<a
				   title="<?php echo $slideMenu['1.' . $i]; ?>"
				   class="slide <?php echo checkSlidePosition($step_number, $slide_number, 1, $i); ?>"
				   href="/project/<?php echo $piece; ?>/1.<?php echo $i; ?><?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"
				>
					<?php echo $slideMenu['1.' . $i]; ?>
				</a>
			</li>
			<?php } ?>
		</ul>
    </div>
    <div class="step step2 <?php echo ($currs[0] == 2 ? '' : 'hidden-xs'); ?>">
        <header>
			<h3>STEP 2</h3>
		</header>
		<ul>
			<?php for($i = 1; $i < 8; $i++){ ?>
			<li>
				<a
				   title="<?php echo $slideMenu['2.' . $i]; ?>"
				   class="slide <?php echo checkSlidePosition($step_number, $slide_number, 2, $i); ?>"
				   href="/project/<?php echo $piece; ?>/2.<?php echo $i; ?><?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"
				>
					<?php echo $slideMenu['2.' . $i]; ?>
				</a>
			</li>
			<?php } ?>
		</ul>
    </div>
    <div class="step step3 <?php echo ($currs[0] == 3 ? '' : 'hidden-xs'); ?>">
		<header>
			<h3>STEP 3</h3>
		</header>
		<ul>
			<?php for($i = 1; $i < 8; $i++){ ?>
			<li>
				<a
				   title="<?php echo $slideMenu['3.' . $i]; ?>"
				   class="slide <?php echo checkSlidePosition($step_number, $slide_number, 3, $i); ?>"
				   href="/project/<?php echo $piece; ?>/3.<?php echo $i; ?><?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"
				>
					<?php echo $slideMenu['3.' . $i]; ?>
				</a>
			</li>
			<?php } ?>
		</ul>
    </div>
<?php /* 
    <div class="step step4 <?php echo ($currs[0] == 4 ? '' : 'hidden-xs'); ?>">
        <div class="slides hidden-xs">
            <?php ?>
            <ul>
                <li><a title="<?php echo $slideMenu['4.1']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 1); ?>" href="/project/<?php echo $piece; ?>/4.1<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.2']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 2); ?>" href="/project/<?php echo $piece; ?>/4.2<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.3']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 3); ?>" href="/project/<?php echo $piece; ?>/4.3<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.4']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 4); ?>" href="/project/<?php echo $piece; ?>/4.4<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.5']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 5); ?>" href="/project/<?php echo $piece; ?>/4.5<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.6']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 6); ?>" href="/project/<?php echo $piece; ?>/4.6<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.7']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 7); ?>" href="/project/<?php echo $piece; ?>/4.7<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.8']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 8); ?>" href="/project/<?php echo $piece; ?>/4.8<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.9']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 9); ?>" href="/project/<?php echo $piece; ?>/4.9<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
                <li><a title="<?php echo $slideMenu['4.10']; ?>" class="slide <?php echo checkSlidePosition($step_number, $slide_number, 4, 10); ?>" href="/project/<?php echo $piece; ?>/4.10<?php echo (!is_null($hash) ? '/?p=' . $hash : ''); ?>&edit"><span class="sr-only">slide name</span></a></li>
            </ul>
        </div>
        <span class="title">4. Find a partner:</span>
        <span class="percentage"><?php echo (($currs[0] == 4 ? $currs[1] : ( $currs[0] > 4 ? count($slideindex[4]) : 0 ))  . '/' . count($slideindex[4])); ?></span>
    </div>
*/ ?>












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
