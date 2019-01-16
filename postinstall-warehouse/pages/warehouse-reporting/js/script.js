//
$(document).ready(function(){
	$('#wrapper').css('height' , $(window).height());
	
	n = $('.hasDatepicker').length;
    var date_id;
    var i;
    for (i=0; i<n; i++){
        date_id = $('.hasDatepicker').eq(i).attr('id');
        kamaDatepicker(date_id);
    }

});