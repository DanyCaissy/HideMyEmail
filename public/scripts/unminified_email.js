

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


    });

    // ============================== MANAGE ==============================



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