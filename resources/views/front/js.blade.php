<!-- jquery library --> 
<script src="{{url('js/1.11.3.jquery.min.js')}}"></script> 
<!-- bootsrap defalt js --> 
<script src="{{url('js/bootstrap.min.js')}}"></script> 
<!-- Responsive tabs js --> 
<script src="{{url('js/ResponsiveTabs.js')}}"></script> 
<!-- owl carousel js --> 
<script src="{{url('js/owl.carousel.js')}}"></script> 	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.js"></script>
<script>
$(document).ready(function() {
$('.banner-to-services').on('click', function(event) {
var target = $( $(this).attr('href') );
	if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 500);
    }
});

//Horizontal Tab
 $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });


 $('.owl-carousel').owlCarousel({
    loop:true,
    margin:30,
    responsiveClass:true,
	autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:true
        },
        1000:{
            items:2,
            nav:true,
            loop:true
        }
    }
}); 

$('.owl-carousel1').owlCarousel({
    loop:true,
    margin:0,
    responsiveClass:true,
	autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:2,
            nav:false
        },
        600:{
            items:4,
            nav:false
        },
        1000:{
            items:6,
            nav:false,
            loop:true
        }
    }
});     
 
 
$(".navbar-toggle").click(function(){
		$(".navbar-collapse").toggleClass('in');
});


	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>