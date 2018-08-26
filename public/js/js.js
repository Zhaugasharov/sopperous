var offsetCount = $('.counts').offset().top;
var h = $(window).height();
var oh = offsetCount - h*0.5;

function counts() {
		
				if (!$('#count1').hasClass('done')) {
					$('#count1').animateNumber(
					  {
						number: 350,
						easing: 'easeInQuad'
					  },
					  2000
					);

					$('#count2').animateNumber(
					  {
						number: 320,
						easing: 'easeInQuad'
					  },
					  2000
					);

					$('#count3').animateNumber(
					  {
						number: 10,
						easing: 'easeInQuad'
					  },
					  2000
					);

					$('#count4').animateNumber(
					  {
						number: 40,
						easing: 'easeInQuad'
					  },
					  2000
					);

					$('#count5').animateNumber(
					  {
						number: 15,
						easing: 'easeInQuad'
					  },
					  2000
					);
					$('#count1').addClass('done');
				} 
	
}

$(function() {
    var pull 		= $('.pull');
    menu 		= $('.head ul');
    menuHeight	= menu.height();
    
       $(pull).on('click', function(e) {
        e.preventDefault();
        $(this).parent().find("ul").slideToggle();
		   $(this).parent().parent().toggleClass('active');
        //$(this).parent().find("ul").toggleClass('active');

    });
    
    
    $(window).resize(function(){
        var w = $(window).width();
        if(w > 320 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    });

    var $menush = $("#siteTop");
    var a = $(".fake");
	
	var service = $('.owl-service').offset().top;
	var about = $('#advantages').offset().top;
	var partners = $('.partners').offset().top;
	
    
    $(window).scroll(function(){
		 var a = document.getElementById('siteTop').offsetHeight;
		 var w = $(window).width();
				if ( $(this).scrollTop() > a && !$menush.hasClass("head") ){
				   $menush.addClass("head slideInDown");
				} else if($(this).scrollTop() <= a && $menush.hasClass("head")) {
				   $menush.removeClass("head slideInDown");
				}
		if ($(this).scrollTop() + h >= offsetCount) {
			counts();
		}
		
		if (w > 1024) {
			if ($(this).scrollTop() > service - h*0.5) {
			$('.owl-service').addClass('fadeInUp active');
			}

			if ($(this).scrollTop() > about - h*0.5) {
				$('.owl-about').addClass('zoomIn active');
			}

			if ($(this).scrollTop() > partners - h*0.5) {
				$('.owl-partners').addClass('zoomIn active');
			}
		} else {
			$('.owl-service').addClass('fadeInUp active');
			$('.owl-about').addClass('zoomIn active');
			$('.owl-partners').addClass('zoomIn active');
		}
    });
});

$(document).ready(function(){
	if (h >= offsetCount+57) {
		counts();
	}
	
	$('.first-block .container h1').addClass('fadeInLeft');
	$('.first-block .container h2').addClass('fadeInRight');
    
     $('a[href^="#"]').click(function(){
         if (!$(this).hasClass('fancybox')) {
             
         var qwe = 45;
        var el = $(this).attr('href');
         if ($(window).width() < 1051 && $(this).hasClass('scroll')) {
             $('.pull').parent().find("ul").slideToggle();
			 $('.pull').parent().parent().removeClass('active');
			 qwe = 50;
         }
         
        $('body,html').stop().animate({
            scrollTop: $(el).offset().top-qwe}, 1000);
        return false; 
        }
     });
    
	    
    $('.owl-counts').owlCarousel({
        loop:false,
        dots: true,
        navText: ['',''],
        margin:0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
			495:{
                items:2,
                nav:true
            },
			730:{
                items:3,
                nav:true
            },
			980:{
                items:4,
                nav:true
            },
			1200:{
                items:5,
                nav:true
            }
        }
    }); 
	
	    
    $('.owl-service').owlCarousel({
        loop:false,
        dots: true,
        navText: ['',''],
        margin:0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
			480:{
                items:2,
                nav:true
            },
			680:{
                items:3,
                nav:true
            }
        }
    }); 
	    
    $('.owl-about').owlCarousel({
        loop:false,
        dots: true,
        navText: ['',''],
        margin:0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
			550:{
                items:2,
                nav:true
            },
			880:{
                items:3,
                nav:true
            }
        }
    }); 
	    
    $('.owl-partners').owlCarousel({
        loop:true,
        dots: true,
        navText: ['',''],
        margin:0,
		autoplay: true,
		autoplaySpeed: 500,
		autoplayTimeout:5000,
		autoplayHoverPause: false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true,
				slideBy: 1
            },
			500:{
                items:2,
                nav:true,
				slideBy: 2
            },
			800:{
                items:3,
                nav:true,
				slideBy: 3
            },
			1000:{
                items:4,
                nav:true,
				slideBy: 4
            }
        }
    }); 
	 
	    
    $('.owl-team').owlCarousel({
        loop:false,
        dots: true,
        navText: ['',''],
        margin:0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
			500:{
                items:2,
                nav:true
            },
			830:{
                items:3,
                nav:true
            },
			1100:{
                items:4,
                nav:true
            }
        }
    }); 
	 
	    
    $('.owl-reviews').owlCarousel({
        loop:false,
        dots: true,
        navText: ['',''],
        margin:0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
			400:{
                items:2,
                nav:true
            },
			550:{
                items:3,
                nav:true
            },
			730:{
                items:4,
                nav:true
            },
			900:{
                items:5,
                nav:true
            }
        }
    }); 
	
	 
  
   

    $("[data-fancybox]").fancybox({
      
    });
  
    function treeprobel (chislo) {
        var number=chislo;
        var output='';
        number+=''; // преобразуем число в строковую переменную
        var start=number.length%3; //количество цифр не входящих в триаду
        output+=number.substr(0,start); //вставляем их сначала
        var add= (output==0)? '' : ' '; //если число кратно 3, то не нужен первый пробел
        for (var i=start;i<number.length-2;i+=3)
        {
            output+=add+number.substr(i,3);
            add=' ';
        }
        return output;
    }

    
    $('form').submit(function() {
		var form = $(this);
        AjaxFormRequest(form, form, 'action.php');
        return false;
    });

    jQuery(document).ajaxStart(function(){
        $('.loading').show();
    });
    jQuery(document).ajaxStop(function(){
        $('.loading').hide();
    });

});
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
function AjaxFormRequest(result_id,form_id,url) {
	var values = jQuery(form_id).serializeArray();
	values.push({
	  name: "action_text",
	  value: action_text
	});
	values = jQuery.param(values)
    jQuery.ajax({
        url:     url, //Адрес подгружаемой страницы
        type:     "POST", //Тип запроса
        dataType: "html", //Тип данных
        data: values,
        success: function(response) { //Если все нормально
            $(result_id).html(response);
			gtag('event', 'zayavka', { 'event_category': 'zayavka' });
            yaCounter48640295.reachGoal('zayavka'); return true;		
        },
        error: function(response) { //Если ошибка
            $(result_id).html(response);
        }
    });
}