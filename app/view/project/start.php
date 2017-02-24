
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $title; ?></h2>
            <?php if(isset($_GET['reg'])){  ?>
            <div class="alert alert-success">Thank you for registering!</div>
            <?php } ?>
            <p>Alidade helps you create a plan for choosing technology that suits your project.</p>
            
            <p><b>New here?</b> Start by naming your project below.</p> 
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
