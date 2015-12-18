<div class="container">
    
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <h1 class="text-center">Tool Selection Assistant</h1>
            <h3 class="text-center">Password Recovery</h3>
            <p>Please input your email. Instructions to reset your password will be sent to the email account you've used to register. </p>
            <?php if(isset($response)) { printResponse($response); } ?>
            
            <form class="" method="post" action="/user/recover">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                
                
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-main" name="submit" id="submit"><i class="fa fa-send"></i> Send Instructions</button>
                </div>
                
                
            </form>
            
        </div>
        
    </div>
</div>