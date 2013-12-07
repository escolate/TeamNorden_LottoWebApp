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

});// Ready function end