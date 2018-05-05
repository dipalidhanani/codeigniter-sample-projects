// JavaScript Document

$(function(){
	
	//equalheight jquery start
	equalHeight($(".breakout ul li p"));
	equalHeight($(".something-new ul li p"));
	equalHeight($(".home-blog ul li"));
	equalHeight($(".recent-blogs ul li"));
	equalHeight($(".inner-left ul.blog-list li"));
	
	
	//navigation jquery start
	var widthVal = $(window).width();
	if(widthVal < 850){
		$('.item-with-ul a').click(function(){
			//alert("vfhvsfh");
			var checkClass = $(this).hasClass('opensubmenu');
			var urlVal = $(this).attr('href');
			if(checkClass == true){
				window.location = urlVal;
			}else{
				//alert('ss')
				$(this).parent('li').children('.touch-button').addClass('active');
				$(this).parent('li').children('ul').addClass('flexnav-show').css('display','block');
				$(this).addClass('opensubmenu');
			}
			return false;
		});
		
		$('.touch-button').click(function(){
			//alert('ss')
			//var classStatus = $(this).parent('item-with-ul').find('a').hasClass('opensubmenu');
			var classStatus = $(this).parent('.item-with-ul').find('a').hasClass('opensubmenu');
			if(classStatus == true){
				$(this).parent('.item-with-ul').find('a').removeClass('opensubmenu');
			}
		})
	}
	
		
	//form jquery start	
	$('form input[type=text],form input[type=email], form textarea').each(function(){
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
		
	});	
	
	
	//link jquery start
	$('.scroll-but').click(function(){
		$('html, body').animate({
			scrollTop: $( $.attr(this, 'href') ).offset().top
		}, 1000);
		return false;
	});
	
	
	//background jquery start
	$(window).scroll(function() {
		var makeItResponsive  = $('#inner-banner').height();
		var widowTop = $(window).scrollTop();
		$('#countVal').html(widowTop);
			$('.inner-banner').css('background-position', 'center '+parseInt(-widowTop / 5.5)+'px');
	});
	
	
	$(window).scroll(function() {
		var makeItResponsive  = $('#about-trynew').height();
		var widowTop = $(window).scrollTop();
		$('#countVal').html(widowTop);
			$('.about-try-new').css('background-position', 'center '+parseInt(-widowTop / 5.5)+'px');
	});
	
	
	$(window).scroll(function() {
		var makeItResponsive  = $('#special-event').height();
		var widowTop = $(window).scrollTop();
		$('#countVal').html(widowTop);
			$('.special-event').css('background-position', 'center '+parseInt(-widowTop / 20.5)+'px');
	});
	
	
	$(window).scroll(function() {
		var makeItResponsive  = $('#theme-block-2').height();
		var widowTop = $(window).scrollTop();
		$('#countVal').html(widowTop);
			$('.theme-block-2').css('background-position', 'center '+parseInt(-widowTop / 5.5)+'px');
	});
	
	
	$(window).scroll(function() {
		var makeItResponsive  = $('#theme-block-4').height();
		var widowTop = $(window).scrollTop();
		$('#countVal').html(widowTop);
			$('.theme-block-4').css('background-position', 'center '+parseInt(-widowTop / 5.5)+'px');
	});
	
	
	$(window).scroll(function() {
		var makeItResponsive  = $('#something-new').height();
		var widowTop = $(window).scrollTop();
		$('#countVal').html(widowTop);
			$('.something-new').css('background-position', 'center '+parseInt(-widowTop / 5.5)+'px');
	});
	
	
	$(window).scroll(function() {
		var makeItResponsive  = $('#home-contact').height();
		var widowTop = $(window).scrollTop();
		$('#countVal').html(widowTop);
			$('.home-contact').css('background-position', 'center '+parseInt(-widowTop / 7)+'px');
	});
	
	
	//accordian jquery start
	$('.faq-list li a').attr('href','javascript:void(0)');
		
	$('.faq-list li a').click(function(){
		//alert("ss");
			var cheClass = $(this).parent('li').children('div.faq-cont').hasClass('activeWidth');
			var cheClassA = $(this).addClass('active');
			 $('.faq-list li').children('div.faq-cont').slideUp();
			 $('.faq-list li').children('div.faq-cont').removeClass('activeWidth');
			  $('.faq-list li').children('a').removeClass('active');
			
			  if(cheClass == false){
			   $(this).parent('li').children('div.faq-cont').slideDown()
			    $(this).parent('li').children('div.faq-cont').addClass('activeWidth');
				$(this).addClass('active');
			  }else{
			   $(this).parent('li').children('div.faq-cont').slideUp();
			   $(this).parent('li').children('div.faq-cont').removeClass('activeWidth');
			   $(this).removeClass('active');
			}
	});
					 
	
});


$(window).resize(function() {
			 
	$(".breakout ul li p, .something-new ul li p, .home-blog ul li, .recent-blogs ul li, .inner-left ul.blog-list li").css('height','auto');
			 
	equalHeight($(".breakout ul li p"));
	equalHeight($(".something-new ul li p"));
	equalHeight($(".home-blog ul li"));
	equalHeight($(".recent-blogs ul li"));
	equalHeight($(".inner-left ul.blog-list li"));
		
		
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