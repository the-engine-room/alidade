<div class="container userpage">
    <div class="row">
        <div class="col-md-6">
            <h1>Update &amp; manage my projects</h1>
        </div>
        <div class="col-md-4 col-md-offset-2 help">
            <p>Choose a project and click <strong>Continue</strong></p>
            <p>Click on a slide button to change or amend an answer</p>
            <p><small>or create a <a class="" href="/project/start">new project</a></small></p>
            
        </div>
    </div>
    
    <?php foreach($projects as $p){  ?>
    
    <div class="row project">
    
        <div class="col-md-6 col-sm-12 col-xs-12">
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
            <h3><?php echo $p['title']; ?> | <?php echo round( (count($p['index']) / (count($slideindex['fullIndex']) - 1)) * 100); ?>% complete</h3>
            <?php } ?>
           
        </div>
        
       
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="walking-steps">
                
                <div class="step step1">
                    
                    <div class="slides">
                        <ul>
                    
                            <?php
                            for($i = 1; $i < count($slideindex[1]) + 1; $i++) {
                                
                                if(in_array('1.' . $i ,  $p['slideindex'], true)){
                                    $status = 2;
                                }
                                else {
                                    $status = 0;
                                }
                                
                            ?>    
                            <li>
                                <a 
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?php echo $slideMenu['1.' . $i]; ?>" 
                                href="/project/slide/<?php echo '1.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" 
                                class="slide <?php echo ($status == 2 ? 'done' : '' ) ;?>" ></a> 
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <span class="title">1. Understand Your Needs</span>
                    
                </div>
                
                
                
                <div class="step step2">                   
                    <div class="slides">
                        <ul>
                        <?php
                        for($i = 1; $i < count($slideindex[2]) + 1; $i++) {
                            if(in_array('2.' . $i ,  $p['slideindex'], true)){
                                $status = 2;
                            }
                            else {
                                $status = 0;
                            }
                            
                        ?>    
                            <li>
                                <a 
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?php echo $slideMenu['2.' . $i]; ?>" 
                                href="/project/slide/<?php echo '2.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" 
                                class="slide <?php echo ($status == 2 ? 'done' : '' ) ;?>" ></a> 
                                
                            </li>                     
                        <?php    
                        }
                        ?>
                        </ul>
                        
                    </div>
                    <span class="title">2. Understand The Technology</span>
                </div>
                
                
                <div class="step step3">                   
                    <div class="slides">
                        <ul>
                        <?php
                        for($i = 1; $i < count($slideindex[3]) + 1; $i++) {
                            if(in_array('3.' . $i ,  $p['slideindex'], true)){
                                $status = 2;
                            }
                            else {
                                $status = 0;
                            }
                            
                        ?>    
                            <li>
                                <a 
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?php echo $slideMenu['3.' . $i]; ?>" 
                                href="/project/slide/<?php echo '3.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" 
                                class="slide <?php echo ($status == 2 ? 'done' : '' ) ;?>" ></a> 
                                
                            </li>                        
                        <?php    
                        }
                        ?>
                        </ul>
                    </div>
                    <span class="title">3. Try it out</span>
                </div>    
                    
                    
                
                <div class="step step4">                   
                    <div class="slides">
                        <ul>
                        <?php
                        for($i = 1; $i < count($slideindex[4]) + 1; $i++) {
                            if(in_array('4.' . $i ,  $p['slideindex'], true)){
                                $status = 2;
                            }
                            else {
                                $status = 0;
                            }
                            
                        ?>    
                            <li>
                                <a 
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?php echo $slideMenu['4.' . $i]; ?>" 
                                href="/project/slide/<?php echo '4.' . $i . '?p=' . $p['hash'] . '&edit'; ?>" 
                                class="slide <?php echo ($status == 2 ? 'done' : '' ) ;?>" ></a> 
                                
                            </li>                     
                        <?php    
                        }
                        ?>
                        </ul>
                        
                    </div>
                    <span class="title">4. Find a partner</span>
                </div>
                
            
            </div>
        </div>
        
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="/project/slide/<?php
            if(empty($p['slideindex'])) { echo "1.1"; } else { 
                $i = array_search(end($p['slideindex']), $slideindex['fullIndex'], true);
                echo $slideindex['fullIndex'][$i + 1];  } 
                ?>?p=<?php echo $p['hash']; ?>" class="btn btn-main pull-right"><i class="fa fa-hand-o-right"></i> Continue</a>
        </div>
    </div>
    <?php } ?>
</div>

