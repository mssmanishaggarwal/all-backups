function init() {
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 150,
                header = document.querySelector(".top-header, .secondary-top-header");
            if (distanceY > shrinkOn) {
                classie.add(header,"smaller");
            } else {
                if (classie.has(header,"smaller")) {
                    classie.remove(header,"smaller");
                }
            }
        });
    }
window.onload = init();

jQuery(document).ready(function($){
	$('.news-container').each(function(){	
	if($(this).find('.newsimage').length==0){
		$(this).find('.newsdetail').css('width','100%');
	}
	});
});


$(document).ready(function(){
  $('#currency ,#userlogin, #dash-selector').niceSelect(); 
	$('.bxslider').bxSlider();
	$(window).responsinav({ breakpoint: 650 }); 
	
	
	$(".newsletter-subsc input").focus(function(){
		$(".newsletter-subsc").addClass("focusinput");								
	});
	$(".newsletter-subsc input").blur(function(){
		$(".newsletter-subsc").removeClass("focusinput");								
	});
	
	$(window).resize(function () {			
		if($(window).width() <= 500){
			$("#bookbysearch").click(function(){
				$("#searchbook").slideToggle("fast");							  
			});			   
		}
		});
	  
});


/*jQuery(document).ready(function($) {
	$("#search_checkin").bootstrapDatepickr({date_format: "d/m/Y"});
	$("#search_checkout").bootstrapDatepickr({date_format: "d/m/Y"});
});*/


jQuery(document).ready(function($) {
  var si = $('#gallery-1').royalSlider({
    addActiveClass: true,
    arrowsNav: false,
    controlNavigation: 'none',
    autoScaleSlider: true, 
    //autoScaleSliderWidth: 960,     
    //autoScaleSliderHeight: 340,
    loop: true,
    fadeinLoadedSlide: false,
    globalCaption: true,
    keyboardNavEnabled: true,
    globalCaptionInside: false,

    visibleNearby: {
      enabled: true,
      centerArea: 0.5,
      center: true,
      breakpoint: 650,
      breakpointCenterArea: 0.64,
      navigateByCenterClick: true
    }
  }).data('royalSlider');

  // link to fifth slide from slider description.
  $('.slide4link').click(function(e) {
    si.goTo(4);
    return false;
  });
});

jQuery(document).ready(function() {
	jQuery('.post').addClass("novisible").viewportChecker({
	    classToAdd: 'visible animated bounceInLeft', // Class to add to the elements when they are visible
	    offset: 100    
	   });   
});    
jQuery(document).ready(function() {
	jQuery('.post1').addClass("novisible").viewportChecker({
	    classToAdd: 'visible animated bounceInUp', // Class to add to the elements when they are visible
	    offset: 100    
	   });   
});

function setCookie(cname, cvalue, exdays) {	
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}


/*function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=.example.com";
}

createCookie('cookieee','stuff','22');*/

function setLanguage(langid)
{
	$.ajax({
	  url: baseUrl+"/setlanguage",
	  type: "post",
	  data:{langid:langid}
	}).done(function(res){
		location.reload();	
	});
}

function setCurrency(currency_id)
{	
	$.ajax({
	  url: baseUrl+"/setcurrency",
	  type: "post",
	  data:{currency_id:currency_id}
	}).done(function(res){
		location.reload();	
	});
}

function getHalltype(){
	 $.ajax({
	  url: baseUrl+"/gethalltype",
	  type: "GET",
	  contentType: "application/json",
	  accept: "application/json",
	  success: function(result) {
	     for(var key in result){ 
	     	$('#search_halltype').append('<option value="'+result[key].id+'">'+result[key].hall_type_name+'</option>');
	     }
	 }
	}).done(function(){
		$('#search_halltype').niceSelect();
		$('#search_halltype').hide(); 
	});
}

function getPricerange(){
	 $.ajax({
	  url: baseUrl+"/getpricerange",
	  type: "GET",
	  contentType: "application/json",
	  accept: "application/json",
	  success: function(result) {
	     for(var key in result){ 
	     	$('#search_pricerange').append('<option value="'+result[key].id+'">'+result[key].lower_range+' - '+result[key].upper_range+'</option>');
	     }
	 }
	}).done(function(){
		$('#search_pricerange').niceSelect();
		$('#search_pricerange').hide(); 
	});
}

function setFavorite(hall_id)
{
	$.ajax({
	  url: baseUrl+"/setfavorite",
	  type: "POST",
	  data:{hall_id:hall_id},
	  dataType: 'html',
	  success: function(result) {
	    if(result > 0)	    
			$('#success-modal .modal-body').html('This Hall has been set as your favorite!');
		else
			$('#success-modal .modal-body').html('This Hall already set as your favorite!');
			
		    $('#success-modal').modal({ backdrop: 'static', keyboard: false })
		    	.on('click', '#confirm_ok', function () {
	            location.reload();
	        });
		
	 }
	});
}

function sortHallListing(order_by)
{
	
	$.ajax({
	  url: baseUrl+"/search",
	  type: "POST",
	  data : $('#searchbook').serialize() + "&order_by="+order_by,
	  dataType: 'json',
	  success: function(result) {	  
	    $('.listingrow').html(result.posts);
	 }
	});
}

