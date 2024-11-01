<?php
/*
Plugin Name: WCP Collective Ads Widget
Plugin URI: http://webcomicplanet.com/forum/wcpc-ads-widget
Description: An plugin to put the collective images on in a widget for the sidebar.
Contributors: frumph
Author: Philip M. Hofer (Frumph)
Version: 1.4
Author URI: http://frumph.net
*/ 

/*  Copyright 2010  Philip M. Hofer  (email : philip@frumph.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class wcp_collective_ads_widget extends WP_Widget {


	function wcp_collective_ads_pluginfo($whichinfo = null) {
		global $wcp_collective_ads_pluginfo;
		if (empty($comicpress_themeinfo) || $whichinfo == 'reset') {
			// need to create this config. NOW.
			$wcp_collective_ads_pluginfo = '';
			$wcp_collective_ads_coreinfo = wp_upload_dir();
			$wcp_collective_ads_addinfo = array(
					'themeurl' => get_template_directory_uri(),
					'themepath' => get_template_directory(),
					'styleurl' => get_stylesheet_directory_uri(),
					'stylepath' => get_stylesheet_directory(),
					'plugindir' => plugin_dir_url(dirname (__FILE__)) . 'wcp-collective-ads-widget',
					'pluginurl' => get_option('siteurl') . '/wp-content/plugins/wcp-collective-ads-widget'
			);
			$wcp_collective_ads_pluginfo = array_merge($wcp_collective_ads_coreinfo, $wcp_collective_ads_addinfo);
		}
		if ($whichinfo) return $wcp_collective_ads_pluginfo[$whichinfo];
		return $wcp_collective_ads_pluginfo;
	}

	function wcp_collective_ads_widget() {
		$widget_ops = array('classname' => __CLASS__, 'description' => 'A widget that displays book advertisements.' );
		$this->WP_Widget(__CLASS__, 'WCP Collective Ads Widget', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };  
		$randomnum = rand(1,5);
		?>
		<div class="wcp-ad">
		<?php switch (intval($randomnum)) { 
			case 1: ?>
				<a href="https://www.createspace.com/3468027" target="blank"><img src="<?php echo $this->wcp_collective_ads_pluginfo('pluginurl'); ?>/images/WG_book_ad_160x300.jpg" /></a>
			<?php break;
			case 2: ?>
				<a href="http://th3rdworld.com/store/index.php?main_page=product_info&cPath=2&products_id=15"><img src="<?php echo $this->wcp_collective_ads_pluginfo('pluginurl'); ?>/images/dadad.jpg" /></a>
				<?php break;
			case 3: ?>
				<a href="http://www.lulu.com/product/paperback/forsaken-stars-%231-constituo-theatrum/6433756"><img src="<?php echo $this->wcp_collective_ads_pluginfo('pluginurl'); ?>/images/FS1_book_ad2_160x300.jpg" /></a>
				<?php break;
			case 4: ?>
				<a href="http://lore.greeblegraphics.com/buy/"><img src="<?php echo $this->wcp_collective_ads_pluginfo('pluginurl'); ?>/images/lore.gif" /></a>
				<?php break;
			case 5: ?>
				<a href="http://www.indyplanet.com/store/advanced_search_result.php?keywords=ginpu&osCsid=mdet56ornq787jab2v20b7tc40"><img src="<?php echo $this->wcp_collective_ads_pluginfo('pluginurl'); ?>/images/ginpuwidgetad.png" /></a>
				<?php break;
			default: ?>
			NOTHING HERE.
			<?php break; ?>
		<?php } ?>
			<div class="frumph-link" style="text-align:center;"><a href="http://frumph.net/2010/webcomic-planet/wcp-collective-ads-widget-revived/">Get Ad'd</a></div>
		</div>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
	}
}

add_action( 'widgets_init', create_function('', 'return register_widget("wcp_collective_ads_widget");') );


?>