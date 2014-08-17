<section id="main" class="container" style="margin-top:55px; ">

    <?php if (isset($emailInvalid) && $emailInvalid) : ?>
        <div class="alert alert-danger">
            Please enter a valid email address!
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>
    <?php if (isset($aliasInvalid) && $aliasInvalid) : ?>
        <div class="alert alert-danger">
            The alias you've selected is already taken, please choose another one!
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>
    <?php if (isset($emailAlreadyExists) && $emailAlreadyExists) : ?>
        <div class="alert alert-danger">
            This email address already has a link associated to it with the following alias : <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/e/<?php echo $emailRecord['alias']; ?>"><?php echo $emailRecord['alias']; ?></a> <br/>
            If this is your email address, you can claim the link <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/claim/<?php echo $emailRecord['alias']; ?>">here</a>.
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header" style="border-bottom: 0; ">
                <h1 style="text-align:center;">Protect your email address</h1>
            </div>
        </div>
    </div>

    <div class="jumbotron" style="padding:30px; background-color:transparent; border:0;">
        <p style="text-align: center;">
            <?php if ($data['isMobile']) : ?>
                Enter your email address to let us minify it and protect it from bots and spammers.
            <?php else: ?>

                Convert your email address into a <span style="color:white;">safer, minified URL</span> that you can share anywhere you want (Email, Facebook, Forums, Twitter etc.)

                <br />
                <br />

                Now that bots account for most of the traffic on the internet
                (<span style="text-decoration: underline; color:#4186a6 !important;"><a target="_blank" style="text-decoration: underline; color:#4186a6 !important;" href="http://www.incapsula.com/blog/bot-traffic-report-2013.html">Incapsula</a></span>,
                <span style="text-decoration: underline; color:#4186a6 !important;"><a target="_blank" style="text-decoration: underline; color:#4186a6 !important;" href="http://www.bbc.com/news/technology-25346235">BBC</a></span>)
                keeping your email address safe is a <span style="color:white;">priority</span>.
                Our free tool provides you with a new URL that you can share anywhere, it will protect your address by adding an extra step that bots will fail.

            <?php endif; ?>
        </p>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="well bs-component center-block" style="width:<?php echo $width; ?>%; margin-top:0px; padding-bottom:0px; background-color:rgba(30, 30, 30, 0.5);">
                <form method="POST" class="form-horizontal">
                    <div class="form-group <?php echo $emailInputError; ?>">
                        <label for="inputEmail" class="col-lg-1 control-label">Email</label>
                        <div class="col-lg-11">
                            <input id="inputEmail" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter the email address to minify" type="text" autofocus maxlength="255">
                        </div>
                    </div>

                    <div class="form-group <?php echo $aliasInputError; ?>" id="aliasTab" <?php if (!$alias) : ?> style="display:none;" <?php endif; ?>>
                        <label for="inputAlias" class="col-lg-3 control-label">hidemyemail.co/e/</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="alias" value="<?php echo $alias; ?>" id="inputAlias" placeholder="Specify a custom alias" type="text" maxlength="32" onkeypress="return checkAlphaNum(event);">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-7">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="bot_protection" <?php if ($botProtection) echo "checked"; ?> value="1"> Captcha protection (recommended)
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <button type="submit" class="btn btn-default pull-right">Submit</button>
                            <?php if (!$alias) : ?>
                                <button type="button" class="btn btn-default pull-right" id="specifyAlias">Custom Alias</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>

            </div>

            <div id="socialMedia" class="center-block" style="width:50%; overflow: hidden;">
                <div style="float:right;" class="fb-like" data-layout="button_count" data-action="like" data-show-faces="true" data-width="50px;" data-href="http://hidemyemail.co" ></div>
                <div style="float:right;" class="g-plusone" data-size="medium" data-width="300"></div>
            </div>

            <script>
                $( document ).ready(function()
                {
                    setTimeout(function()
                    {
                        $("#socialMedia").delay(80000).css('overflow','visible');
                    }, 2000);
                });
            </script>


        </div>

    </div>



</section>