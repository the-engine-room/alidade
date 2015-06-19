<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Tool Selection Assistant</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            STEP 1
        </div>
        <div class="col-md-3">
            STEP 2
        </div>
        <div class="col-md-3">
            STEP 3
        </div>
        <div class="col-md-3">
            STEP 4
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <?php
            for($i = 1; $i<13; $i++) {
            ?>    
            <div class="slide-position slide-position-0" style="width: 8.3333%;"></div>
            <?php    
            }
            ?>
        </div>
        <div class="col-md-3">
            STEP 2
        </div>
        <div class="col-md-3">
            STEP 3
        </div>
        <div class="col-md-3">
            STEP 4
        </div>
    </div>
    
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $step->title; ?></h2>
            <p><?php echo $step->description; ?></p>
            <div class="text-center">
                <a href="/project/slide/1.2" class="btn btn-primary btn-lg">go ahead!</a>
            </div>
        </div>
        
    </div>
</div>