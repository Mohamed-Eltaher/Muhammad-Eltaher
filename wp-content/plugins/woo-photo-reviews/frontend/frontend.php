<?php

/**
 * Class VI_WOO_PHOTO_REVIEWS_Frontend_Frontend
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VI_WOO_PHOTO_REVIEWS_Frontend_Frontend {
	protected $settings;
	protected $comments;
	protected $new_review_id;
	protected $is_ajax;
	protected $image;
	protected $rating;
	protected $verified;
	protected $characters_array;
	protected $anchor_link;

	public function __construct() {

		$this->settings = new VI_WOO_PHOTO_REVIEWS_DATA();
		global $wcpr_detect;
		$this->anchor_link = '#' . $this->settings->get_params( 'reviews_anchor_link' );
		//mobile detect
		$enable_mobile = true;
		if ( $wcpr_detect->isMobile() && ! $wcpr_detect->isTablet() && $this->settings->get_params( 'mobile' ) !== 'on' ) {
			$enable_mobile = false;
		}
		add_action( 'edit_comment', array( $this, 'coupon_for_not_logged_in' ), 10, 1 );
		add_action( 'wp_set_comment_status', array( $this, 'coupon_for_not_logged_in' ), 10, 1 );
		add_action( 'wpr_schedule_email', array( $this, 'send_schedule_email' ), 10, 7 );
		if ( 'on' == $this->settings->get_params( 'enable' ) ) {
			/*handle review reminder token*/
			add_action( 'wp_ajax_wcpr_ajax_load_more_reviews', array( $this, 'ajax_load_more_reviews' ) );
			add_action( 'wp_ajax_nopriv_wcpr_ajax_load_more_reviews', array( $this, 'ajax_load_more_reviews' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );
			if ( 'off' == $this->settings->get_params( 'coupon', 'require' )['photo'] && 'yes' == get_option( 'woocommerce_enable_coupons' ) && 'on' == $this->settings->get_params( 'coupon', 'enable' ) ) {
				add_action( 'comment_post', array( $this, 'send_coupon_after_reviews' ), 10, 2 );
			}
			add_action( 'comment_form_before', array( $this, 'notify_coupon_sent' ) );
			add_filter( 'wp_list_comments_args', array( $this, 'remove_default_reviews' ) );

			add_action( 'comment_form_top', array( $this, 'add_form_description' ), 20 );

			if ( 'on' == $this->settings->get_params( 'photo', 'enable' ) && $enable_mobile ) {
				//add enctype attribute to form
				add_action( 'comment_form_before', array( $this, 'add_form_enctype_start' ) );
				add_action( 'comment_form_after', array( $this, 'add_form_enctype_end' ) );
				//input#1-add image field
				add_filter(
					'woocommerce_product_review_comment_form_args', array(
					$this,
					'add_comment_field'
				), 10, 1
				);
				//input#2-handle image field
				add_filter( 'preprocess_comment', array( $this, 'check_review_image' ), 10, 1 );
				//output#
				if ( 1 == $this->settings->get_params( 'photo', 'display' ) ) {
					add_action( 'wp_list_comments_args', array( $this, 'photo_reviews' ) );
				} else {
					add_action( 'woocommerce_review_after_comment_text', array( $this, 'wc_reviews' ) );
				}
				add_filter( 'comments_template_query_args', array( $this, 'sort_reviews' ) );
			}
			//filter review button
			if ( 'on' == $this->settings->get_params( 'photo', 'rating_count' ) || 'on' == $this->settings->get_params( 'photo', 'filter' )['enable'] ) {
				add_filter( 'woocommerce_product_tabs', array( $this, 'start_ob' ) );
				add_action( 'wp_footer', array( $this, 'end_ob' ) );
			}
//				add_action( 'wcpr_woocommerce_reviews_top', array( $this, 'reviews_count_html' ) );
			if ( 'on' == $this->settings->get_params( 'photo', 'filter' )['enable'] ) {
				add_action( 'parse_comment_query', array( $this, 'parse_comment_query' ) );
				add_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
			}
			if ( 'on' === $this->settings->get_params( 'followup_email', 'enable' ) ) {
				add_action( 'woocommerce_order_status_completed', array( $this, 'follow_up_email' ) );

			}
		}
	}

	public function remove_default_reviews( $r ) {
		if ( ! $this->settings->get_params( 'pagination_ajax' ) || $this->is_ajax ) {
			return $r;
		}
	}

	public function reduce_image_sizes( $sizes ) {
		foreach ( $sizes as $k => $size ) {
			if ( $size == 'thumbnail' || $size == 'wcpr-photo-reviews' || $size == 'medium' ) {
				continue;
			}
			unset( $sizes[ $k ] );
		}

		return $sizes;
	}

	public function add_form_description() {
		if ( ! is_product() || ! is_single() ) {
			return;
		}
		if ( 'on' == $this->settings->get_params( 'coupon', 'enable' ) ) {
			echo '<div class="wcpr-form-description">' . $this->settings->get_params( 'coupon', 'form_title' ) . '</div>';
		}
	}

	public function parse_comment_query( $vars ) {
		if ( ! $this->is_ajax && ! is_product() ) {
			return;
		}
		global $wcpr_shortcode_count;
		if ( $wcpr_shortcode_count === true ) {
			return;
		}
		if ( $this->is_ajax ) {
			$image    = $this->image;
			$verified = $this->verified;
		} else {
			$image    = isset( $_GET['image'] ) ? isset( $_GET['image'] ) : "";
			$verified = isset( $_GET['verified'] ) ? isset( $_GET['verified'] ) : "";
		}


		if ( $vars->query_vars['meta_query'] ) {
			$vars->query_vars['meta_query']['relation'] = 'AND';
			if ( $image ) {
				$vars->query_vars['meta_query'][] = array(
					'key'     => 'reviews-images',
					'compare' => 'EXISTS'
				);
			}
			if ( $verified ) {
				$vars->query_vars['meta_query'][] = array(
					'key'     => 'verified',
					'value'   => 1,
					'compare' => '='
				);
			}

		} else {
			$custom = array(
				'relation' => 'AND'
			);

			if ( $image ) {
				$custom[] = array(
					'key'     => 'reviews-images',
					'compare' => 'EXISTS'
				);
			}
			if ( $verified ) {
				$custom[] = array(
					'key'     => 'verified',
					'value'   => 1,
					'compare' => '='
				);
			}
			$vars->query_vars['meta_query'] = $custom;

		}
	}

	public function parse_comment_query1( $vars ) {
		if ( ! $this->is_ajax && ! is_product() ) {
			return;
		}
		global $wcpr_shortcode_count;
		if ( $wcpr_shortcode_count === true ) {
			return;
		}
		$rating = 0;
		if ( $this->is_ajax ) {
			$rating = $this->rating;
		} else {
			if ( isset( $_GET['rating'] ) ) {
				switch ( $_GET['rating'] ) {
					case 1:
					case 2:
					case 3:
					case 4:
					case 5:
						$rating = $_GET['rating'];
						break;
					default:
						$rating = 0;
				}
			}
		}

		if ( $rating ) {
			if ( $vars->query_vars['meta_query'] ) {
				$vars->query_vars['meta_query']['relation'] = 'AND';
				$vars->query_vars['meta_query'][]           = array(
					'key'     => 'rating',
					'value'   => $rating,
					'compare' => '='
				);

			} else {
				$custom                         = array(
					'relation' => 'AND'
				);
				$custom[]                       = array(
					'key'     => 'rating',
					'value'   => $rating,
					'compare' => '='
				);
				$vars->query_vars['meta_query'] = $custom;

			}
		}
	}

	public function reviews_count_html() {
		global $product;
		?>
        <div class="wcpr-overall-rating-and-rating-count">

			<?php

			if ( 'on' == $this->settings->get_params( 'photo', 'overall_rating' ) ) {
				?>
                <div class="wcpr-overall-rating">
                    <h2><?php esc_html_e( 'Customer reviews', 'woo-photo-reviews' ) ?></h2>
                    <div class="wcpr-overall-rating-main">
                        <div class="wcpr-overall-rating-left">
                            <span class="wcpr-overall-rating-left-average"><?php echo round( $product->get_average_rating(), 2 ); ?></span>
                        </div>
                        <div class="wcpr-overall-rating-right">
                            <div class="wcpr-overall-rating-right-star"><?php echo wc_get_rating_html( $product->get_average_rating() ); ?></div>
                            <div class="wcpr-overall-rating-right-total"><?php printf( _n( 'Based on %s review', 'Based on %s reviews', $product->get_review_count(), 'woo-photo-reviews' ), $product->get_review_count(), 'woo-photo-reviews' ) ?></div>
                        </div>
                    </div>
                </div>
				<?php
			}

			if ( 'on' == $this->settings->get_params( 'photo', 'rating_count' ) ) {
				remove_action( 'parse_comment_query', array( $this, 'parse_comment_query' ) );
				remove_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
				$agrs   = array(
					'post_id'  => get_post()->ID,
					'count'    => true,
					'meta_key' => 'rating',
					'status'   => 'approve'
				);
				$counts = get_comments( $agrs );
				echo '<div class="wcpr-stars-count">';
				$star_counts = array();
				for ( $i = 1; $i < 6; $i ++ ) {
					$star_counts[ $i ] = $this->stars_count( $i );
				}
				for ( $i = 5; $i > 0; $i -- ) {
					$rate = 0;
					if ( $counts > 0 ) {
						$rate = ( 100 * ( $star_counts[ $i ] / $counts ) );
					}
					echo '<div class="wcpr-row"><div class="wcpr-col-number">' . $i . '</div>';
					echo '<div class="wcpr-col-star">' . wc_get_rating_html( $i ) . '</div>';
					echo '<div class="wcpr-col-process"><div class="rate-percent-bg"><div class="rate-percent"  style="background-color: ' . ( empty( $this->settings->get_params( 'photo', 'rating_count_bar_color' ) ) ? '#96588a' : $this->settings->get_params( 'photo', 'rating_count_bar_color' ) ) . ';height: 100%;width:' . $rate . '%;position: absolute;top:0;left: 0;z-index: 1;border-radius: 3px 0 0 3px;"></div><div style="position: absolute;text-align:center;width: 100%;color: white;z-index: 2;">' . round( $rate ) . ' %</div></div></div>';
					echo '<div class="wcpr-col-rank-count">' . $star_counts[ $i ] . '</div></div>';
				}
				echo '</div>';
				add_action( 'parse_comment_query', array( $this, 'parse_comment_query' ) );
				add_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
			}
			?>
        </div>

		<?php
		if ( 'on' == $this->settings->get_params( 'photo', 'filter' )['enable'] ) {
			$agrs1   = array(
				'post_id'  => get_post()->ID,
				'count'    => true,
				'meta_key' => 'reviews-images',
				'status'   => 'approve'
			);
			$counts1 = get_comments( $agrs1 );

			$agrs2   = array(
				'post_id'    => get_post()->ID,
				'count'      => true,
				'meta_key'   => 'verified',
				'meta_value' => 1,
				'status'     => 'approve'
			);
			$counts2 = get_comments( $agrs2 );
			remove_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
			$agrs3          = array(
				'post_id'  => get_post()->ID,
				'count'    => true,
				'meta_key' => 'rating',
				'status'   => 'approve'
			);
			$counts3        = get_comments( $agrs3 );
			$query_image    = isset( $_GET['image'] ) ? $_GET['image'] : '';
			$query_verified = isset( $_GET['verified'] ) ? $_GET['verified'] : '';
			$query_rating   = isset( $_GET['rating'] ) ? $_GET['rating'] : '';
			echo '<div class="wcpr-filter-container">';
			if ( $this->settings->get_params( 'photo', 'enable' ) == 'on' ) {
				echo '<a class="wcpr-filter-button wcpr-filter-button-images ' . ( $query_image ? 'wcpr-active' : '' ) . '" rel="nofollow" href="' . ( $query_image ? esc_url( remove_query_arg( array( 'image' ), $_SERVER['REQUEST_URI'] ) ) : esc_url( add_query_arg( array( 'image' => true ), remove_query_arg( array( 'page' ), $_SERVER['REQUEST_URI'] ) ) ) ) . $this->anchor_link . '">' . esc_html__( 'With images', 'woo-photo-reviews' ) . '(' . $counts1 . ')</a>';
			}
			echo '<a class="wcpr-filter-button wcpr-filter-button-verified ' . ( $query_verified ? 'wcpr-active' : '' ) . '" rel="nofollow" href="' . ( $query_verified ? esc_url( remove_query_arg( array( 'verified' ), $_SERVER['REQUEST_URI'] ) ) : esc_url( add_query_arg( array( 'verified' => true ), remove_query_arg( array( 'page' ), $_SERVER['REQUEST_URI'] ) ) ) ) . $this->anchor_link . '">' . esc_html__( 'Verified', 'woo-photo-reviews' ) . '(' . $counts2 . ')</a>';
			echo '<span class="wcpr-filter-button-wrap wcpr-filter-button wcpr-active">';
			if ( $query_rating ) {
				echo sprintf( _n( '%s star', '%s stars', $query_rating, 'woo-photo-reviews' ), $query_rating );
				echo '(' . $this->stars_count( $query_rating ) . ')';
			} else {
				echo esc_html__( 'All stars', 'woo-photo-reviews' );
				echo '(' . $counts3 . ')';
			}

			echo '<ul class="wcpr-filter-button-ul">';
			echo '<li class="wcpr-filter-button-li"><a class="wcpr-filter-button ' . ( $query_rating ? '' : 'wcpr-active' ) . '" rel="nofollow" href="' . esc_url( remove_query_arg( array( 'rating' ), remove_query_arg( array( 'page' ), $_SERVER['REQUEST_URI'] ) ) ) . $this->anchor_link . '">';
			echo esc_html__( 'All stars', 'woo-photo-reviews' );
			echo '(' . $counts3 . ')';
			for ( $i = 5; $i > 0; $i -- ) {
				echo '<li class="wcpr-filter-button-li"><a class="wcpr-filter-button ' . ( ( $query_rating && $query_rating == $i ) ? 'wcpr-active' : '' ) . '" rel="nofollow" href="' . ( ( $query_rating && $query_rating == $i ) ? esc_url( remove_query_arg( array( 'rating' ), $_SERVER['REQUEST_URI'] ) ) : esc_url( add_query_arg( array( 'rating' => $i ), remove_query_arg( array( 'page' ), $_SERVER['REQUEST_URI'] ) ) ) ) . $this->anchor_link . '">';
				echo sprintf( _n( '%s star', '%s stars', $i, 'woo-photo-reviews' ), $i );
				echo '(' . $this->stars_count( $i ) . ')</a></li>';
			}
			echo '</ul>';
			echo '</span>';
			echo '</div>';
			add_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
		}
	}


	public function start_ob( $tab ) {
		if ( ! is_product() || ! is_single() ) {
			return $tab;
		}
		ob_start();

		return $tab;
	}


	public function end_ob() {
		if ( ! is_product() || ! is_single() ) {
			return;
		}
		global $product;
		$product_link = remove_query_arg( array( 'image','verified','rating' ), $_SERVER['REQUEST_URI'] );
		$v            = ob_get_clean();
		$reviews      = apply_filters( 'woocommerce_photo_reviews_comments_wrap', 'comments' );
		$filter       = 'id="' . $reviews . '">';
		//review count
		$filter .= '<div class="wcpr-overall-rating-and-rating-count">';
		if ( 'on' == $this->settings->get_params( 'photo', 'overall_rating' ) ) {
			$filter .= '<div class="wcpr-overall-rating">';
			$filter .= '<h2>' . esc_html__( 'Customer reviews', 'woo-photo-reviews' ) . '</h2>';
			$filter .= '<div class="wcpr-overall-rating-main"><div class="wcpr-overall-rating-left"><span class="wcpr-overall-rating-left-average">' . round( $product->get_average_rating(), 2 ) . '</span>';
			$filter .= '</div><div class="wcpr-overall-rating-right"><div class="wcpr-overall-rating-right-star">' . wc_get_rating_html( $product->get_average_rating() ) . '</div><div class="wcpr-overall-rating-right-total">' . sprintf( _n( 'Based on %s review', 'Based on %s reviews', $product->get_review_count(), 'woo-photo-reviews' ), $product->get_review_count(), 'woo-photo-reviews' ) . '</div></div></div></div>';
		}
		if ( 'on' == $this->settings->get_params( 'photo', 'rating_count' ) ) {
			remove_action( 'parse_comment_query', array( $this, 'parse_comment_query' ) );
			remove_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
			$agrs   = array(
				'post_id'  => get_post()->ID,
				'count'    => true,
				'meta_key' => 'rating',
				'status'   => 'approve'
			);
			$counts = get_comments( $agrs );

			$filter      .= '<div class="wcpr-stars-count">';
			$star_counts = array();
			for ( $i = 1; $i < 6; $i ++ ) {

				$star_counts[ $i ] = $this->stars_count( $i );
			}
			for ( $i = 5; $i > 0; $i -- ) {
				$rate = 0;
				if ( $counts > 0 ) {
					$rate = ( 100 * ( $star_counts[ $i ] / $counts ) );
				}
				$filter .= '<div class="wcpr-row"><div class="wcpr-col-number">' . $i . '</div>';
				$filter .= '<div class="wcpr-col-star">' . wc_get_rating_html( $i ) . '</div>';
				$filter .= '<div class="wcpr-col-process"><div class="rate-percent-bg"><div class="rate-percent"  style="background-color: ' . ( empty( $this->settings->get_params( 'photo', 'rating_count_bar_color' ) ) ? '#96588a' : $this->settings->get_params( 'photo', 'rating_count_bar_color' ) ) . ';height: 100%;width:' . $rate . '%;position: absolute;top:0;left: 0;z-index: 1;border-radius: 3px;"></div><div style="position: absolute;text-align:center;width: 100%;color: white;z-index: 2;">' . round( $rate ) . ' %</div></div></div>';
				$filter .= '<div class="wcpr-col-rank-count">' . $star_counts[ $i ] . '</div></div>';
			}
			$filter .= '</div>';
			add_action( 'parse_comment_query', array( $this, 'parse_comment_query' ) );
			add_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
		}
		$filter .= '</div>';
		//                review filter
		//contain images
		if ( 'on' == $this->settings->get_params( 'photo', 'filter' )['enable'] ) {
			$agrs1   = array(
				'post_id'  => get_post()->ID,
				'count'    => true,
				'meta_key' => 'reviews-images',
				'status'   => 'approve'
			);
			$counts1 = get_comments( $agrs1 );

			$agrs2   = array(
				'post_id'    => get_post()->ID,
				'count'      => true,
				'meta_key'   => 'verified',
				'meta_value' => 1,
				'status'     => 'approve'
			);
			$counts2 = get_comments( $agrs2 );
			remove_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
			$agrs3   = array(
				'post_id'  => get_post()->ID,
				'count'    => true,
				'meta_key' => 'rating',
				'status'   => 'approve'
			);
			$counts3 = get_comments( $agrs3 );


			$query_image    = isset( $_GET['image'] ) ? $_GET['image'] : '';
			$query_verified = isset( $_GET['verified'] ) ? $_GET['verified'] : '';
			$query_rating   = isset( $_GET['rating'] ) ? $_GET['rating'] : '';

			if ( $query_image ) {
				$product_link = add_query_arg( array( 'image' => true ), $product_link );
			}
			if ( $query_verified ) {
				$product_link = add_query_arg( array( 'verified' => true ), $product_link );
			}
			if ( $query_rating ) {
				$product_link = add_query_arg( array( 'rating' => $query_rating ), $product_link );
			}
			$filter .= '<div class="wcpr-filter-container">';
			if ( $this->settings->get_params( 'photo', 'enable' ) == 'on' ) {
				$filter .= '<a class="wcpr-filter-button wcpr-filter-button-images ' . ( $query_image ? 'wcpr-active' : '' ) . '" rel="nofollow" href="' . ( $query_image ? esc_url( remove_query_arg( array(
						'image',
						'offset',
						'cpage'
					), $product_link ) ) : esc_url( add_query_arg( array( 'image' => true ), remove_query_arg( array(
						'page',
						'offset',
						'cpage'
					), $product_link ) ) ) ) . $this->anchor_link . '">' . esc_html__( 'With images', 'woo-photo-reviews' ) . '(' . $counts1 . ')</a>';
			}
			$filter .= '<a class="wcpr-filter-button ';
			if ( $this->settings->get_params( 'photo', 'verified' ) == 'badge' ) {
				$filter .= $this->settings->get_params( 'photo', 'verified_badge' );
			} else {
				$filter .= 'wcpr-filter-button-verified';
			}
			$filter .= ( $query_verified ? ' wcpr-active' : '' ) . '" rel="nofollow" href="' . ( $query_verified ? esc_url( remove_query_arg( array(
					'verified',
					'offset',
					'cpage'
				), $product_link ) ) : esc_url( add_query_arg( array( 'verified' => true ), remove_query_arg( array(
					'page',
					'offset',
					'cpage'
				), $product_link ) ) ) ) . $this->anchor_link . '">' . esc_html__( 'Verified', 'woo-photo-reviews' ) . '(' . $counts2 . ')</a>';
			$filter .= '<span class="wcpr-filter-button-wrap wcpr-filter-button wcpr-active">';
			if ( $query_rating > 0 && $query_rating < 6 ) {
				$filter .= sprintf( _n( '%s star', '%s stars', $query_rating, 'woo-photo-reviews' ), $query_rating );
				$filter .= '(' . $this->stars_count( $query_rating ) . ')';
			} else {
				$filter .= esc_html__( 'All stars', 'woo-photo-reviews' );
				$filter .= '(' . $counts3 . ')';
			}

			$filter .= '<ul class="wcpr-filter-button-ul">';
			$filter .= '<li class="wcpr-filter-button-li"><a class="wcpr-filter-button ' . ( $query_rating ? '' : 'wcpr-active' ) . '" rel="nofollow" href="' . esc_url( remove_query_arg( array( 'rating' ), remove_query_arg( array( 'page' ), $product_link ) ) ) . $this->anchor_link . '">';
			$filter .= esc_html__( 'All stars', 'woo-photo-reviews' );
			$filter .= '(' . $counts3 . ')';
			for ( $i = 5; $i > 0; $i -- ) {
				$filter .= '<li class="wcpr-filter-button-li"><a class="wcpr-filter-button ' . ( ( $query_rating && $query_rating == $i ) ? 'wcpr-active' : '' ) . '" rel="nofollow" href="' . ( ( $query_rating && $query_rating == $i ) ? esc_url( remove_query_arg( array(
						'rating',
						'offset',
						'cpage'
					), $product_link ) ) : esc_url( add_query_arg( array( 'rating' => $i ), remove_query_arg( array(
						'page',
						'offset',
						'cpage'
					), $product_link ) ) ) ) . $this->anchor_link . '">';
				$filter .= sprintf( _n( '%s star', '%s stars', $i, 'woo-photo-reviews' ), $i );
				$filter .= '(' . $this->stars_count( $i ) . ')</a></li>';
			}
			$filter .= '</ul>';
			$filter .= '</span>';
			$filter .= '</div>';
			add_action( 'parse_comment_query', array( $this, 'parse_comment_query1' ) );
		}

		$v = str_replace( 'id="' . $reviews . '">', $filter, $v );
		if ( $this->settings->get_params( 'photo', 'enable' ) == 'on' && 1 == $this->settings->get_params( 'photo', 'display' ) ) {
			$v = str_replace( '<ol class="commentlist">', '', $v );
			$v = str_replace( '</ol>', '', $v );
		}

		print( $v );
	}

	public function add_form_enctype_start() {
		if ( ! is_product() || ! is_single() ) {
			return;
		}
		ob_start();
	}

	public function add_form_enctype_end() {
		if ( ! is_product() || ! is_single() ) {
			return;
		}
		$v = ob_get_clean();
		$v = str_replace( '<form', '<form enctype="multipart/form-data"', $v );
		print( $v );
	}

	public function sort_reviews( $comment_args ) {
		if ( $this->is_ajax ) {
			die;
		}
		$comment_args['orderby'] = 'comment_date_gmt';
		if ( $this->settings->get_params( 'photo', 'sort' )['time'] == 1 ) {
			$comment_args['order'] = 'DESC';
		} else {
			$comment_args['order'] = 'ASC';
		}

		return $comment_args;
	}

	public function filter_reviews( $comment_args ) {
		$rating = 0;
		if ( isset( $_GET['rating'] ) ) {
			switch ( $_GET['rating'] ) {
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
					$rating = $_GET['rating'];
					break;
				default:
					$rating = 0;
			}
		}
		$image    = isset( $_GET['image'] ) ? isset( $_GET['image'] ) : "";
		$verified = isset( $_GET['verified'] ) ? isset( $_GET['verified'] ) : "";
		if ( $rating ) {
			$comment_args += [ 'meta_key' => 'rating', 'meta_value' => $rating ];
		} elseif ( $image == 'true' ) {
			$comment_args += [ 'meta_key' => 'reviews-images' ];
		} elseif ( $verified == 'true' ) {
			$comment_args += [ 'meta_key' => 'verified', 'meta_value' => 1 ];
		}

		return $comment_args;
	}


	public function frontend_enqueue() {
		if ( ! is_product() || ! is_single() ) {
			return;
		}
		global $wcpr_detect;
		$css_inline = '';
		wp_enqueue_style( 'wcpr-verified-badge-icon', VI_WOO_PHOTO_REVIEWS_CSS . 'woocommerce-photo-reviews-badge.css', array(), VI_WOO_PHOTO_REVIEWS_VERSION );
		wp_enqueue_style( 'woocommerce-photo-reviews-style', VI_WOO_PHOTO_REVIEWS_CSS . 'style.css', array(), VI_WOO_PHOTO_REVIEWS_VERSION );
		wp_enqueue_script( 'woocommerce-photo-reviews-script', VI_WOO_PHOTO_REVIEWS_JS . 'script.js', array( 'jquery' ), VI_WOO_PHOTO_REVIEWS_VERSION );
		wp_localize_script( 'woocommerce-photo-reviews-script', 'woocommerce_photo_reviews_params', array(
				'ajaxurl'               => admin_url( 'admin-ajax.php' ),
				'warning_gdpr'          => esc_html__( 'Please agree with our term and policy.', 'woo-photo-reviews' ),
				'max_files'             => 2,
				'warning_max_files'     => sprintf( _n( 'You can only upload maximum of %s file', 'You can only upload maximum of %s files', 2, 'woo-photo-reviews' ), 2 ),
				'default_comments_page' => get_option( 'default_comments_page' ),
				'sort'                  => $this->settings->get_params( 'photo', 'sort' )['time'],
				'display'               => $this->settings->get_params( 'photo', 'display' ),
			)
		);
		if ( 'on' == $this->settings->get_params( 'photo', 'enable' ) ) {
			if ( $this->settings->get_params( 'photo', 'display' ) == 1 ) {
				wp_enqueue_style( 'wcpr-masonry-style', VI_WOO_PHOTO_REVIEWS_CSS . 'masonry.css', array(), VI_WOO_PHOTO_REVIEWS_VERSION );
				if ( $wcpr_detect->isMobile() && ! $wcpr_detect->isTablet() ) {
					wp_enqueue_script( 'wcpr-swipebox-js', VI_WOO_PHOTO_REVIEWS_JS . 'jquery.swipebox.js', array( 'jquery' ) );
					wp_enqueue_style( 'wcpr-swipebox-css', VI_WOO_PHOTO_REVIEWS_CSS . 'swipebox.css' );
					wp_enqueue_script( 'wcpr-masonry-mobile-js', VI_WOO_PHOTO_REVIEWS_JS . 'masonry-mobile.js', array( 'jquery' ) );
				} else {
					wp_enqueue_script( 'wcpr-masonry-script', VI_WOO_PHOTO_REVIEWS_JS . 'masonry.js', array( 'jquery' ), VI_WOO_PHOTO_REVIEWS_VERSION );
				}
			} elseif ( $this->settings->get_params( 'photo', 'display' ) == 2 ) {
				wp_enqueue_style( 'wcpr-rotate-font-style', VI_WOO_PHOTO_REVIEWS_CSS . 'rotate.css', array(), VI_WOO_PHOTO_REVIEWS_VERSION );
				wp_enqueue_style( 'wcpr-default-display-style', VI_WOO_PHOTO_REVIEWS_CSS . 'default-display-images.css', array(), VI_WOO_PHOTO_REVIEWS_VERSION );
				wp_enqueue_script( 'wcpr-default-display-script', VI_WOO_PHOTO_REVIEWS_JS . 'default-display-images.js', array( 'jquery' ), VI_WOO_PHOTO_REVIEWS_VERSION );
				$css_inline2 = ".reviews-images-item{margin-right: 2px;padding: 0;float:left;border-radius: 3px;}.kt-reviews-image-container>.kt-wc-reviews-images-wrap-wrap>.reviews-images-item>.review-images{float: left;height: 40px;width:auto;border-radius: 3px;}";
				wp_add_inline_style( 'wcpr-default-display-style', $css_inline2 );
			}
		}
		if ( $this->settings->get_params( 'photo', 'filter' )['enable'] == 'on' ) {
			$css_inline .= ".wcpr-filter-container{";
			if ( $this->settings->get_params( 'photo', 'filter' )['area_border_color'] ) {
				$css_inline .= "border:1px solid " . $this->settings->get_params( 'photo', 'filter' )['area_border_color'] . ";";
			}
			if ( $this->settings->get_params( 'photo', 'filter' )['area_bg_color'] ) {
				$css_inline .= 'background-color:' . $this->settings->get_params( 'photo', 'filter' )['area_bg_color'] . ';';
			}
			$css_inline .= "}";
			$css_inline .= '.wcpr-filter-button{';

			if ( $this->settings->get_params( 'photo', 'filter' )['button_color'] ) {
				$css_inline .= 'color:' . $this->settings->get_params( 'photo', 'filter' )['button_color'] . ';';
			}
			if ( $this->settings->get_params( 'photo', 'filter' )['button_bg_color'] ) {
				$css_inline .= 'background-color:' . $this->settings->get_params( 'photo', 'filter' )['button_bg_color'] . ';';
			}
			if ( $this->settings->get_params( 'photo', 'filter' )['button_border_color'] ) {
				$css_inline .= 'border:1px solid ' . $this->settings->get_params( 'photo', 'filter' )['button_border_color'] . ';';
			}
			$css_inline .= "}";
		}

		if ( $this->settings->get_params( 'photo', 'custom_css' ) ) {
			$css_inline .= $this->settings->get_params( 'photo', 'custom_css' );
		}
		wp_add_inline_style( 'woocommerce-photo-reviews-style', $css_inline );
	}

	public function wc_reviews( $comment ) {
		global $product;
		if ( ! is_product() ) {
			return;
		}
		$product_title = $product->get_title();
		echo '<div class="kt-reviews-image-container">';
		if ( get_comment_meta( $comment->comment_ID, 'reviews-images' ) ) {
			$image_post_ids = get_comment_meta( $comment->comment_ID, 'reviews-images', true );
			echo '<div class="kt-wc-reviews-images-wrap-wrap">';
			$i = 0;
			foreach ( $image_post_ids as $image_post_id ) {
				if ( ! wc_is_valid_url( $image_post_id ) ) {
					$image_data = wp_get_attachment_metadata( $image_post_id );
					$alt        = get_post_meta( $image_post_id, '_wp_attachment_image_alt', true );
					$image_alt  = $alt ? $alt : $product_title;
					?>
                    <div class="reviews-images-item"
                         data-imagesrc="<?php echo( isset( $image_data['sizes']['wcpr-photo-reviews'] ) ? wp_get_attachment_image_url( $image_post_id, 'wcpr-photo-reviews' ) : ( isset( $image_data['sizes']['medium_large'] ) ? wp_get_attachment_image_url( $image_post_id, 'medium_large' ) : ( isset( $image_data['sizes']['medium'] ) ? wp_get_attachment_image_url( $image_post_id, 'medium' ) : wp_get_attachment_thumb_url( $image_post_id ) ) ) ) ?>"
                         data-index="<?php echo $i; ?>">
                        <img class="review-images"
                             src="<?php echo apply_filters( 'woocommerce_photo_reviews_thumbnail_photo', wp_get_attachment_thumb_url( $image_post_id ), $image_post_id, $comment ); ?>"
                             alt="<?php echo apply_filters( 'woocommerce_photo_reviews_image_alt', $image_alt, $image_post_id, $comment ) ?>"/>
                    </div>
					<?php
				} else {
					?>
                    <div class="reviews-images-item"
                         data-imagesrc="<?php echo $image_post_id ?>"
                         data-index="<?php echo $i; ?>">
                        <img class="review-images"
                             src="<?php echo $image_post_id; ?>" alt="<?php echo $product_title ?>"/>
                    </div>
					<?php
				}
				$i ++;
			}
			echo '</div>';
			echo '<div class="big-review-images">';
			echo '<div class="big-review-images-content"></div>';
			echo '<span class="wcpr-close"></span>';
			echo '<div class="wcpr-rotate"><input type="hidden" class="wcpr-rotate-value" value="0"><span class="wcpr-rotate-left wcpr_rotate-rotate-left-circular-arrow-interface-symbol" title="' . esc_html__( 'Rotate left 90 degrees', 'woo-photo-reviews' ) . '"></span><span class="wcpr-rotate-right wcpr_rotate-rotating-arrow-to-the-right" title="' . esc_html__( 'Rotate right 90 degrees', 'woo-photo-reviews' ) . '"></span></div>';
			if ( sizeof( $image_post_ids ) > 1 ) {
				echo '<span class="wcpr-prev"></span>';
				echo '<span class="wcpr-next"></span>';
			}
			echo '</div>';
		}
		echo '</div>';
	}

	//remove wc reviews display
	public function remove_action() {
		remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar' );
		remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating' );
		remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta' );
		remove_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text' );
	}


	public function follow_up_email( $order_id ) {
		$order = wc_get_order( $order_id );
		if ( $order ) {
			$date_create   = $order->get_date_created()->date_i18n( 'F d, Y' );
			$date_complete = $order->get_date_completed()->date_i18n( 'F d, Y' );
			$items         = $order->get_items();
			$products      = array();

			foreach ( $items as $item ) {
				$product_id = $item->get_product_id();
				$products[] = $product_id;
			}
			$products = array_unique( $products );
			if ( count( $products ) ) {
				$user_email    = $order->get_billing_email();
				$customer_name = $order->get_billing_first_name();
				$t_amount      = $this->settings->get_params( 'followup_email', 'amount' );
				$t_unit        = $this->settings->get_params( 'followup_email', 'unit' );
				switch ( $t_unit ) {
					case 's':
						$t = $t_amount;
						break;
					case 'm':
						$t = $t_amount * 60;
						break;
					case 'h':
						$t = $t_amount * 3600;
						break;
					case 'd':
						$t = $t_amount * 86400;
						break;
					default:
						$t = 0;
				}
				$user_id = $order->get_user_id();
				if ( ! $user_id ) {
					$user = get_user_by( 'email', $user_email );
					if ( $user ) {
						$user_id = $user->ID;
					}
				}

				$time = time() + $t;
				if ( $user_id ) {
					$user_reviewed_products = get_user_meta( $user_id, 'wcpr_user_reviewed_product', false );
					if ( ! count( $user_reviewed_products ) ) {
						/*this user did not review any products*/
						$schedule = wp_schedule_single_event(
							$time, 'wpr_schedule_email', array(
								$user_email,
								$customer_name,
								$products,
								$order_id,
								$time,
								$date_create,
								$date_complete,
							)
						);
						if ( $schedule !== false ) {
							update_post_meta( $order_id, '_wcpr_review_reminder', array(
								'status'   => 'pending',
								'time'     => $time,
								'products' => $products,
							) );
						}

					} else {
						/*only send review reminder if there are products in the order that this user did not review*/
						$not_reviewed_products = array_diff( $products, $user_reviewed_products );
						if ( count( $not_reviewed_products ) ) {
							$schedule = wp_schedule_single_event(
								$time, 'wpr_schedule_email', array(
									$user_email,
									$customer_name,
									$not_reviewed_products,
									$order_id,
									$time,
									$date_create,
									$date_complete,
								)
							);
							if ( $schedule !== false ) {
								update_post_meta( $order_id, '_wcpr_review_reminder', array(
									'status'   => 'pending',
									'time'     => $time,
									'products' => $not_reviewed_products,
								) );
							}
						}
					}
				} else {
					$sents = array();
					foreach ( $products as $p ) {
						$args     = array(
							'post_type'    => 'product',
							'type'         => 'review',
							'author_email' => $user_email,
							'post_id'      => $p,
							'meta_query'   => array(
								'relation' => 'AND',
								array(
									'key'     => 'id_import_reviews_from_ali',
									'compare' => 'NOT EXISTS'
								),
							)
						);
						$comments = get_comments( $args );
						if ( ! count( $comments ) ) {
							$sents[] = $p;
						}
					}
					if ( count( $sents ) ) {
						$schedule = wp_schedule_single_event(
							$time, 'wpr_schedule_email', array(
								$user_email,
								$customer_name,
								$sents,
								$order_id,
								$time,
								$date_create,
								$date_complete,
							)
						);
						if ( $schedule !== false ) {
							update_post_meta( $order_id, '_wcpr_review_reminder', array(
								'status'   => 'pending',
								'time'     => $time,
								'products' => $sents,
							) );
						}
					}
				}

			}
		}
	}

	public function send_schedule_email( $user_email, $customer_name, $products, $order_id, $time, $date_create, $date_complete ) {
		if ( count( $products ) ) {
			$order = wc_get_order( $order_id );
			if ( ! $order ) {
				return;
			}
			$headers = 'Content-Type: text/html';
			$content = nl2br( stripslashes( $this->settings->get_params( 'followup_email', 'content' ) ) );
			$content = str_replace( '{customer_name}', $customer_name, $content );
			$content = str_replace( '{order_id}', $order_id, $content );
			$content = str_replace( '{date_create}', $date_create, $content );
			$content = str_replace( '{date_complete}', $date_complete, $content );
			$content = str_replace( '{site_title}', get_bloginfo( 'name' ), $content );
			$content .= '<table style="width: 100%;">';
			foreach ( $products as $p ) {
				$product = wc_get_product( $p );
				if ( $product ) {
					$product_image = wp_get_attachment_thumb_url( $product->get_image_id() );
					$product_url   = $product->get_permalink() . $this->anchor_link;

					$product_title = $product->get_title();
					$product_price = $product->get_price_html();
					ob_start();
					?>
                    <tr>
                        <td style="text-align: center;">
                            <a target="_blank" href="<?php echo $product_url ?>">
                                <img style="width: 150px;"
                                     src="<?php echo $product_image ?>"
                                     alt="<?php echo $product_title ?>">
                            </a>
                        </td>
                        <td>
                            <p>
                                <a target="_blank" href="<?php echo $product_url ?>"><?php echo $product_title ?></a>
                            </p>
                            <p><?php echo $product_price ?></p>
                            <a target="_blank"
                               style="text-align: center;padding: 10px;text-decoration: none;font-weight: 800;
                                       background-color:<?php echo $this->settings->get_params( 'followup_email', 'review_button_bg_color' ); ?>;
                                       color:<?php echo $this->settings->get_params( 'followup_email', 'review_button_color' ) ?>;"
                               href="<?php echo $product_url ?>"><?php esc_html_e( 'Review Now', 'woo-photo-reviews' ) ?>
                            </a>
                        </td>
                    </tr>
					<?php
					$content .= ob_get_clean();
				}
			}
			$content       .= '</table>';
			$subject       = stripslashes( $this->settings->get_params( 'followup_email', 'subject' ) );
			$email_heading = $this->settings->get_params( 'followup_email', 'heading' );
			$mailer        = WC()->mailer();
			$email         = new WC_Email();
			$content       = $email->style_inline( $mailer->wrap_message( $email_heading, $content ) );
			$email->send( $user_email, $subject, $content, $headers, array() );
			update_post_meta( $order_id, '_wcpr_review_reminder', array(
				'status' => 'sent',
				'time'   => $time,
				'products'   => $products,
			) );
		}
	}

	protected function rand() {
		if ( $this->characters_array === null ) {
			$this->characters_array = array_merge( range( 0, 9 ), range( 'a', 'z' ) );
		}
		$rand = rand( 0, count( $this->characters_array ) - 1 );

		return $this->characters_array[ $rand ];
	}

	protected function create_code() {
		$code = '';
		for ( $i = 0; $i < 6; $i ++ ) {
			$code .= $this->rand();
		}
		$args      = array(
			'post_type'      => 'shop_coupon',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'title'          => $code
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			wp_reset_postdata();
			$code = $this->create_code();
		}
		wp_reset_postdata();

		return $code;
	}

	public function generate_coupon() {
		if ( $this->settings->get_params( 'coupon', 'coupon_select' ) === 'kt_generate_coupon' ) {
			$coupon_generate = $this->settings->get_params( 'coupon', 'unique_coupon' );
			$code            = $this->create_code();
			$coupon          = new WC_Coupon( $code );
			$today           = strtotime( date( 'Ymd' ) );
			$date_expires    = ( $coupon_generate['expiry_date'] ) ? ( ( $coupon_generate['expiry_date'] + 1 ) * 86400 + $today ) : '';
			$coupon->set_amount( $coupon_generate['coupon_amount'] );
			$coupon->set_date_expires( $date_expires );
			$coupon->set_discount_type( $coupon_generate['discount_type'] );
			$coupon->set_individual_use( $coupon_generate['individual_use'] == 'yes' ? 1 : 0 );
			if ( $coupon_generate['product_ids'] ) {
				$coupon->set_product_ids( implode( ',', array_filter( $coupon_generate['product_ids'] ) ) );
			}
			if ( $coupon_generate['excluded_product_ids'] ) {
				$coupon->set_excluded_product_ids( implode( ',', array_filter( $coupon_generate['excluded_product_ids'] ) ) );
			}
			$coupon->set_usage_limit( $coupon_generate['limit_per_coupon'] );
			$coupon->set_usage_limit_per_user( $coupon_generate['limit_per_user'] );
			$coupon->set_limit_usage_to_x_items( $coupon_generate['limit_to_x_items'] );
			$coupon->set_free_shipping( $coupon_generate['allow_free_shipping'] == 'yes' ? 1 : 0 );
			$coupon->set_product_categories( $coupon_generate['product_categories'] );
			$coupon->set_excluded_product_categories( $coupon_generate['excluded_product_categories'] );
			$coupon->set_exclude_sale_items( $coupon_generate['exclude_sale_items'] == 'yes' ? 1 : 0 );
			$coupon->set_minimum_amount( $coupon_generate['min_spend'] );
			$coupon->set_maximum_amount( $coupon_generate['max_spend'] );
			$coupon->save();
			$code = $coupon->get_code();
			update_post_meta( $coupon->get_id(), 'kt_unique_coupon', 'yes' );
		} else {
			$coupon = new WC_Coupon( $this->settings->get_params( 'coupon', 'existing_coupon' ) );
			$code   = $coupon->get_code();
			if ( $coupon->get_usage_limit() > 0 && $coupon->get_usage_count() >= $coupon->get_usage_limit() ) {
				return false;
			}
			if ( $coupon->get_date_expires() && time() > $coupon->get_date_expires()->getTimestamp() ) {
				return false;
			}
		}

		return $code;
	}

	public function send_coupon_after_reviews( $comment_id, $commentdata ) {
		$comment    = get_comment( $comment_id );
		$product_id = $comment->comment_post_ID;
		if ( $this->settings->get_params( 'coupon', 'require' )['min_rating'] ) {
			if ( ! get_comment_meta( $comment_id, 'rating', true ) || get_comment_meta( $comment_id, 'rating', true ) < $this->settings->get_params( 'coupon', 'require' )['min_rating'] ) {
				return;
			}
		}
		$user_email    = $comment->comment_author_email;
		$customer_name = $comment->comment_author;
		$user_id       = $comment->user_id;
		if ( $this->settings->get_params( 'coupon', 'require' )['owner'] == 'on' && 1 != get_comment_meta( $comment_id, 'verified', true ) ) {
			$verified = false;
			if ( 'product' === get_post_type( $product_id ) ) {
				$verified = wc_customer_bought_product( $user_email, $user_id, $product_id );
			}
			if ( ! $verified ) {
				return;
			}
		}

		if ( $comment->comment_approved != 1 ) {
			update_comment_meta( $comment_id, 'coupon_for_reviews', "0" );

			return;
		}

		if ( ! $user_id ) {
			$user = get_user_by( 'email', $user_email );
			if ( $user ) {
				$user_id = $user->ID;
			}
		}
		if ( $user_id ) {
			$user_coupon = get_user_meta( $user_id, 'wcpr_user_reviewed_product', false );
			if ( ! count( $user_coupon ) ) {
				$code = $this->generate_coupon();

				if ( $code ) {
					$c = new WC_Coupon( $code );
					add_user_meta( $user_id, 'wcpr_user_reviewed_product', $product_id );
					$er = $c->get_email_restrictions();
					if ( $this->settings->get_params( 'set_email_restriction' ) && ! in_array( $user_email, $er ) ) {
						$er[] = $user_email;
						$c->set_email_restrictions( $er );
						$c->save();
					}
					$coupon_code  = $c->get_code();
					$date_expires = $c->get_date_expires();
					$this->send_email( $user_email, $customer_name, $coupon_code, $date_expires );
					update_comment_meta( $comment_id, 'coupon_email', 'sent', true );
				}

			} elseif ( ! in_array( $product_id, $user_coupon ) ) {
				$code = $this->generate_coupon();

				if ( $code ) {
					$c = new WC_Coupon( $code );
					add_user_meta( $user_id, 'wcpr_user_reviewed_product', $product_id );
					$er = $c->get_email_restrictions();
					if ( $this->settings->get_params( 'set_email_restriction' ) && ! in_array( $user_email, $er ) ) {
						$er[] = $user_email;
						$c->set_email_restrictions( $er );
						$c->save();
					}
					$coupon_code  = $c->get_code();
					$date_expires = $c->get_date_expires();
					$this->send_email( $user_email, $customer_name, $coupon_code, $date_expires );
					update_comment_meta( $comment_id, 'coupon_email', 'sent', true );
				}
			}
		} else {
			$args     = array(
				'post_type'    => 'product',
				'type'         => 'review',
				'author_email' => $user_email,
				'post_id'      => $product_id,
				'meta_query'   => array(
					'relation' => 'AND',
					array(
						'key'     => 'id_import_reviews_from_ali',
						'compare' => 'NOT EXISTS'
					),
					array(
						'key'     => 'coupon_email',
						'compare' => 'EXISTS'
					),
				)
			);
			$comments = get_comments( $args );
			if ( ! count( $comments ) ) {
				$code = $this->generate_coupon();

				if ( $code ) {
					$c  = new WC_Coupon( $code );
					$er = $c->get_email_restrictions();
					if ( $this->settings->get_params( 'set_email_restriction' ) && ! in_array( $user_email, $er ) ) {
						$er[] = $user_email;
						$c->set_email_restrictions( $er );
						$c->save();
					}
					$coupon_code  = $c->get_code();
					$date_expires = $c->get_date_expires();
					$this->send_email( $user_email, $customer_name, $coupon_code, $date_expires );
					update_comment_meta( $comment_id, 'coupon_email', 'sent', true );
				}
			}
		}


	}

	public function coupon_for_not_logged_in( $comment_id ) {
		if ( "0" === get_comment_meta( $comment_id, 'coupon_for_reviews', true ) ) {
			$comment = get_comment( $comment_id );
			if ( $comment->comment_approved != 1 ) {
				return;
			}
			if ( get_comment_meta( $comment_id, 'coupon_email', true ) ) {
				return;
			}
			$product_id = $comment->comment_post_ID;

			if ( $this->settings->get_params( 'coupon', 'require' )['min_rating'] ) {
				if ( ! get_comment_meta( $comment_id, 'rating', true ) || get_comment_meta( $comment_id, 'rating', true ) < $this->settings->get_params( 'coupon', 'require' )['min_rating'] ) {
					return;
				}
			}
			if ( $this->settings->get_params( 'coupon', 'require' )['owner'] == 'on' && 1 != get_comment_meta( $comment_id, 'verified', true ) ) {
				return;
			}
			if ( 'on' == $this->settings->get_params( 'coupon', 'require' )['photo'] && ! get_comment_meta( $comment_id, 'reviews-images', true ) ) {
				return;
			}
			$user_email    = $comment->comment_author_email;
			$customer_name = $comment->comment_author;
			$user_id       = $comment->user_id;
			if ( ! $user_id ) {
				$user = get_user_by( 'email', $user_email );
				if ( $user ) {
					$user_id = $user->ID;
				}
			}
			if ( $user_id ) {
				$user_coupon = get_user_meta( $user_id, 'wcpr_user_reviewed_product', false );
				if ( ! $user_coupon || ! count( $user_coupon ) ) {
					$code = $this->generate_coupon();
					if ( $code ) {
						$c  = new WC_Coupon( $code );
						$er = $c->get_email_restrictions();
						if ( $this->settings->get_params( 'set_email_restriction' ) && ! in_array( $user_email, $er ) ) {
							$er[] = $user_email;
							$c->set_email_restrictions( $er );
							$c->save();
						}
						$coupon_code  = $c->get_code();
						$date_expires = $c->get_date_expires();
						$this->send_email( $user_email, $customer_name, $coupon_code, $date_expires );
						add_user_meta( $user_id, 'wcpr_user_reviewed_product', $product_id );
						update_comment_meta( $comment_id, 'coupon_email', 'sent', true );
						update_comment_meta( $comment_id, 'coupon_for_reviews', 1 );
					}

				} elseif ( ! in_array( $product_id, $user_coupon ) ) {
					$code = $this->generate_coupon();

					if ( $code ) {
						$c = new WC_Coupon( $code );
						add_user_meta( $user_id, 'wcpr_user_reviewed_product', $product_id );
						$er = $c->get_email_restrictions();
						if ( $this->settings->get_params( 'set_email_restriction' ) && ! in_array( $user_email, $er ) ) {
							$er[] = $user_email;
							$c->set_email_restrictions( $er );
							$c->save();
						}
						$coupon_code  = $c->get_code();
						$date_expires = $c->get_date_expires();
						$this->send_email( $user_email, $customer_name, $coupon_code, $date_expires );
						update_comment_meta( $comment_id, 'coupon_email', 'sent', true );
						update_comment_meta( $comment_id, 'coupon_for_reviews', 1 );
					}
				}
			} else {
				$args     = array(
					'post_type'    => 'product',
					'type'         => 'review',
					'author_email' => $user_email,
					'post_id'      => $product_id,
					'meta_query'   => array(
						'relation' => 'AND',
						array(
							'key'     => 'id_import_reviews_from_ali',
							'compare' => 'NOT EXISTS'
						),
						array(
							'key'     => 'coupon_email',
							'compare' => 'EXISTS'
						),
					)
				);
				$comments = get_comments( $args );
				if ( ! count( $comments ) ) {
					$code = $this->generate_coupon();

					if ( $code ) {
						$c  = new WC_Coupon( $code );
						$er = $c->get_email_restrictions();
						if ( $this->settings->get_params( 'set_email_restriction' ) && ! in_array( $user_email, $er ) ) {
							$er[] = $user_email;
							$c->set_email_restrictions( $er );
							$c->save();
						}
						$coupon_code  = $c->get_code();
						$date_expires = $c->get_date_expires();
						$this->send_email( $user_email, $customer_name, $coupon_code, $date_expires );
						update_comment_meta( $comment_id, 'coupon_email', 'sent', true );
						update_comment_meta( $comment_id, 'coupon_for_reviews', 1 );
					}
				}
			}

		}
	}

	public function send_email( $user_email, $customer_name, $coupon_code, $date_expires ) {
		$email_temp    = $this->settings->get_params( 'coupon', 'email' );
		$header        = 'Content-Type: text/html';
		$content       = nl2br( stripslashes( $email_temp['content'] ) );
		$content       = str_replace( '{customer_name}', $customer_name, $content );
		$content       = str_replace( '{coupon_code}', '<span style="font-size: x-large;">' . strtoupper( $coupon_code ) . '</span>', $content );
		$content       = str_replace( '{date_expires}', empty( $date_expires ) ? esc_html__( 'never expires', 'woo-photo-reviews' ) : date_i18n( 'F d, Y', strtotime( $date_expires ) ), $content );
		$subject       = stripslashes( $email_temp['subject'] );
		$mailer        = WC()->mailer();
		$email_heading = isset( $email_temp['heading'] ) ? $email_temp['heading'] : esc_html__( 'Thank You For Your Review!', 'woo-photo-reviews' );
		$email         = new WC_Email();
		$content       = $email->style_inline( $mailer->wrap_message( $email_heading, $content ) );
		$email->send( $user_email, $subject, $content, $header, array() );
	}

	//add field upload image
	public function add_comment_field( $comment_form ) {
		$max                           = $this->settings->get_params( 'photo', 'maxsize' );
		$max_files                     = 2;
		$comment_form['comment_field'] .= '<p class="wcpr-comment-form-images"><label for="wcpr_image_upload">' . esc_html__( 'Choose pictures', 'woo-photo-reviews' ) . ( $this->settings->get_params( 'photo', 'required' ) == 'on' ? '<span class="required">*</span>' : '' ) . esc_html__( ' (maxsize: ', 'woo-photo-reviews' ) . $max . esc_html__( ' kB, max files: 2', 'woo-photo-reviews' ) . ')</label><input type="file" name="wcpr_image_upload[]" id="wcpr_image_upload"  multiple accept=".jpg, .jpeg, .png, .bmp, .gif"/><input type="hidden" id="kt_max_files" name="max_files" value="' . $max_files . '"></p>';
		if ( $this->settings->get_params( 'photo', 'gdpr' ) == 'on' ) {
			$comment_form['comment_field'] .= '<p class="wcpr-gdpr-policy"><input type="checkbox" name="wcpr_gdpr_checkbox">' . ( ( $this->settings->get_params( 'photo', 'gdpr_message' ) ) ? $this->settings->get_params( 'photo', 'gdpr_message' ) : esc_html__( 'I agree with the term and condition.', 'woo-photo-reviews' ) ) . '</p>';
		}
		add_action( 'comment_form', array( $this, 'add_image_upload_nonce' ) );

		return $comment_form;
	}

	//add wp_nonce_field(for image field)
	public function add_image_upload_nonce() {
		wp_nonce_field( 'wcpr_image_upload', 'wcpr_image_upload_nonce' );
	}

	public function stars_count( $star ) {
		$agrs   = array(
			'post_id'    => get_post()->ID,
			'count'      => true,
			'status'     => 'approve',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key'     => 'rating',
					'value'   => $star,
					'compare' => '='
				)
			)
		);
		$return = get_comments( $agrs );

		return $return;
	}

	public function notify_coupon_sent( $a ) {
		global $wp_query;
		$my_comments = get_comments( $wp_query->comments );
		foreach ( $my_comments as $my_comment ) {
			if ( $my_comment->user_id > 0 && $my_comment->user_id == get_current_user_id() ) {
				if ( 'sent' === get_comment_meta( $my_comment->comment_ID, 'coupon_email', true ) ) {
					?>
                    <div class="woocommerce-message">
                        <p><?php esc_html_e( 'Thank you for reviewing our product. A coupon code has been sent to your email address. Please check your mailbox for more details.', 'woo-photo-reviews' ); ?></p>
                    </div>
					<?php
					update_comment_meta( $my_comment->comment_ID, 'coupon_email', 'notified' );
					break;
				}
			}
		}

		return $a;
	}

	public function photo_reviews( $r ) {
		if ( $this->is_ajax || ! is_product() ) {
			return $r;
		}
		global $wp_query, $product, $wcpr_detect;
		$product_title = $product->get_title() . ' photo review';
		if ( 'no' === get_option( 'woocommerce_enable_reviews' ) ) {
			return $r;
		}
		$my_comments = $wp_query->comments;
		?>
        <div class="wcpr-grid <?php echo 'wcpr-masonry-3-col'; ?>">
			<?php
			foreach ( $my_comments as $v ) {
				$rating = intval( get_comment_meta( $v->comment_ID, 'rating', true ) );
				?>
                <div id="comment-<?php echo $v->comment_ID; ?>" class="wcpr-grid-item">
                    <div class="wcpr-content">
						<?php
						if ( get_comment_meta( $v->comment_ID, 'reviews-images', true ) && sizeof( get_comment_meta( $v->comment_ID, 'reviews-images', true ) ) > 0 ) {
							echo '<div class="reviews-images-container">';
							$img_post_ids = get_comment_meta( $v->comment_ID, 'reviews-images', true );
							if ( $wcpr_detect->isMobile() && ! $wcpr_detect->isTablet() ) {
								$i = 0;
								foreach ( $img_post_ids as $image_post_id ) {
									if ( ! wc_is_valid_url( $image_post_id ) ) {
										$image_data = wp_get_attachment_metadata( $image_post_id );
										$alt        = get_post_meta( $image_post_id, '_wp_attachment_image_alt', true );
										$image_alt  = $alt ? $alt : $product_title;
										?>
                                        <!--                                                                                swipebox-->
                                        <a style="<?php if ( $i > 0 ) {
											echo 'display:none;';
										} ?>"
                                           href="<?php echo( isset( $image_data['sizes']['wcpr-photo-reviews'] ) ? wp_get_attachment_image_url( $image_post_id, 'wcpr-photo-reviews' ) : ( isset( $image_data['sizes']['medium_large'] ) ? wp_get_attachment_image_url( $image_post_id, 'medium_large' ) : ( isset( $image_data['sizes']['medium'] ) ? wp_get_attachment_image_url( $image_post_id, 'medium' ) : wp_get_attachment_thumb_url( $image_post_id ) ) ) ); ?>"
                                           rel="photo-reviews-<?php echo $v->comment_ID; ?>"
                                           class="wcpr-swipebox"
                                           title="<?php echo ( $i + 1 ) . '/' . count( $img_post_ids ); ?>">
											<?php
											if ( $i == 0 ) {
												?>
                                                <img style="margin: 0;width: 100%;" class="review-images"
                                                     src="<?php echo isset( $image_data['sizes']['wcpr-photo-reviews'] ) ? wp_get_attachment_image_url( $image_post_id, 'wcpr-photo-reviews' ) : ( isset( $image_data['sizes']['medium'] ) ? wp_get_attachment_image_url( $image_post_id, 'medium' ) : wp_get_attachment_thumb_url( $image_post_id ) ); ?>"
                                                     alt="<?php echo $image_alt; ?>"/>
												<?php
											}
											?>
                                        </a>
										<?php
									} else {
										?>
                                        <!--                                                                                swipebox-->
                                        <a style="<?php if ( $i > 0 ) {
											echo 'display:none;';
										} ?>"
                                           href="<?php echo $image_post_id; ?>"
                                           rel="photo-reviews-<?php echo $v->comment_ID; ?>"
                                           class="wcpr-swipebox"
                                           title="<?php echo ( $i + 1 ) . '/' . count( $img_post_ids ); ?>">
											<?php
											if ( $i == 0 ) {
												?>
                                                <img style="margin: 0;width: 100%;" class="review-images"
                                                     src="<?php echo $image_post_id; ?>"
                                                     alt="<?php echo $product_title; ?>"/>
												<?php
											}
											?>
                                        </a>
										<?php
									}

									$i ++;
								}

							} else {
								echo '<div class="reviews-images-wrap-left">';
								if ( count( $img_post_ids ) > 1 ) {
									foreach ( $img_post_ids as $img_post_id ) {
										if ( ! wc_is_valid_url( $img_post_id ) ) {
											$image_data = wp_get_attachment_metadata( $img_post_id );
											$alt        = get_post_meta( $img_post_id, '_wp_attachment_image_alt', true );
											$image_alt  = $alt ? $alt : $product_title;
											echo '<div class="reviews-images-wrap"><a href="' . ( isset( $image_data['sizes']['wcpr-photo-reviews'] ) ? wp_get_attachment_image_url( $img_post_id, 'wcpr-photo-reviews' ) : ( isset( $image_data['sizes']['medium_large'] ) ? wp_get_attachment_image_url( $img_post_id, 'medium_large' ) : ( isset( $image_data['sizes']['medium'] ) ? wp_get_attachment_image_url( $img_post_id, 'medium' ) : wp_get_attachment_thumb_url( $img_post_id ) ) ) ) . '"><img class="reviews-images" src="' . wp_get_attachment_thumb_url( $img_post_id ) . '" alt="' . $image_alt . '"/></a></div>';
										} else {
											echo '<div class="reviews-images-wrap"><a href="' . $img_post_id . '"><img class="reviews-images" src="' . $img_post_id . '" alt="' . $product_title . '"/></a></div>';
										}

									}
								}
								echo '</div>';
								$clones    = $img_post_ids;
								$first_ele = array_shift( $clones );
								if ( ! wc_is_valid_url( $first_ele ) ) {
									$image_data = wp_get_attachment_metadata( $first_ele );
									$alt        = get_post_meta( $first_ele, '_wp_attachment_image_alt', true );
									$image_alt  = $alt ? $alt : $product_title;
									echo '<div class="reviews-images-wrap-right"><img class="reviews-images" src="' . ( isset( $image_data['sizes']['wcpr-photo-reviews'] ) ? wp_get_attachment_image_url( $first_ele, 'wcpr-photo-reviews' ) : ( isset( $image_data['sizes']['medium_large'] ) ? wp_get_attachment_image_url( $first_ele, 'medium_large' ) : ( isset( $image_data['sizes']['medium'] ) ? wp_get_attachment_image_url( $first_ele, 'medium' ) : wp_get_attachment_thumb_url( $first_ele ) ) ) ) . '" alt="' . $image_alt . '"/></div>';
								} else {
									echo '<div class="reviews-images-wrap-right"><img class="reviews-images" src="' . $first_ele . '" alt="' . $product_title . '"/></div>';
								}
							}
							if ( count( get_comment_meta( $v->comment_ID, 'reviews-images', true ) ) > 1 ) {
								echo '<div class="images-qty">';
								echo '+' . ( count( get_comment_meta( $v->comment_ID, 'reviews-images', true ) ) - 1 );
								echo '</div>';
							}
							echo '</div>';
						}
						?>
                        <div class="review-content-container">
							<?php
							if ( '0' === $v->comment_approved ) {
								?>

                                <p class="meta"><em
                                            class="woocommerce-review__awaiting-approval"><?php esc_attr_e( 'Your review is awaiting approval', 'woo-photo-reviews' ); ?></em>
                                </p>

								<?php
							} else {
								?>
                                <div class="wcpr-comment-author"><?php comment_author( $v ) ?>
									<?php
									if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && 1 == get_comment_meta( $v->comment_ID, 'verified', true ) ) {
										if ( $this->settings->get_params( 'photo', 'verified' ) == 'badge' ) {
											echo '<em class="woocommerce-review__verified verified woocommerce-photo-reviews-verified ' . $this->settings->get_params( 'photo', 'verified_badge' ) . '"></em> ';
										} elseif ( $this->settings->get_params( 'photo', 'verified' ) == 'text' ) {
											echo '<em class="woocommerce-review__verified verified woocommerce-photo-reviews-verified">' . $this->settings->get_params( 'photo', 'verified_text' ) . '</em> ';
										} else {
											echo '<em class="woocommerce-review__verified verified woocommerce-photo-reviews-verified wcpr-icon-badge"></em>';
										}
									} ?>
                                </div>
							<?php }
							if ( $rating > 0 ) {
								echo wc_get_rating_html( $rating );
							}
							?>
                            <div class="wcpr-review-content"><?php echo $v->comment_content; ?></div>
                        </div>

                    </div>
                </div>
				<?php
			}
			?>
        </div>

		<?php
	}


	public function check_review_image( $comment ) {
		$maxsize_allowed = $this->settings->get_params( 'photo', 'maxsize' );
		$max_file_up     = 2;
		$im              = $_FILES['wcpr_image_upload'];
		if ( ! isset( $_POST['wcpr_image_upload_nonce'], $_FILES['wcpr_image_upload'] ) || ! wp_verify_nonce( $_POST['wcpr_image_upload_nonce'], 'wcpr_image_upload' ) ) {
			return $comment;
		} else {
			if ( ( 'on' == $this->settings->get_params( 'photo', 'gdpr' ) ) && ( ! isset( $_POST['wcpr_gdpr_checkbox'] ) || ! $_POST['wcpr_gdpr_checkbox'] ) ) {
				wp_die( 'Please agree with the GDPR policy!' );
			}
			if ( is_array( $im['name'][0] ) ) {
				if ( $im['name'][0][0] == '' ) {
					if ( 'on' == $this->settings->get_params( 'photo', 'required' ) ) {
						wp_die( 'Photo is required.' );
					}
				} else {
					if ( count( $_FILES['wcpr_image_upload']['name'] ) > $max_file_up ) {

						wp_die( "Maximum number of files allowed is: $max_file_up." );
					}
					foreach ( $im['size'] as $size ) {
						if ( ! $size[0] ) {
							wp_die( "File's too large!" );
						}
						if ( $size[0] > ( $maxsize_allowed * 1024 ) ) {
							wp_die( "Max size allowed: $maxsize_allowed kB." );
						}
					}
					foreach ( $im['type'] as $type ) {

						if ( $type[0] != "image/jpg" && $type[0] != "image/jpeg" && $type[0] != "image/bmp" && $type[0] != "image/png" && $type[0] != "image/gif" ) {
							wp_die( "Only JPG, JPEG, BMP, PNG and GIF are allowed." );
						}
					}
					add_action( 'comment_post', array( $this, 'add_review_image' ) );
					if ( 'on' == $this->settings->get_params( 'coupon', 'require' )['photo'] && 'yes' == get_option( 'woocommerce_enable_coupons' ) && 'on' == $this->settings->get_params( 'coupon', 'enable' ) ) {
						add_action( 'comment_post', array( $this, 'send_coupon_after_reviews' ), 10, 2 );
					}
				}
			} else {
				if ( $im['name'][0] == '' ) {
					if ( 'on' == $this->settings->get_params( 'photo', 'required' ) ) {
						wp_die( 'Photo is required.' );
					}
				} else {
					if ( count( $_FILES['wcpr_image_upload']['name'] ) > $max_file_up ) {

						wp_die( "Maximum number of files allowed is: $max_file_up." );
					}
					foreach ( $im['size'] as $size ) {
						if ( ! $size ) {
							wp_die( "File's too large!" );
						}
						if ( $size > ( $maxsize_allowed * 1024 ) ) {
							wp_die( "Max size allowed: $maxsize_allowed kilobytes." );
						}
					}
					foreach ( $im['type'] as $type ) {

						if ( $type != "image/jpg" && $type != "image/jpeg" && $type != "image/bmp" && $type != "image/png" && $type != "image/gif" ) {
							wp_die( "Only JPG, JPEG, BMP, PNG and GIF are allowed." );
						}
					}
					add_action( 'comment_post', array( $this, 'add_review_image' ) );
					if ( 'on' == $this->settings->get_params( 'coupon', 'require' )['photo'] && 'yes' == get_option( 'woocommerce_enable_coupons' ) && 'on' == $this->settings->get_params( 'coupon', 'enable' ) ) {
						add_action( 'comment_post', array( $this, 'send_coupon_after_reviews' ), 10, 2 );
					}
				}
			}

		}

		return $comment;
	}

	public function add_review_image( $comment_id ) {
		add_filter( 'intermediate_image_sizes', array( $this, 'reduce_image_sizes' ) );

		$post_id = get_comment( $comment_id )->comment_post_ID;
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		$files  = $_FILES["wcpr_image_upload"];
		$img_id = array();
		if ( is_array( $files['name'][0] ) ) {
			foreach ( $files['name'] as $key => $value ) {
				if ( $files['name'][ $key ][0] ) {
					$file                   = array(
						'name'     => apply_filters( 'woocommerce_photo_reviews_image_file_name', $files['name'][ $key ][0], $comment_id, $post_id ),
						'type'     => $files['type'][ $key ][0],
						'tmp_name' => $files['tmp_name'][ $key ][0],
						'error'    => $files['error'][ $key ][0],
						'size'     => $files['size'][ $key ][0]
					);
					$_FILES ["upload_file"] = $file;
					$attachment_id          = media_handle_upload( "upload_file", $post_id );
					if ( is_wp_error( $attachment_id ) ) {
						wp_die( "Error adding file." );
					} else {
						$img_id[] = $attachment_id;
					}
				}
			}
		} else {
			foreach ( $files['name'] as $key => $value ) {
				if ( $files['name'][ $key ] ) {
					$file                   = array(
						'name'     => apply_filters( 'woocommerce_photo_reviews_image_file_name', $files['name'][ $key ], $comment_id, $post_id ),
						'type'     => $files['type'][ $key ],
						'tmp_name' => $files['tmp_name'][ $key ],
						'error'    => $files['error'][ $key ],
						'size'     => $files['size'][ $key ]
					);
					$_FILES ["upload_file"] = $file;
					$attachment_id          = media_handle_upload( "upload_file", $post_id );
					if ( is_wp_error( $attachment_id ) ) {
						wp_die( "Error adding file." );
					} else {
						$img_id[] = $attachment_id;
					}
				}
			}
		}
		remove_filter( 'intermediate_image_sizes', array( $this, 'reduce_image_sizes' ) );

		update_comment_meta( $comment_id, 'reviews-images', $img_id );
		update_comment_meta( $comment_id, 'gdpr_agree', 1 );
	}
}
