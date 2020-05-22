<?php
/**
 * File that handle dynamic css for Scroll to top integration.
 *
 * @package Neve_Pro\Modules\Scoll_To_Top
 */

namespace Neve_Pro\Modules\Scroll_To_Top;


use Neve_Pro\Core\Generic_Style;

/**
 * Class Dynamic_Style
 *
 * @package Neve_Pro\Modules\Scoll_To_Top
 */
class Dynamic_Style extends Generic_Style {
	const ICON_TOP_COLOR              = 'neve_scroll_to_top_icon_color';
	const ICON_BACKGROUND_COLOR       = 'neve_scroll_to_top_background_color';
	const ICON_TOP_COLOR_HOVER        = 'neve_scroll_to_top_icon_hover_color';
	const ICON_BACKGROUND_COLOR_HOVER = 'neve_scroll_to_top_background_hover_color';

	const ICON_BORDER_RADIUS = 'neve_scroll_to_top_border_radius';
	const ICON_SIZE          = 'neve_scroll_to_top_icon_size';

	/**
	 * Add dynamic style subscribers.
	 *
	 * @param array $subscribers Css subscribers.
	 *
	 * @return array|mixed
	 */
	public function add_subscribers( $subscribers = [] ) {

		$subscribers['div.scroll-to-top']       = [
			'color'            => self::ICON_TOP_COLOR,
			'border-radius'    => self::ICON_BORDER_RADIUS,
			'background-color' => self::ICON_BACKGROUND_COLOR,
		];
		$subscribers['div.scroll-to-top:hover'] = [
			'color'            => self::ICON_TOP_COLOR_HOVER,
			'background-color' => self::ICON_BACKGROUND_COLOR_HOVER,
		];
		$subscribers['.scroll-to-top-icon']     = [
			'width'  => [
				'key'           => self::ICON_SIZE,
				'is_responsive' => true,
			],
			'height' => [
				'key'           => self::ICON_SIZE,
				'is_responsive' => true,
			],
		];

		return $subscribers;
	}
}