function setReview()
{
	$('.review-loader').show();
	$('.review-loader').prev('input:submit').prop('disabled', true);
	var review_text = $('#review_text').val();
	var review_rating = $('input[name=rating]:checked').val();
	var hall_id = $('#hall_id').val();
	$.ajax({
	  url: baseUrl+"/setreview",
	  type: "POST",
	  data:{hall_id:hall_id,
	  		review_text:review_text,
	  		review_rating:review_rating  			  		
	  		},
	  dataType: 'html',
	  success: function(result) {
	    if(result > 0)
	    {	
	    	$('.review-loader').hide();
	    	$('.review-loader').prev('input:submit').prop('disabled', false);
	    	$('#review_text').val('');
	    	$('#review-id .close').click();
			$('#success-modal .modal-body').html('Your review has been posted!');
		    $('#success-modal').modal({ backdrop: 'static', keyboard: false })
		    	.on('click', '#confirm_ok', function () {
	            location.reload();
	        });
		}
	 }
	});
}

function setEnquiry()
{
		   $('.enquiry-loader').show();
		   $('.enquiry-loader').prev('input:submit').prop('disabled', true);
           var values = {};
            $.each($('#form-enquiry').serializeArray(), function(i, field) {
                  values[field.name] = field.value;
            });

            $.ajax({
              url:baseUrl+"/setenquiry",
              type: "POST",
              data: values,
              success: function(result) {
		        if(result > 0)
			    {	
			    	$('.enquiry-loader').hide();
			    	$('.enquiry-loader').prev('input:submit').prop('disabled', false);
			    	$('#form-enquiry').find('#message').val('');
			    	$('#enquiry-id .close').click();
					$('#success-modal .modal-body').html('Your enquiry has been posted!');
				    $('#success-modal').modal({ backdrop: 'static', keyboard: false })
				    	.on('click', '#confirm_ok', function () {
			            //location.reload();
			        });
				}
           }
       })
     
}

function getAvailability(clickFrom)
{
	$('#availability-loader').show();
	$('#check_button').prop('disabled', true);
	$('#book_button').prop('disabled', true);	
	var checkin_date = $('#checkin_date').val();
	var checkout_date = $('#checkout_date').val();
	var hall_id = $('#hall_id').val();
	$.ajax({
	  url: baseUrl+"/getavailability",
	  type: "POST",
	  data:{hall_id:hall_id,
	  		checkin_date:checkin_date,
	  		checkout_date:checkout_date  			  		
	  		},
	  dataType: 'html',
	  success: function(result) {
	  	$('#availability-loader').hide();
	  	$('#check_button').prop('disabled', false);
	  	$('#book_button').prop('disabled', false);
	  	if(result == 0)
	  	{	  		
			$('.hall-check-result').html('<span class="hallavailable">Your hall is available</span>');	
			if(clickFrom == 'book')
			{
				if(authVal == 0)
				$('#book_login_open').click()
				else
				$("#bookFrm").submit();
			}
					
		}	  	
	  	else
	  	{	  		
			$('.hall-check-result').html('<span class="hallnotavailable">Your hall is not available</span>');	
		}	  	
	}
	}); 	
}

function setNewsletter()
{	
	$('#newsletterFrm').validate({
		errorPlacement: function(){
        return false;
    		},
   submitHandler:function(){
   		$('.newletter-loader').show();
   		$('.newletter-loader').prev(':submit').prop('disabled', true);
   		var newsletter_email = $('#newsletter_email').val();
   		$.ajax({
		  url: baseUrl+"/setnewsletter",
		  type: "POST",
		  data:{newsletter_email:newsletter_email},		  
		  success: function(result) {
		  	$('.newletter-loader').hide();
		  	$('.newletter-loader').prev(':submit').prop('disabled', false);		  	
		    if(result > 0)
		    {	
		    	$('#newsletter_email').val('');	    	
				$('#newsletter_msg').html('<span class="newsletter-succ">You has been subscribed to newsletter!<span>');			   
			}
			else
			{
				$('#newsletter_msg').html('<span class="newsletter-error">Please try again!</span>');
			}
				
		 }
		}).error(function(re){	
				$('.newletter-loader').hide();		
				$('.newletter-loader').prev(':submit').prop('disabled', false);
                var returnable=$.parseJSON(re.responseText);
                for(var key in returnable){
                 $('#newsletter_msg').html('<span class="newsletter-error">'+returnable[key]+'</span>');
                }
        });
   		
   	},
  });
}

function clickCount(id)
{
	$.ajax({
			type: "POST",
			url: baseUrl+"/setadvclick",
			data: {'advertisement_id':id},
			dataType: 'html',				
			success: function(data){
					
			}
		});
}

jQuery(document).ready(function($){		
		$('.faq-section').each(function(){								
			$(this).find('.question-faq').click(function(e){
					if($(e.target).is('.open')){
						$(this).removeClass('open');
						$(this).next().slideUp(300);
						}
						else{
							$('.question-faq').removeClass('open');
							$(this).next().slideDown(300);
							$(this).addClass('open');
							$('.answer-faq').not($(this).next()).slideUp(300);
							}
				});	
			
			});														
		});


