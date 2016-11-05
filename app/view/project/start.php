
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $title; ?></h2>
            <?php if(isset($_GET['reg'])){  ?>
            <div class="alert alert-success">Thank you for registering!</div>
            <?php } ?>
            <p>The Tool Selection Assistant walks you through the process of deciding which technology tool is right for you.</p>
            <p>It doesn't tell you which tool you should use, but supports your own research by asking questions, giving real-life examples and suggesting places to get help.</p>
            <p><b>New here?</b> Start by naming your project below.</p> 
            
            <p><b>Already started a project?</b> Find all your projects <a href="https://toolselect.theengineroom.org/user/projects">here</a>.</p>
        </div>
    </div>
    <div class="row">
        <form action="/project/start" method="post" class="col-md-6">
            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-main"><i class="fa fa-save"></i> SAVE</button>
            </div>
        </form>
        
    </div>
</div>
