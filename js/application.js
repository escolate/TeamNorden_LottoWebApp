$(document).ready(function(){ // Ready function start
    
    // Check/uncheck all checkboxes in a .list
    var checkboxAll = $('.list tfoot >tr>td> input:checkbox');
    var checked = false;
    checkboxAll.click(function(){
	var index = checkboxAll.index(this);
	if(!checked){
	    $('.list:eq('+index+') input:checkbox').prop('checked',true);
	    checked = true;
	}else if(checked){
	    $('.list:eq('+index+') input:checkbox').prop('checked',false);
	    checked = false;
	}
    });
    
    $("#logoutlink").on('click',function () {
        $(this).parent('form').submit();
    });
    
    $('#noscript img').on('click',function () {
        $('#noscript').slideUp().promise($(this).remove());
    });
    
    //Location to PLZ
    $("#zip").on("blur", function() {
        var val = $(this).val();
        if (!val == '' && $('#place').val() == '') {
            $.get("/api.php?action=zip&zip="+ val, function(data) {
                $("#place").val(data);
            });
        }
    });
    
    //Validate forms
    $('#userdata').on('submit',function (e) {
        if($('#password1').val() != $('#password2').val()) {
            e.preventDefault();
            alert('Die eingegebenen Passworte stimmen nicht überein!');
            $('#password1').val('');
            $('#password2').val('');
            $('#password1').focus();
        }
    });
    
    $("table").tablesorter(); 
    
    $('form.filter select').on('change',function () {
        $('form.filter').submit();
    });

});// Ready function end