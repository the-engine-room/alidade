<div class="container">
    
    <div class="row">
        <div class="col-md-9">
            <h2>Edit "<?php echo $slide->title; ?>"</h2>

            <form class="/manage/slide/<?php echo $slide->step . '/' . $slide->position; ?>" method="post" id="slide-form">
                <input id="step" name="step" type="hidden" value="<?php echo $slide->step; ?>">
                <input id="position" name="position" type="hidden" value="<?php echo $slide->position; ?>">
        
                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $slide->title; ?>">
                </div>
                <div class="form-group">
                    <textarea rows="25" name="description" id="description" class="form-control" data-provide="markdown" data-iconlibrary="fa"><?php echo $slide->description; ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" id="save-form" data-form="#slide-form" class="btn btn-primary">save</button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <h3>Worth Noting</h3>
            
            <p>Please take care while editing slide content. You might come across strange placeholders, or reference/pointers couples that are used to maintain some of the frontend functionalities. Here are some of them, so you know what's going on. </p>
            
            <ul>
                <li><strong>[--answer--]</strong> This is used as a placeholder for the textarea in the slide contents. </li>
            </ul>
            <a href="/manage" class="btn btn-sm btn-alt pull-right">back to management <i class="fa fa-angle-right"></i></a>
            
        </div>
    </div>
    
</div>