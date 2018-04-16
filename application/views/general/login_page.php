<?=br(5)?>
<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
        </div>
        <div class="panel-body">
            <form name="form" method='post' 
                  action='<?= base_url(); ?>publik/proses_login'>
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="username" 
                               name="username" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" 
                               name="password" type="password" value="">
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <a href="javascript:void(0)" onclick="form.submit()" 
                       class="btn btn-lg btn-success btn-block">Login</a>
                </fieldset>
            </form>
        </div>
    </div>
</div>
