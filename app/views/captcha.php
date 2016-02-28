<section id="main" class="container" style="margin-top:55px;">

    <?php if (isset($captchaInvalid) && $captchaInvalid) : ?>
        <div class="alert alert-danger">
            You have failed the captcha test, please try again!
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header" style="border-bottom: 0; ">
                <h1 style="text-align:center;">Please prove you are a human</h1>
            </div>
        </div>
    </div>

    <form method="POST" >

        <div class="text-center">
            <div class="g-recaptcha" data-sitekey="6LcFghkTAAAAAOvNSMyulu0Icfc0IAq3ST47IV4X" style="margin: 0 auto;  width: 304px;"></div>

            <br />
            <br />

            <input class="btn btn-default" type="submit" value="View email address" />
        </div>

    </form>

</section>