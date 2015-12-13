<div class="container">
    
    <div class="col-md-8 col-md-offset-2">
        <h1 class="h2">Edit Page</h1>
        <form class="" action="/manage/page/<?php echo $page->idpages; ?>" method="post" id="page-form">
            <?php
            if(isset($response) && !empty($response)) {
                printResponse($response);     
            }
            ?>
            <input type="hidden" value="<?php echo $page->idpages; ?>" id="page" name="page">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo $page->title; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" name="url" id="url" value="<?php echo $page->url; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="contents">Contents</label>
                <div class="textarea" name="contents" id="contents"><?php echo $page->contents; ?></div>
            </div>
            
            <button class="btn btn-main" type="submit" id="save-page-form"  data-form="#page-form"><i class="fa fa-save"></i> SAVE</button>
            
        </form>
        
    </div>
    <div class="col-md-2">
        <br />
        <a href="/manage" class="btn btn-sm btn-alt pull-right">back to management <i class="fa fa-angle-right"></i></a>
    </div>
</div>

