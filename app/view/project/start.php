
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $title; ?></h2>
            <p>Start by naming your project. This will make it easier for you to keep track of it.</p>
            
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