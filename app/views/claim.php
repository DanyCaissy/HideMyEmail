<section id="main" class="container" style="margin-top:55px;">

    <?php if (isset($successMessage) && $successMessage) : ?>
        <div class="alert alert-success">
            <?php echo $successMessage; ?>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (isset($errorMessage) && $errorMessage) : ?>
        <div class="alert alert-danger">
            <?php echo $errorMessage; ?>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header" style="border-bottom: 0; ">
                <h1 style="text-align:center;">Claim your link!</h1>
            </div>
        </div>
    </div>

    <div class="jumbotron" style="padding:30px; background-color:transparent; border:0;">
        <p>
            This page lets you gain access to your custom link used to manage your email address on hidemyemail.co.
            We do this by sending an email to the address in question with the details to access the page.
            If you don't have access to the email address, you cannot claim the link as your own.
        </p>
    </div>


    <form method="POST" class="form-horizontal">

        <div class="g-recaptcha" data-sitekey="6LcFghkTAAAAAOvNSMyulu0Icfc0IAq3ST47IV4X" style="margin: 0 auto;  width: 304px;"></div>

        <br />
        <br />

        <div class="row">
            <div class="col-lg-12">
                <div class="well bs-component center-block" style="width:50%; padding-bottom:0px; background-color:rgba(0, 0, 0, 0.3);">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-1 control-label">Email</label>
                            <div class="col-lg-9">
                                <input id="inputEmail" value="<?php echo $emailAddress; ?>" name="email" class="form-control" placeholder="Enter the email address to claim" type="text" autofocus maxlength="255">
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-default pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <div class="text-center" style="margin-top:40px; font-size:140%;">
        Click <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>">here</a> to protect another email address!
    </div>

</section>