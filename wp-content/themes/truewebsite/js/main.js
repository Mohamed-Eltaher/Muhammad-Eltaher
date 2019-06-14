$(document).ready(function(){

	$('.navTrigger').click(function () {
        $(this).toggleClass('active');
        console.log("Clicked menu");
        $("#mainListDiv").toggleClass("show_list");
        $("#mainListDiv").fadeIn();

    });

  $('#wpmenucartli').on('click', function() {
    $(this).addClass('active');
  });
	// Function used to shrink nav bar removing paddings and adding black background

	$(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $('.nav').addClass('affix');
            console.log("OK");
            $('.logo a').addClass('expand-nav');
        } else {
            $('.nav').removeClass('affix');
            $('.logo a').removeClass('expand-nav');
        }
    });

    // Live Search
    /*
    $(document).on("keydown", function(e) {
        
        if(e.keyCode == 83) {
            $('.search-form').addClass('visible');
            $('body').addClass('no-scroll');
        }
        if(e.keyCode == 27) {
            $('.search-form').removeClass('visible');
            $('body').removeClass('no-scroll');
        }
    }); */

    $('#search-icon .fa-search').click(function () {
        $('.search-form').addClass('visible');
        $('body').addClass('no-scroll');
        $('.live-search').css('display', 'block');

        $('.fa-times-circle').click(function() {
            $('.search-form').removeClass('visible');
            $('body').removeClass('no-scroll');
            $('.live-search').css('display', 'none');
        });
        
    });

    var clear;
    $('.search-form input').on('keydown', function() {

        //clearTimeout(clear);
        //clear = setTimeout(getResults(), 2000);
        
    });

    /* contact form submission */
    $('#sunsetContactForm').on('submit', function(e){

        e.preventDefault();

        $('.has-error').removeClass('has-error');
        $('.js-show-feedback').removeClass('js-show-feedback');

        var form = $(this),
        name = form.find('#name').val(),
        email = form.find('#email').val(),
        message = form.find('#message').val(),
        ajaxurl = form.data('url');

        if( name === '' ){
            $('#name').parent('.form-group').addClass('has-error');
            return;
        }

        if( email === '' ){
            $('#email').parent('.form-group').addClass('has-error');
            return;
        }

        if( message === '' ){
            $('#message').parent('.form-group').addClass('has-error');
            return;
        }

        form.find('input, button, textarea').attr('disabled','disabled');
        $('.js-form-submission').addClass('js-show-feedback');

        $.ajax({

            url : ajaxurl,
            type : 'post',
            data : {

                name : name,
                email : email,
                message : message,
                action: 'sunset_save_user_contact_form'
                
            },
            error : function( response ){
                $('.js-form-submission').removeClass('js-show-feedback');
                $('.js-form-error').addClass('js-show-feedback');
                form.find('input, button, textarea').removeAttr('disabled');
            },
            success : function( response ){
                if( response == 0 ){

                    setTimeout(function(){
                        $('.js-form-submission').removeClass('js-show-feedback');
                        $('.js-form-error').addClass('js-show-feedback');
                        form.find('input, button, textarea').removeAttr('disabled');
                    },1500);

                } else {

                    setTimeout(function(){
                        $('.js-form-submission').removeClass('js-show-feedback');
                        $('.js-form-success').addClass('js-show-feedback');
                        form.find('input, button, textarea').removeAttr('disabled').val('');
                    },1500);

                }
            }
            
        });

    });

  });




/* Light YouTube Embeds by @Muhammad */

   document.addEventListener("DOMContentLoaded",
       function() {
           var div, n,
               v = document.getElementsByClassName("youtube-player");
           for (n = 0; n < v.length; n++) {
               div = document.createElement("div");
               div.setAttribute("data-id", v[n].dataset.id);
               div.innerHTML = labnolThumb(v[n].dataset.id);
               div.onclick = labnolIframe;
               v[n].appendChild(div);
           }
       });

   function labnolThumb(id) {
       var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
           play = '<div class="play"></div>';
       return thumb.replace("ID", id) + play;
   }

   function labnolIframe() {
       var iframe = document.createElement("iframe");
       var embed = "https://www.youtube.com/embed/ID?autoplay=1";
       iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
       iframe.setAttribute("frameborder", "0");
       iframe.setAttribute("allowfullscreen", "1");
       this.parentNode.replaceChild(iframe, this);
   };


   // function to defer parsing js of youtube embed
   function init() {
     var vidDefer = document.getElementsByTagName('iframe');
     for (var i=0; i<vidDefer.length; i++) {
       if(vidDefer[i].getAttribute('data-src')) {
         vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
     } } }
     window.onload = init;
