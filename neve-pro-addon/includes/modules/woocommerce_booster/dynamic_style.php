<?php
/**
 * File that handle dynamic css for Woo pro integration.
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster
 */
namespace Neve_Pro\Modules\Woocommerce_Booster;

use Neve\Core\Settings\Mods;
use Neve_Pro\Core\Generic_Style;

/**
 * Class Dynamic_Style
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster
 */
class Dynamic_Style extends Generic_Style {

	const SAME_IMAGE_HEIGHT      = 'neve_force_same_image_height';
	const IMAGE_HEIGHT           = 'neve_image_height';
	const SALE_TAG_COLOR         = 'neve_sale_tag_color';
	const SALE_TAG_TEXT_COLOR    = 'neve_sale_tag_text_color';
	const SALE_TAG_RADIUS        = 'neve_sale_tag_radius';
	const BOX_SHADOW_INTENTISITY = 'neve_box_shadow_intensity';
	const THUMBNAIL_WIDTH        = 'woocommerce_thumbnail_image_width';

	/**
	 * Add dynamic style subscribers.
	 *
	 * @param array $subscribers Css subscribers.
	 *
	 * @return array|mixed
	 */
	public function add_subscribers( $subscribers = [] ) {

		$same_image_height = Mods::get( self::SAME_IMAGE_HEIGHT );
		if ( $same_image_height === true ) {
			$subscribers['.woocommerce ul.products li.product .nv-product-image.nv-same-image-height'] = [
				'height' => [
					'key'     => self::IMAGE_HEIGHT,
					'default' => 230,
				],
			];
		}
		$subscribers['.woocommerce span.onsale'] = [
			'background-color' => self::SALE_TAG_COLOR,
			'color'            => self::SALE_TAG_TEXT_COLOR,
			'border-radius'    => [
				'key'    => self::SALE_TAG_RADIUS,
				'suffix' => '%',
			],
		];
		$box_shadow                              = Mods::get( self::BOX_SHADOW_INTENTISITY, 0 );
		if ( $box_shadow === 0 ) {
			return $subscribers;
		}
		$subscribers['.woocommerce ul.products li .nv-card-content-wrapper'] = [
			'box-shadow' => [
				'key'    => self::BOX_SHADOW_INTENTISITY,
				'filter' => function ( $css_prop, $value, $meta, $device ) {
					return 'box-shadow: 0px 1px 20px ' . ( $value - 20 ) . 'px rgba(0, 0, 0, 0.12);';
				},
			],
		];
		$subscribers['.woocommerce .nv-list ul.products.columns-neve li.product .nv-product-image.nv-same-image-height'] = [
			'flex-basis' => self::THUMBNAIL_WIDTH,
		];
		$subscribers['.nv-product-content'] = [
			'padding' => [
				'key'    => self::BOX_SHADOW_INTENTISITY,
				'filter' => function ( $css_prop, $value, $meta, $device ) {
					return 'padding: 15px;';
				},
			],
		];

		return $subscribers;
	}
}
