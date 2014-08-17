function isFlashInstalled()
{
    if (navigator.plugins != null && navigator.plugins.length > 0){
        return navigator.plugins["Shockwave Flash"] && true;
    }
    if(~navigator.userAgent.toLowerCase().indexOf("webtv")){
        return true;
    }
    if(~navigator.appVersion.indexOf("MSIE") && !~navigator.userAgent.indexOf("Opera")){
        try{
            return new ActiveXObject("ShockwaveFlash.ShockwaveFlash") && true;
        } catch(e){}
    }
    return false;
}

function checkAlphaNum(event)
{
    if ( event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39  )
    {
        return true;
    }

    var alphaNumCheck = /[a-z0-9_-]/;
    return alphaNumCheck.test(String.fromCharCode(event.which));
}

$( document ).ready(function()
{
    if (!isFlashInstalled())
    {
        $('.copy-clipboard').hide();
    }

    // ============================== INDEX ==============================

    $("#specifyAlias").click(function()
    {
        $("#specifyAlias").hide();
        $("#aliasTab").show();
        $("#inputAlias").focus();
    });

    // ============================== EMAIL ==============================

    $("#showAddress").click(function()
    {
        var address = $("#showAddress").data('address');

        $("#showAddress").hide();
        $("#emailAddressBox").show();

        $("#addressLink").prop("href", 'mailto:' + address);
        $("#addressLink").text(address);

        $(".copy-clipboard").on('click', function (e) {
            e.preventDefault();
        }).each(function () {
            $(this).zclip({
                path: 'http://www.steamdev.com/zclip/js/ZeroClipboard.swf',
                copy: function () {
                    return $(this).data('copy');
                }
            });
        });
    });

    // ============================== MANAGE ==============================

    $(".copy-clipboard").on('click', function (e) {
        e.preventDefault();
    }).each(function () {
        $(this).zclip({
            path: 'http://www.steamdev.com/zclip/js/ZeroClipboard.swf',
            copy: function () {
                return $(this).data('copy');
            }
        });
    });

    function submitManageForm()
    {
        $("#formManage").submit();
    }

    $("#modifyAlias").click(function()
    {
        $("#alias").val(1);
        submitManageForm();
    });

    $("#buttonDeactivateCaptcha").click(function()
    {
        $("#captcha").val(0);
        submitManageForm();
    });

    $("#buttonActivateCaptcha").click(function()
    {
        $("#captcha").val(1);
        submitManageForm();
    });

    $("#buttonDeactivateURL").click(function()
    {
        $("#disabled").val(1);
        submitManageForm();
    });

    $("#buttonActivateURL").click(function()
    {
        $("#disabled").val(0);
        submitManageForm();
    });

    $("#buttonEmail").click(function()
    {
        $("#email").val(1);
        submitManageForm();
    });



});