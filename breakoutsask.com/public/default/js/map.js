// JavaScript Document

window.onload = function () {

   	var latlng = new google.maps.LatLng(52.134093, -106.665962);

   	var styles = [
		{"featureType":"water","elementType":"geometry","stylers":[
			{"color":"#bfbfbf"},
			{"lightness":0}
			]
		},
		{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f0f0f0"},{"lightness":0}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#929292"},{"lightness":0}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#bfbfbf"},{"lightness":0},{"weight":1}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#bfbfbf"},{"lightness":0}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#bfbfbf"},{"lightness":0}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#e3e3e3"},{"lightness":0}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"color":"#484848"},{"lightness":0}]},{"elementType":"labels.text.fill","stylers":[{"saturation":0},{"color":"#4c4b48"},{"lightness":0}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f0f0f0"},{"lightness":0}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#bfbfbf"},{"lightness":0}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#f0f0f0"},{"lightness":0},{"weight":1.2}]}]


	var isDraggable = $(document).width() > 480 ? true : false; 


   	var myOptions = {
		draggable: isDraggable, 
		zoom: 14,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true,
		styles: styles,
		scrollwheel: isDraggable
   	};
   
   	map = new google.maps.Map(document.getElementById('map'), myOptions);
   
   	var marker = new google.maps.Marker({
		position: latlng,
		icon: 'images/map_icon.png',
		map: map,
		title:"Break Out"
	});
	

}


//$(window).resize(function() {
//	
//	$(document).width() > 480 ? true : false; 
//			 
//	var myOptions = {
//		scrollwheel: false
//   	};
//		
//		
//});


