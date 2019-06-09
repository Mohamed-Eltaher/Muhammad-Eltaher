jQuery(document).ready(function () {
    var current = -1;
    var slides;
    if (jQuery('.wcpr-grid-item')) {
        slides = jQuery('.wcpr-grid-item');
    }
    jQuery('.wcpr-controls').find('.wcpr-close').on('click', function () {
        jQuery('html').removeClass('wcpr-html');
        jQuery('.wcpr-modal-light-box').fadeOut(200);
        current = -1;

    });
    jQuery('.wcpr-modal-light-box .wcpr-overlay').on('click', function () {
        jQuery('html').removeClass('wcpr-html');
        jQuery('.wcpr-modal-light-box').fadeOut(200);
        current = -1;
    });

    function showReview(n) {
        current = n;
        if (n >= slides.length) {
            current = 0
        }

        if (n < 0) {
            current = slides.length - 1
        }

        jQuery('#reviews-content-left-modal').html('');
        jQuery('#reviews-content-left-main').html('');
        if (jQuery('.wcpr-grid').find('.wcpr-grid-item').eq(current).find('.reviews-images-container').length == 0) {
            jQuery('#reviews-content-left').addClass('wcpr-no-images');

        } else {
            jQuery('#reviews-content-left-modal').html((jQuery('.wcpr-grid').find('.wcpr-grid-item').eq(current).find('.reviews-images-wrap-left').html()));
            var img_data = jQuery('.wcpr-grid').find('.wcpr-grid-item').eq(current).find('.reviews-images-wrap-right').html();
            if (img_data) {
                jQuery('#reviews-content-left').removeClass('wcpr-no-images');
                jQuery('#reviews-content-left-main').html(img_data);
            }

            jQuery('#reviews-content-left-modal').find('.reviews-images').parent().on('click', function () {
                jQuery('#reviews-content-left-main').find('.reviews-images').attr('src', jQuery(this).attr('href'));
                return false;
            });
        }
        jQuery('#reviews-content-right .reviews-content-right-meta').html(jQuery('.wcpr-grid').find('.wcpr-grid-item').eq(current).find('.review-content-container').html());
        jQuery('.wcpr-modal-light-box').fadeIn(200);
        jQuery('html').addClass('wcpr-html');

    }

    jQuery(document).keydown(function (e) {
        if (e.keyCode == 27) {
            jQuery('html').removeClass('wcpr-html');
            jQuery('.wcpr-modal-light-box').fadeOut(200);
            current = -1;

        }
        if (current != -1) {
            if (e.keyCode == 37) {
                showReview(current -= 1);
            }

            if (e.keyCode == 39) {
                showReview(current += 1);
            }
        }
    });

    jQuery('body').on('click','.wcpr-grid-item', function () {
        slides = jQuery('.wcpr-grid-item');
        let i=0;
        for (i = 0; i < slides.length; i++) {
            if ((jQuery(this).html()) == jQuery('.wcpr-grid').find('.wcpr-grid-item').eq(i).html()) {
                break;
            }
        }
        showReview(i);
    });
    jQuery('body').on('click','.wcpr-next', function () {
        showReview(current += 1);
    });
    jQuery('body').on('click','.wcpr-prev', function () {
        showReview(current -= 1);
    });

});
