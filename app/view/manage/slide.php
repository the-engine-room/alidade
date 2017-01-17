<div class="container">
    
    <div class="row">
        <div class="col-md-9">
            <h1>Edit "<?php echo $slide->title; ?>"</h1>

            <form class="/manage/slide/<?php echo $slide->step . '/' . $slide->position; ?>" method="post" id="slide-form">
                <input id="step" name="step" type="hidden" value="<?php echo $slide->step; ?>">
                <input id="position" name="position" type="hidden" value="<?php echo $slide->position; ?>">
        
                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $slide->title; ?>">
                </div>
                <div class="form-group">
                    <div class="textarea form-control" name="description" id="description"><?php echo $slide->description; ?></div>
                    <?php /* <textarea rows="25" name="description" id="description" class="form-control" data-provide="markdown" data-iconlibrary="fa"><?php echo $slide->description; ?></textarea> */ ?>
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
                <li><strong>[--answer--]</strong><br />This is used as a placeholder for the textarea in the slide contents. </li>
                <li><strong>[--prev|step.slide--]</strong><br />This will print a box with the answer from the slide you select with a link to edit that answer. An example can be: [--prev|1.4--]. This would print a box with the answer from slide number 4 of step 1. </li>
                <li><strong>[--start-sidebar--]</strong><br />All content <em><strong>below</strong></em> this placeholder will be placed in the right sidebar.</li>
                <li>
                    <strong>[--box|type--]content[--endbox--]</strong><br />You can create boxes that can go pretty much everywhere you want. Supported values for <em>type</em> are:
                    <ul>
                        <li>questions</li>
                        <li>example</li>
                        <li>casestudy</li>
                        <li>research</li>
                        <li>tips</li>                        
                    </ul>
                </li>
            </ul>
            <a href="/manage" class="btn btn-sm btn-alt pull-right">back to management <i class="fa fa-angle-right"></i></a>
            
        </div>
    </div>
    
</div>