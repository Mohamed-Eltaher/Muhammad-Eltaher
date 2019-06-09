jQuery(document).ready(function () {
    jQuery('#commentform').attr('enctype','multipart/form-data');
    let max_files = woocommerce_photo_reviews_params.max_files;
    jQuery("input[type='submit']").on('click', function () {
        if (jQuery('input[name="wcpr_gdpr_checkbox"]').prop('checked') === false) {
            alert(woocommerce_photo_reviews_params.warning_gdpr);
            return false;
        }

        let fileUpload = jQuery("#wcpr_image_upload");
        if (fileUpload.length > 0) {
            if (parseInt(fileUpload.get(0).files.length) > max_files) {
                alert(woocommerce_photo_reviews_params.warning_max_files);
                return false;
            }
        }
    });
});
