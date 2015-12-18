<div class="container">
    
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <h1 class="text-center">Tool Selection Assistant</h1>
            <h3 class="text-center">Password Reset</h3>
            <p>Please fill in this form to reset your password.</p>
            <?php if(isset($response)) { printResponse($response); } ?>
            
            <form class="" method="post" action="/user/reset/<?php echo $token; ?>">
                <div class="form-group">
                    <label for="pwd">New Password</label>
                    <input type="password" class="form-control" name="pwd" id="pwd">
                    
                </div>
                <div class="form-group">
                    <label for="cpwd">Confirm Password</label>
                    <input type="password" class="form-control" name="cpwd" id="cpwd">
                </div>
                
                
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-main" name="submit" id="submit"><i class="fa fa-recycle"></i> Reset Password</button>
                </div>
                
                
            </form>
            
        </div>
        
    </div>
</div>