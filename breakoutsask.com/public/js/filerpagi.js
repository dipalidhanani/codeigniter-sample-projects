// JavaScript Document

$('.fancybox').fancybox();
 
function filter(){ 	
		var homesearchStr='';
		var naMe=''; 	
		var cityId = '';
		var provinceId = '';
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if(typeof $('#homesearchstr').val()!='undefined'){
			homesearchStr += '&homesearchstr='+$('#homesearchstr').val();
		}
		
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
	    var data = 'request_type=ajaxdefault';
		if(naMe!='')
		data += naMe;
		
		if(homesearchStr!='')
		data += homesearchStr;		
		
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;
		
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/",
				data: data,
				success: function(responseHtml){
					 $("#defaultDiv").html(responseHtml);  
				},
			});			  
	
	
 }
 
 
function searchByCategory(id){ 
 
		var categoryId=[];	
		categoryId += '&categoryid[]='+id;		
		var data = 'request_type=ajax';	
		if(categoryId.length > 0)
		data += categoryId;
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/",
				data: data,
				success: function(responseHtml){
					 $("#loader").html(responseHtml);
				},
			});			  
	
	
 }
 
 
 
function revpveCrntSearching(li_id,inc){
	
	  	$('#crnt_'+li_id+inc).remove();
	  
	  	var naMe=''; 
	  	var cityId = '';
		var provinceId = '';		
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
		
		var data = 'request_type=ajax';
		
		if(naMe!='')
		data += naMe;	
		
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/",
				data: data,
				success: function(data){
					 $("#loader").html(data);        
					
				},
			});			  
	
			
	}
	
	
	
function filterByAlphabet(alph){
	
		$("#alphabeticalDiv").css('display','block');
		$("#qualificationDiv").html('');
		$("#servicesDiv").html('');
		$("#defaultDiv").html('');
		$("#alphabeticalDiv").html('');
 
		var naMe=''; 
		var cityId = '';
		var provinceId = '';
		
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		 
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
	  	
	    var data = 'request_type=ajaxalphabet'+'&alphabet='+alph;	
		
		if(naMe!='')
		data += naMe;
		
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;
		
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/",
				data: data,
				success: function(responseHtml){
					 $("#alphabeticalDiv").html(responseHtml);  
					 
					 $(".holder").jPages({
            containerID : "itemContainer",
            perPage     : 10,
           /* callback    : function( pages, items ){
                items.showing.find("img").trigger("turnPage");
                items.oncoming.find("img").trigger("turnPage");
                }*/
            }); 
				},
			});			  
	
	
 }
 
 
 
 
 function filterByService(ser){	
 $("#servicesDiv").css('display','block');
		$("#qualificationDiv").html('');
		$("#servicesDiv").html('');
		$("#defaultDiv").html('');
		$("#alphabeticalDiv").html('');
		
 		var naMe=''; 	
 		var cityId = '';
		var provinceId = '';
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
			
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
	  	
		var data = 'request_type=ajaxservice'+'&specialtycategories='+ser;	
		
		if(naMe!='')
		data += naMe;	
			
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;
		
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/",
				data: data,
				success: function(responseHtml){
					 $("#servicesDiv").html(responseHtml);  
					 
					 $(".holder").jPages({
            containerID : "itemContainer",
            perPage     : 10,
           /* callback    : function( pages, items ){
                items.showing.find("img").trigger("turnPage");
                items.oncoming.find("img").trigger("turnPage");
                }*/
            }); 
				},
			});			  
	
	
 }
 
 
 
function filterByQualification(qlf){ 
$("#qualificationDiv").css('display','block');
		$("#qualificationDiv").html('');
		$("#servicesDiv").html('');
		$("#defaultDiv").html('');
		$("#alphabeticalDiv").html('');
		
		var naMe=''; 	
		var cityId = '';
		var provinceId = '';
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
		var data = 'request_type=ajaxqualification'+'&qulificationstr='+qlf;	
		
		if(naMe!='')
		data += naMe;	
			
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;
		
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/",
				data: data,
				success: function(responseHtml){
					$("#qualificationDiv").html(''); 
					 $("#qualificationDiv").html(responseHtml); 
					 
					  $(".holder").jPages({
            containerID : "itemContainer",
            perPage     : 10,
           /* callback    : function( pages, items ){
                items.showing.find("img").trigger("turnPage");
                items.oncoming.find("img").trigger("turnPage");
                }*/
            }); 
			
			
				},
			});		
			
				  
	
	
 }
 
 
 
function defaultpagination(i){
		
		var naMe=''; 
		var cityId = '';
		var provinceId = '';
		
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
	  	
	    var data = 'pagenum='+i;
		
		
		if(naMe!='')
		data += naMe;
			
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;	 
	
		 $.ajax({
				type: "POST",
				async: false,
				url: site_url+"counsellor_directory/searchingDefault/",
				data: data,
				success: function(responseHtml){
					 $("#defaultDiv").html(responseHtml);  
				},
			});		
			
			
			}
			
			
	
