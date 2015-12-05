<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>All your projects...</h1>
                <p>Choose a project and click <strong>Continue</strong></p>
                <p><small>or create a <a class="" href="/project/start">new project</a></small></p>
        </div>
    </div>
    
    
    <?php foreach($projects as $p){  ?>
    
    <div class="row project">
    
        <div class="col-md-2 col-sm-12 col-xs-12">
            <?php if(empty($p['title'])){ ?>
            <form class="form-inline ajx project-name" method="get" action="/ajax/save_project_name">
                
                <input name="project" id="project" type="hidden" value="<?php echo $p['idprojects']; ?>">
                
                <div class="form-group">
                    <input name="title" class="form-control input-sm" id="title" placeholder="Add a project name...">
                </div>
                
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-floppy-o"></i> save</button>
                </div>
            </form>
            <?php } else { ?>
            <h4><?php echo $p['title']; ?></h4>
            <?php } ?>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            
            <div class="step-wrap" style="display: inline-block; clear: both;">
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
            </div>
            
             <div class="step">
                <?php
                for($i = 1; $i < count($slideindex[1]) + 1; $i++) {
                    
                    if(in_array('1.' . $i ,  $p['slideindex'], true)){
                        $status = 2;
                    }
                    else {
                        $status = 0;
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-1" style="width: <?php echo round( (100/count($slideindex[1])) , 4); ?>%;">
                    <?php if($status == 2){ ?>
                    <a href="/project/slide/<?php echo '1.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" class="go-back-button"></a>
                    <?php } ?>
                </div>
                <?php    
                }
                ?>
            </div>
            
            <div class="step">
                <?php
                for($i = 1; $i < count($slideindex[2]) + 1; $i++) {
                    if(in_array('2.' . $i ,  $p['slideindex'], true)){
                        $status = 2;
                    }
                    else {
                        $status = 0;
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-2" style="width: <?php echo round( (100/count($slideindex[2])) , 4); ?>%;">
                    <?php if($status == 2){ ?>
                    <a href="/project/slide/<?php echo '2.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" class="go-back-button"></a>
                    <?php } ?>
                </div>
                <?php    
                }
                ?>
            </div>
            <div class="step">
                <?php
                for($i = 1; $i< count($slideindex[3]) + 1; $i++) {
                    
                    if(in_array('3.' . $i ,  $p['slideindex'], true)){
                        $status = 2;
                        
                    }
                    else {
                        $status = 0;
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-3" style="width: <?php echo round( (100/count($slideindex[3])) , 4); ?>%;">
                    <?php if($status == 2){ ?>
                    <a href="/project/slide/<?php echo '3.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" class="go-back-button"></a>
                    <?php } ?>
                </div>
                <?php    
                }
                ?>
            </div>
            <div class="step">
                <?php
                for($i = 1; $i< count($slideindex[4]) + 1; $i++) {
                    
                    if(in_array('4.' . $i ,  $p['slideindex'], true)){
                        $status = 2;
                        
                    }
                    else {
                        $status = 0;
                    }
                    
                ?>    
                <div class="slide-position slide-position-<?php echo $status; ?> step-2" style="width: <?php echo round( (100/count($slideindex[4])) , 4); ?>%;">
                    <?php if($status == 2){ ?>
                    <a href="/project/slide/<?php echo '4.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" class="go-back-button"></a>
                    <?php } ?>
                </div>
                <?php    
                }
                ?>
            </div>
            
            
        </div>
        <?php dbga($p['slideindex']); ?>
        <div class="col-md-1 col-sm-12 col-xs-12">
            <a href="/project/slide/<?php
            if(empty($p['slideindex'])) { echo "1.1"; } else { 
                $i = array_search(end($p['slideindex']), $slideindex['fullIndex'], true);
                echo $slideindex['fullIndex'][$i + 1];  } 
                ?>?p=<?php echo $p['hash']; ?>" class="btn btn-primary"><i class="fa fa-hand-o-right"></i> Continue</a>
        </div>
        
    </div>
    
    
    
    
    <?php /*
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
        </div>
    </div>
    */ ?>
    <?php } ?>
    <!--  
    <div class="row">
        <div class="col-md-12">
                <br /><br />
                <a class="btn btn-primary" href="/project/start"><i class="fa fa-hand-o-right"></i> Start a New Project</a>
                <br /><br />
            
        </div>
    </div>
    -->
</div>