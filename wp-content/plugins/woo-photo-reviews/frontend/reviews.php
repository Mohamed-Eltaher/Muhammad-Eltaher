<?php

/**
 * Class VI_WOO_PHOTO_REVIEWS_Frontend_Reviews
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VI_WOO_PHOTO_REVIEWS_Frontend_Reviews {
	protected $settings;
	protected $comments;

	public function __construct() {
		global $wcpr_detect;
		$this->settings = new VI_WOO_PHOTO_REVIEWS_DATA();
		if ( ! $this->settings || 'on' != $this->settings->get_params( 'enable' ) || 'on' != $this->settings->get_params( 'photo', 'enable' ) ) {
			return;
		}
		if ( $wcpr_detect->isMobile() && ! $wcpr_detect->isTablet() && $this->settings->get_params( 'mobile' ) !== 'on' ) {
			return;
		}
		add_action( 'wp_footer', array( $this, 'quick_view' ) );
	}


	/**
	 * Show HTML quick view in the footer
	 */
	public function quick_view() {
		if ( ! is_product() || ! is_single() ) {
			return;
		}
		if ( $this->settings->get_params( 'photo', 'display' ) != 1 ) {
			return;
		}
		?>
        <div class="wcpr-modal-light-box">
            <div class="wcpr-modal-light-box-wrapper">
                <div class="wcpr-overlay"></div>
                <div id="wcpr-modal-wrap" class="wcpr-modal-wrap">
                    <div id="reviews-content-left" class="modal-content">
                        <div id="reviews-content-left-main"></div>
                        <div id="reviews-content-left-modal"></div>
                    </div>
                    <div id="reviews-content-right" class="wcpr-modal-content">
                        <div class="reviews-content-right-meta"></div>
                    </div>
                    <div class="wcpr-controls">
                        <span class="wcpr-close cursor"></span>
                        <a class="wcpr-prev"></a>
                        <a class="wcpr-next"></a>
                    </div>
                </div>
            </div>
        </div>

		<?php
	}
}