function alphabetpagination(i){
		var naMe=''; 
		var cityId = '';
		var provinceId = '';
		
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
	  
		var alphabet=$('#alphabet_hidden').val();
	  	var data = 'pagenum='+i+'&alphabet='+alphabet;
		
		if(naMe!='')
		data += naMe;	
			 	
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;	 
		
	 
		 $.ajax({
				type: "POST",
				async: false,
				url: site_url+"counsellor_directory/searchingAlphabet/",
				data: data,
				success: function(responseHtml){
					 $("#alphabeticalDiv").html(responseHtml);  
				},
			});		
			
			
			}	
			
				
	
function servicepagination(i){
	 	var naMe='';
	  	var cityId = '';
		var provinceId = '';
		
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
			
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}
		
		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
	  	
		var specialtycategories=$('#specialtycategories_hidden').val();
	  	var data = 'pagenum='+i+'&specialtycategories='+specialtycategories;
		
		if(naMe!='')
		data += naMe;
			
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;	 
		 
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/searchingService/",
				data: data,
				success: function(responseHtml){
					 $("#servicesDiv").html(responseHtml);  
				},
			});		
			
			
			}	
			
			
			
function qualificationpagination(i){
	 	var naMe=''; 
	 	var cityId = '';
		var provinceId = '';
		
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if(typeof $('#name2').val()!='undefined'){
			naMe += '&name='+$('#name2').val();
		}

		if(typeof $('#city2').val()!='undefined'){
			cityId += '&city='+$('#city2').val();
		}
		
		if(typeof $('#province2').val()!='undefined'){
			provinceId += '&provinceid='+$('#province2').val();
		}
		
		$('.distress2').each(function(){
			if($(this).val()!='')
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});
		
		$('.clientstype2').each(function(){
			if($(this).val()!='')
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category2').each(function(){
			if($(this).val()!='')
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language2').each(function(){
			if($(this).val()!='')
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype2').each(function(){
			if($(this).val()!='')
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
	  	
		
		var qulification=$('#qulification_hidden').val();
	  	var data = 'pagenum='+i+'&qulificationstr='+qulification;
		
		if(naMe!='')
		data += naMe;	
			
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;	 
		
		 $.ajax({
				type: "POST",
				async: false,
				url:  site_url+"counsellor_directory/searchingQualification/",
				data: data,
				success: function(responseHtml){
					 $("#qualificationDiv").html(responseHtml);  
				},
			});		
			
			
			}	
 

	
function advance_search(){ 
   
   		var cityId = '';
		var provinceId = '';
		var nAme = '';
		var distressId = [];
		var clientstypeId=[];
		var categoryId=[];
		var languageId=[];
		var sessiontypeId=[];
		
		if($('#fn_name').val()!=''){
			nAme += '&name='+$('#fn_name').val();
		}
		if($('#fn_city').val()!=''){
			cityId += '&city='+$('#fn_city').val();
		}
		
		if($('#province').val()!=''){
			provinceId += '&provinceid='+$('#province').val();
		}
		
		$('.distress').each(function(){
			if($(this).is(":checked"))
			{
				distressId += '&distressid[]='+$(this).val();				
			}
		});	
		
		$('.clientstype').each(function(){
			if($(this).is(":checked"))
			{				
				clientstypeId += '&clientstypeid[]='+$(this).val();
				
			}
		});	
		
		$('.category').each(function(){
			if($(this).is(":checked"))
			{				
				categoryId += '&categoryid[]='+$(this).val();
				
			}
		});	
		
		$('.language').each(function(){
			if($(this).is(":checked"))
			{				
				languageId += '&languageid[]='+$(this).val();
				
			}
		});	
		
		$('.sessiontype').each(function(){
			if($(this).is(":checked"))
			{				
				sessiontypeId += '&sessiontypeid[]='+$(this).val();
				
			}
		});	
		
		$.ajaxSetup ({cache: false});	
		var loadurl= site_url+"counsellor_directory/";
		var data = 'request_type=ajax';
		
		if(nAme!='')
		data += nAme;
		
		if(cityId!='')
		data += cityId;
		
		if(provinceId!='')
		data += provinceId;
		
		if(distressId.length > 0)
		data += distressId;
		
		if(clientstypeId.length > 0)
		data += clientstypeId;
		
		if(categoryId.length > 0)
		data += categoryId;
		
		if(languageId.length > 0)
		data += languageId;
		
		if(sessiontypeId.length > 0)
		data += sessiontypeId;
		$.ajax({
			type: "POST",
			url: loadurl,
			dataType:"html",
			data: data,
			success:function(responseData){		
				 jQuery.fancybox.close();
				 $("#loader").html(responseData);        		
			}  
		});	
	}
	
	
	
	
function showHideLi(className){ 	 
	 $('.lidefault').hide();
	 $('.'+className).show();
	 }

			

	
	
 		
 
 
 
	 
	 