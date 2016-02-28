<section id="main" class="container" style="margin-top:55px;">

    <?php if (isset($error) && $error) : ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (isset($successMessage) && $successMessage) : ?>
        <div class="alert alert-success">
            <?php echo $successMessage; ?>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header" style="border-bottom: 0; ">
                <h1 style="text-align:center;">Contact us</h1>
            </div>
        </div>
    </div>

    <div class="jumbotron" style="padding:0px; background-color:rgba(0, 0, 0, 0); border:0;">
        <p style="text-align:center;">
            Please fill the form below and solve the captcha if you have inquiries about the site or otherwise.
        </p>
    </div>

    <?php if (!isset($successMessage)) : ?>

        <form method="POST">

            <div class="g-recaptcha" data-sitekey="6LcFghkTAAAAAOvNSMyulu0Icfc0IAq3ST47IV4X" style="margin: 0 auto;  width: 304px;"></div>

            <br />
            <br />

            <div class="row">
                <div class="col-lg-12" >
                    <div class="well bs-component center-block" style="width:50%; padding-bottom:0px; background-color:rgba(0, 0, 0, 0.3);">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="email_address" class="col-lg-1 control-label">Email</label>
                                <div class="col-lg-11">
                                    <input id="email_address" name="email_address" value="<?php echo $emailAddress; ?>" class="form-control" placeholder="You will be contacted at this address" type="text" autofocus maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message" class="col-lg-1 control-label">Message:</label>
                                <div class="col-lg-12">
                                    <textarea id="message" name="message" class="form-control" rows="3" placeholder="Your personalized message" maxlength="2000"><?php echo $message; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-default pull-right">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </form>

    <div class="text-center" style="margin-top:40px; font-size:140%;">
        Click <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>">here</a> to protect another email address!
    </div>

</section>

