//$('.btn-funtional').click(function(){
//  $('.industrial').removeClass('active');
//  $('.functional').addClass('active');
//  $('.btn-industrial').removeClass('active');
//  $(this).addClass('active');
//});
//$('.btn-industrial').click(function(){
//  $('.industrial').addClass('active');
//  $('.functional').removeClass('active');
//  $('.btn-funtional').removeClass('active');
//  $(this).addClass('active');
//});
//
//$(document).on("click",".more-cat",function(){
//  $(this).removeClass('active');
//  $('.category-list.active .category-col-2, .category-list.active .category-col-3').addClass('active');
//  $('.less-cat').addClass('active');
//});
//
//$(document).on("click",".less-cat",function(){
//  $(this).removeClass('active');
//  $('.category-list.active .category-col-2, .category-list.active .category-col-3').removeClass('active');
//  $('.more-cat').addClass('active');
//});
$(document).on("click",'.btn-funtional',function(){
  $('.industrial').removeClass('active');
  $('.functional').addClass('active');
  $('.btn-industrial').removeClass('active');
  $(this).addClass('active');
  $('.tab').removeClass('ind-tab');
  $('.tab').addClass('fun-tab');
  $('.fun-cat').addClass('active');
  $('.ind-cat').removeClass('active');
});
$(document).on("click",'.btn-industrial',function(){
  $('.industrial').addClass('active');
  $('.functional').removeClass('active');
  $('.btn-funtional').removeClass('active');
  $(this).addClass('active');
  $('.tab').removeClass('fun-tab');
  $('.tab').addClass('ind-tab');
  $('.fun-cat').removeClass('active');
  $('.ind-cat').addClass('active');
});
$(document).on("click",".fun-cat .more-cat",function(){
  $(this).removeClass('active');
  $('.category-list.active .category-col-2, .category-list.active .category-col-3').addClass('active');
  $('.fun-cat .less-cat').addClass('active');
});

$(document).on("click",".fun-cat .less-cat",function(){
  $(this).removeClass('active');
  $('.category-list.active .category-col-2, .category-list.active .category-col-3').removeClass('active');
  $('.fun-cat .more-cat').addClass('active');
});

$(document).on("click",".ind-cat .more-cat",function(){
  $(this).removeClass('active');
  $('.category-list.active .category-col-2, .category-list.active .category-col-3').addClass('active');
  $('.ind-cat .less-cat').addClass('active');
});

$(document).on("click",".ind-cat .less-cat",function(){
  $(this).removeClass('active');
  $('.category-list.active .category-col-2, .category-list.active .category-col-3').removeClass('active');
  $('.ind-cat .more-cat').addClass('active');
});
// Scroll to top
// ===== Scroll to Top ==== 
$(document).ready(function(){
      $('body').append('<div id="toTop" class="btn btn-info"><span class="fa fa-angle-up"></span></div>');
      $(window).scroll(function () {
      if ($(this).scrollTop() != 0) {
        $('#toTop').fadeIn();
      } else {
        $('#toTop').fadeOut();
      }
    }); 
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});

$(document).on('mouseenter','.c-card', function (event) {
  if(this.getElementsByClassName('allHotJobs').length>0){
    $(this).parent().css("height",($(this).parent().outerHeight())+"px");
    $(this).find('.allHotJobs').addClass('zoom');
    $(this).find('.allJobs').addClass('active');
    $(this).find('i').removeClass('icon-sort-down');
    $(this).find('i').addClass('icon-sort-up');
}
}).on('mouseleave','.c-card', function(event){
  if(this.getElementsByClassName('allHotJobs').length>0){
    $(this).parent().css("height","auto");
    $(this).find('.allHotJobs').removeClass('zoom');
    $(this).find('.allJobs').removeClass('active');
    $(this).find('i').removeClass('icon-sort-up');
    $(this).find('i').addClass('icon-sort-down');
}
});

$('.in-partners').click(function(){
  $('.all-partners').slideToggle();
  $(this).find('i').toggleClass('icon-plus icon-minus')
});
$('.dropdown.notification-icon').click(function(){
  $('.badge.bubble').toggleClass('hidden');
  $('.badge.bubble').toggleClass('blueLink');
});
$('a.btn-login').click(function(){
  $('.login-form').slideToggle();
});

$(document).mouseup(function (e)
{
    var container = $(".login-form, .navbar-user");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $('.login-form').fadeOut(100);
    }
});

enquire.register("screen and (max-width: 768px)", {
  match : function() { 
          $('.user-details').appendTo('.user-details-mobile ul');
          $('.offset-mobile').insertAfter('.notification-desktop');
          $('.quick-links').appendTo('.mobile-quick-links');
          $('.navbar-nav').appendTo('.offset-menu .wrapper');
          $('.notification-icon').appendTo('.notification-mobile ul');
  },
  unmatch : function() {
          $('.user-details').appendTo('.user-details-desktop ul');
          $('.offset-mobile').appendTo('.navbar-user ul');
          $('.quick-links').insertAfter('.division');
          $('.navbar-nav').appendTo('.navbar-menu');
          $('.notification-icon').appendTo('.notification-desktop ul');
  }
});

$('.navbar-toggle').click(function(){
  $('.offset-menu .wrapper').animate({
          right: '0px'
      });
  $('.offset-menu').fadeIn(100);
});

$('.btn-close, .offset-menu .transparent').click(function(){
  $('.offset-menu .wrapper').animate({
          right: '-280px'
      });
  $('.offset-menu').fadeOut(200);
});

//$(".tab-btn .btn-group > .btn").click(function(){
//    $(".tab-btn .btn-group > .btn").removeClass("active");
//    $(this).addClass("active");
//});

//$('.btn-funtional').click(function(){
//  $('.category-list').show();
//  $('.category-list.industrial').hide();
//});
//$('.btn-industrial').click(function(){
//  $('.category-list').hide();
//  $('.category-list.industrial').show();
//});

// Toggle button for login login-form
$(document).on("click",".login-form .btn-group .btn",function(){
  $(".login-form .btn-group .btn").removeClass("active");
  $(this).addClass("active");
});

$(document).on("click",".login-form .btn.corporate",function(){
  $(".login-form .login-jobseeker").hide();
  $(".login-form .login-corporate").show();
});

$(document).on("click",".login-form .btn.mybdjobs",function(){
  $(".login-form .login-corporate").hide();
  $(".login-form .login-jobseeker").show();
});

$(document).on('click','.categoryCombo select',function(){
  $(this).addClass('active');
});

$(document).ready(function(){  
   function searchPanelBackImage() {
          if ($(window).width() > 991) {
              $(".searchPanelContainer").css("background-image", $(".searchPanelContainer").attr("image"));
          }
          else{
              $('.searchPanelContainer').css('background-image', 'none');
          } 
      }
      searchPanelBackImage();
      $(window).on("resize", function() {
          searchPanelBackImage();
      });  
});
