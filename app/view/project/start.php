
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $title; ?></h2>
            <?php if(isset($_GET['reg'])){  ?>
            <div class="alert alert-success">Thank you for registering!</div>
            <?php } ?>
            <p>The Tool Selection Assistant walks you through the process of making an informed decision about what technology to use in a project.</p>
            <p>You can skim through it, take whichever parts you find useful, and return to it at any time - even months later.</p>
            <p>It doesn't tell you which tool you should to use, but supports your own research and planning by asking questions, giving real-life examples and suggesting places to get help.</p>
            <p>Registering lets you save your progress and create multiple projects. Start by naming the project here</p>
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