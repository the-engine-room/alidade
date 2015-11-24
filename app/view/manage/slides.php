<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>All Slides</h2>
            <table class="table table-responsive table-condensed">
                <thead>
                    <tr>
                        <th>Step</th>
                        <th>Slide</th>
                        <th>Title</th>
                        <th>...</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    foreach($slides as $slide){ 
                    ?>
                <tr>
                    <td><?php echo $slide->step; ?></td>
                    <td><?php echo $slide->position; ?></td>
                    <td><?php echo $slide->title; ?></td>
                    <td><a href="/manage/slide/<?php echo $slide->step; ?>/<?php echo $slide->position; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>    
                    <?php } ?>
                </tbody>
                
            </table>
            
            
            
        </div>
    </div>
    
</div>