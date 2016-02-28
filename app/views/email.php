<section id="main" class="container" style="margin-top:55px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header" style="border-bottom: 0; ">
                <h1 style="text-align:center;">The following email address was protected by hidemyemail.co: </h1>
            </div>
        </div>
    </div>

    <div id="emailAddressBox" style="<?php if (!$captchaSuccess) echo 'display:none;'; ?>">
        <p class="text-center" style="font-size:180%;">
            <a id="addressLink" href="<?php if ($captchaSuccess) echo 'http://' . $email['address']; ?>" style="text-decoration: underline;" target="_blank"><?php if ($captchaSuccess) echo $email['address']; ?></a>
            <span class="badge"><?php echo $email['views']; ?></span>
        </p>

        <div class="text-center">
            <input class="btn btn-default copy-clipboard" data-copy="<?php echo $email['address']; ?>" type="button" value="Copy to clipboard"/>
        </div>
    </div>

    <?php if (!$captchaSuccess) : ?>

        <div class="text-center">
            <input id="showAddress" class="btn btn-default" data-address="<?php echo $email['address']; ?>" type="button" value="View email address"/>
        </div>

    <?php endif; ?>

    <div class="text-center" style="margin-top:40px; font-size:140%;">
        Click <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>">here</a> to protect your own email address from spammers!
    </div>

</section>