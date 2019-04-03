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
                <h1 style="text-align:center;">Now, instead of sharing your email (<?php echo $email['address']; ?>) directly, you can use the following link:</h1>
            </div>
        </div>
    </div>

    <p class="text-center" style="font-size:180%;">
        <a href="<?php echo $fullEmailURL; ?>" style="text-decoration: underline;"><?php echo $shortEmailURL; ?></a>
    </p>

    <br />

    <div class="row">
        <div class="col-lg-10 center-block" style="float: none; margin: 0 auto;">
            <form id="formManage" method="POST" class="form-horizontal" >

                <input type="hidden" id="captcha" name="captcha" value="<?php echo $email['captcha']; ?>" />
                <input type="hidden" id="disabled" name="disabled" value="<?php echo $email['disabled']; ?>" />
                <input type="hidden" id="email" name="email" value="0" />
                <input type="hidden" id="alias" name="alias" value="0" />

                <div class="col-lg-6">

                    <br />

                    <h3>You can save this link to manage your email:</h3>

                    <label for="inputEmail" class="control-label">Manage your email:</label>
                    <div>
                        <input class="form-control" onclick="this.select();"  value="<?php echo $shortManageURL; ?>" id="inputEmail" type="text" readonly>
                    </div>

                    <br />
                    <br />

                    <label for="inputAlias" class="control-label">Alias:</label>
                    <div>
                        <input class="form-control" value="<?php echo $email['alias']; ?>" id="inputAlias" type="text" name="alias_value" onkeypress="return checkAlphaNum(event);">
                        <input class="btn btn-warning" id="modifyAlias" type="button" value="Modify Alias" style="float:right;" />
                    </div>

                    <br />
                    <br />
                    <br />

                    <?php if ($email['captcha']) : ?>

                        <div style="font-size:120%;">
                            <span class="pull-left" style="margin-top:6px;">Captcha protection is <b>activated</b></span>
                            <button type="button" class="btn btn-danger pull-right" id="buttonDeactivateCaptcha">Deactivate</button>
                        </div>

                    <?php else: ?>

                        <div style="font-size:120%;">
                            <span class="pull-left" style="margin-top:6px;">Captcha protection is <b>deactivated</b></span>
                            <button type="button" class="btn btn-success pull-right" id="buttonActivateCaptcha">Activate</button>
                        </div>

                    <?php endif; ?>

                    <br />
                    <br />
                    <br />

                    <?php if (!$email['disabled']) : ?>

                        <div style="font-size:120%;">
                            <span class="pull-left" style="margin-top:6px;">Your URL is <b>activated</b></span>
                            <button type="button" class="btn btn-danger pull-right" id="buttonDeactivateURL">Deactivate</button>
                        </div>

                    <?php else: ?>

                        <div style="font-size:120%;">
                            <span class="pull-left" style="margin-top:6px;">Your URL is <b>deactivated</b></span>
                            <button type="button" class="btn btn-success pull-right" id="buttonActivateURL">Activate</button>
                        </div>

                    <?php endif; ?>

                    <br />
                    <br />
                    <br />

                    <div style="font-size:120%;">
                        <span class="pull-left" style="margin-top:6px;">Email me my information:</span>
                        <button type="button" class="btn btn-info pull-right" id="buttonEmail">Email</button>
                    </div>

                </div>


                <div class="col-lg-6">

                    <br />

                    <h3>You can also use these links to share your address safely:</h3>

                    <label for="shortLink" class="control-label">For social networks, blog posts or anything else:</label>
                    <div>
                        <input class="form-control" onclick="this.select();"  value="<?php echo $shortEmailURL; ?>" id="shortLink" type="text" readonly>
                    </div>

                    <br /><br />

                    <label for="htmlLink" class="control-label">For HTML links:</label>
                    <div>
                        <input class="form-control" onclick="this.select();"  value='<a href="<?php echo $emailURL; ?>">My email</a>' id="htmlLink" type="text" readonly>
                    </div>

                    <br /><br />

                    <label for="myForumLink" class="control-label">For forums:</label>
                    <div>
                        <input class="form-control" onclick="this.select();"  value="[URL=<?php echo $emailURL; ?>]My email[/URL]" id="myForumLink" type="text" readonly>
                    </div>

                </div>
            </form>
        </div>

    </div>

</section>