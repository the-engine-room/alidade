<div class="container">
    
    <div class="col-md-8 col-md-offset-2">
        <h1 class="h2">Edit Page</h1>
        <form class="" action="/manage/page/<?php echo $page->idpages; ?>" method="post">
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
                <textarea rows="12" name="contents" id="contents" class="form-control" data-provide="markdown" data-iconlibrary="fa"><?php echo $page->contents; ?></textarea>
            </div>
            
            <button class="btn btn-main" type="submit"><i class="fa fa-save"></i> SAVE</button>
            
        </form>
        
    </div>
</div>

