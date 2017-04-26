

function check_register_form() {
    if ($("#register #tourist:checked").length > 0) {
        $(".container").removeClass("user-form");
        $(".container").removeClass("firm-form");
        $(".container").addClass("user-form");
    }
    if ($("#register #tourfirm:checked").length > 0) {
        $(".container").removeClass("user-form");
        $(".container").removeClass("firm-form");
        $(".container").addClass("firm-form");
    }
}

jQuery(document).ready(function($) {
  if ($(window).width() <= 850) {
      $(".office-container .menu.expanded").toggleClass("expanded");
    }
  $(window).resize(function() {
    update_content_size();
    if ($(window).width() <= 850) {
      $(".office-container .menu.expanded").toggleClass("expanded");
    }
  });
  $(window).load(function() {
    setTimeout(function() {
      $('#preloader').fadeOut('slow', function() {});
  }, 1000);

  });
  $(".orders_form_trigger").on("click", function(e) {
    e.preventDefault();
    $(this).closest("li").toggleClass("expanded");
  });
  $(".burger-trigger").on("click", function() {
      $(this).toggleClass("open");
      $("header nav").slideToggle();
  });
  $(".extended_serch_trigger").on("click", function(e) {
    e.preventDefault();
    $(this).closest(".extended").toggleClass("active");
  });
  $(".about-tabs-head div").on("click", function() {
  	var $self = $(this);
  	 if (!$(this).hasClass("active")) {
  	 	$(".about-tabs-head .active").removeClass("active");
 		var tabname = $self.attr("id");
  	 	$(this).addClass("active");
  	 	$(".tab").fadeOut(function() {
	  	 	if (tabname == "tourist")
	  	 	{
	  	 		$("#tourist-tab").fadeIn();
	  	 	}
	  	 	else
	  	 	{
	  	 		$("#agency-tab").fadeIn();
	  	 	}
  	 	});
  	 }


  });
  $("#register .button-line input").change(function() {
      check_register_form();
  });
  check_register_form();

  function triggerModal(name){
    $('body').css('overflow', 'hidden');
    $(name).easyModal({
      top: 60,
      autoOpen: true,
      overlayOpacity: 0.3,
      overlayColor: "#000",
      overlayClose: true,
      closeOnEscape: true,
      onClose: function(){
        $('body').css('overflow', 'auto');
      }
    });
  };
    $('.login').click(function(e){
      e.preventDefault();
      $('.w_popup').trigger('closeModal');
      triggerModal('.login_popup');
    });
    
    $('.feedback-popup-open').click(function(e){
      e.preventDefault();
      $('.w_popup').trigger('closeModal');
      triggerModal('.feedback_popup');
    });
    
    $('.report-trigger').click(function(e){
      e.preventDefault();
      $('.w_popup').trigger('closeModal');
      triggerModal('.report_popup');
    });
    $('.info-trigger').click(function(e){
      e.preventDefault();
      $('.w_popup').trigger('closeModal');
      triggerModal('.info_popup');
    });
    $('.order-trigger').click(function(e){
      e.preventDefault();
      $('.w_popup').trigger('closeModal');
      triggerModal('.order_popup');
    });
    $('.popup_close').click(function(){
      $(this).closest('.w_popup').trigger('closeModal');
    });
    $("#toggle-menu").on("click", function(e) {
        e.preventDefault();
        $(this).parent().toggleClass("expanded");
        setTimeout(function() {
            update_content_size();
        }, 200);
    });
    update_content_size();
    
//    $(document).on("select2-open", "select", function () {
//        var el;
//        $('.select2-results').each(function () {
//           var api = $(this).data('jsp');
//           
//            if (api !== undefined) api.destroy();
//        });
//
//        $('.select2-results').each(function () {
//            if ($(this).parent().css("display") != 'none') el = $(this);
//
//            if (el === undefined) return;
//
//            el.mCustomScrollbar({
//                mouseWheel:true,
//                advanced:{
//                    updateOnContentResize: true
//                }
//              });
//        });
//    });

function addScrollToSelect()
{
    $(document).ready(function () {
        try {
            $('.select2-results .select2-results__options').mCustomScrollbar('destroy');
            $('.select2-results .select2-results__options').mCustomScrollbar('update');
            setTimeout(function() {
                $('.select2-results .select2-results__options').mCustomScrollbar({
                    axis: 'y',
                    scrollbarPosition: 'inside',
                    advanced:{
                        updateOnContentResize: true
                    },
                    live: true
                });
            }, 0);
        } catch (e) {

        }
    });
}
$('select').on('select2:open', function () {
    //addScrollToSelect();
});

	
});

function update_content_size() {
  var window_width = $(window).width();
  if (window_width < 1668) {
    var padding_needed = 334 - ((window_width - 1040) / 2);
    if (window_width < 1040) {
      if ($(".office-container .menu.expanded").length) {
        $(".office-container .wrapper").css("padding-left", "334px");
         
      } else {
        $(".office-container .wrapper").css("padding-left", "80px");
      }
    } else if (window_width > 1160) {
      if ($(".office-container .menu.expanded").length) {
        $(".office-container .wrapper").css("padding-left", "" + padding_needed + "px");
         
      } else {
        $(".office-container .wrapper").css("padding-left", "20px");
      }
    } else {
      if ($(".office-container .menu.expanded").length) {
        $(".office-container .wrapper").css("padding-left", "" + padding_needed + "px");
         
      } else {
        $(".office-container .wrapper").css("padding-left", "" + (padding_needed - 314 + 60) + "px");
      }
    }
  }
}

$(function() {
    $("select").dropdown();
});

// tabs
$('ul.tabs-menu').delegate('li:not(.active)', 'click', function() {
    $(this).addClass('active').siblings().removeClass('active')
        .parents('.tabs-wrapper').find('.tabs-item').hide().eq($(this).index()).fadeIn(150);
    return false;
});