<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Edit "<?php echo $slide->title; ?>"</h2>
            <?php print_r( $_POST ); ?>
            <form class="/manage/slide/<?php echo $slide->step . '/' . $slide->position; ?>" method="post" id="slide-form">
                <input id="step" name="step" type="hidden" value="<?php echo $slide->step; ?>">
                <input id="position" name="position" type="hidden" value="<?php echo $slide->position; ?>">
        
                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $slide->title; ?>">
                </div>
                <div class="form-group">
                        <div class="btn-toolbar" data-role="editor-toolbar" data-target="#slide">
                            <div class="btn-group">
                              <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                              <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                              <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                              <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                            </div>
                            <div class="btn-group">
                              <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                              <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                              <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-indent-left"></i></a>
                              <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent-right"></i></a>
                            </div>
                            <div class="btn-group">
                              <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                              <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                              <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                              <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                            </div>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                <div class="dropdown-menu input-append">
                                    <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                                    <button class="btn" type="button">Add</button>
                                </div>
                                <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                            </div>
                            
                            <div class="btn-group">
                              <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                              <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                            </div>
                        </div>
                    
                    
                    <div id="slide" name="description" class="form-control wysiwyg" contenteditable="true"><?php echo $slide->description; ?></div>
                </div>
                <div class="form-group">
                    <button type="submit" id="save-form" data-form="#slide-form" class="btn btn-primary">save</button>
                </div>
            </form>
        </div>
    </div>
    
</div>