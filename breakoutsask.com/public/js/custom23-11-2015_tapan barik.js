// JavaScript Document

$(function(){

	
	
	var windowWith =  $( window ).width();
	var docum = $(document).height()-60;
	
	$('.leftDiv').height(docum)	

	
	//form jquery start	
	/*$('form input[type=text],form input[type=email],form input[type=password], form textarea').each(function(){
		var textVal = $(this).val();
		var idVal = $(this).attr('id');
		
		$('#'+idVal).focus(function(){
			if($(this).val() == textVal)
				$(this).val('');
		});
		
		$('#'+idVal).blur(function(){
			if($(this).val() == '')
				$(this).val(textVal);
		});
		
	});	*/
	
	//$('.cat-list li a').attr('href','javascript:void(0)');
		
	$('.cat-list li').click(function(){
		//alert("ss");
			var cheClass = $(this).children('div.cat-cont').hasClass('activeWidth');
			var cheClassA = $(this).children('a').addClass('active');
			 $('.cat-list li').children('div.cat-cont').slideUp();
			 $('.cat-list li').children('div.cat-cont').removeClass('activeWidth');
			  $('.cat-list li').children('a').removeClass('active');
			
			  if(cheClass == false){
			   $(this).children('div.cat-cont').slideDown()
			    $(this).children('div.cat-cont').addClass('activeWidth');
				$(this).children('a').addClass('active');
			  }else{
			   $(this).children('div.cat-cont').slideUp();
			   $(this).children('div.cat-cont').removeClass('activeWidth');
			   $(this).children('a').removeClass('active');
			}
	});
	
	
	
$('.form-rt-align .addemail-btn').click(function(){
	  $('.recipient-pop').slideToggle();
	 });
	
	
	$('.question-add').click(function(){
	  $('.ques-drop').slideToggle();
	 });
	
	
	
});


	
	
function equalHeight(group) {
	
 var tallest = 0;
 group.each(function() {
  var thisHeight = jQuery(this).height();
  if(thisHeight > tallest) {
   tallest = thisHeight;
  }
 });
 group.height(tallest);
}


var onImgLoad = function(selector, callback){
    $(selector).each(function(){
        if (this.complete || /*for IE 10-*/ $(this).height() > 0) {
            callback.apply(this);
        }
        else {
            $(this).on('load', function(){
                callback.apply(this);
            });
        }
    });
};



