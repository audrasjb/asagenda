<?php

/**
 * Shortcode for list view.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 */

/**
 * Shortcode for list view.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 * @author     audrasjb <audrasjb@gmail.com>
 */

 	function asagenda_shortcode_list_init() {
 		function asagenda_shortcode_listview( $atts ) {
			$atts = shortcode_atts(
				array(
					'number' => -1,
				),
				$atts,
				'asagenda-list'
			);
			$asagendaNumber = $atts['number'];
			$asAgendaListView = '';
			$asAgendaListView .= '<section id="asagenda-list" class="asagenda-shortcode-listview">';
			$currentDate = date('Ymd');
			$argsAsAgenda = array(
				'post_type'	=>	'asagenda',
				'posts_per_page' => $asagendaNumber,
				'post_status' => 'publish',
				'order'	=> 'ASC',
				'meta_query' => array(
					array(
						'key'     => 'asagenda_date_end',
						'value'   => $currentDate,
						'compare' => '>='
					)
				)
			);
			$queryAsAgenda = new WP_Query($argsAsAgenda);
			if ( $queryAsAgenda->have_posts() ) :
				$asAgendaListView .= '<ul class="asgenda-widget-list">';
				while ( $queryAsAgenda->have_posts() ) :
					$queryAsAgenda->the_post();
					$dateStart = get_post_meta( get_the_ID(), 'asagenda_date_start', true );
					$dateStartFormatted = date_i18n( get_option( 'date_format' ), strtotime( $dateStart ) );
					$dateStartFormattedUTC = date_i18n( 'c', strtotime( $dateStart ) );
					$dateEnd = get_post_meta( get_the_ID(), 'asagenda_date_end', true );
					$dateEndFormatted = date_i18n( get_option( 'date_format' ), strtotime( $dateEnd ) );
					$dateEndFormattedUTC = date_i18n( 'c', strtotime( $dateEnd ) );
					$asAgendaListView .= '<li itemscope itemtype="http://schema.org/Event">';
					$asAgendaListView .= '<meta itemprop="startDate" content="' . $dateStartFormattedUTC . '">';
					$asAgendaListView .= '<meta itemprop="endDate" content="' . $dateEndFormattedUTC . '">';
					$asAgendaListView .= '<a itemprop="url" href=" ' . get_permalink() . ' ">';
					$asAgendaListView .= '<h3 itemprop="name">' . get_the_title() . '</h3>';
					if ( $dateStart == $dateEnd ) : 
						$asAgendaListView .= '<p class="asagenda-widget-date">' . $dateStartFormatted . '</p>';
					else : 
						$asAgendaListView .= '<p class="asagenda-widget-date"> ' . __('From', 'asgenda') . ' ' . $dateStartFormatted . ' ' . __('to', 'asagenda') . ' ' . $dateEndFormatted . '</p>';
					endif;
					$asAgendaListView .= '</a>';
					$asAgendaListView .= '</li>';
				endwhile;
				$asAgendaListView .= '</ul>';
			else : 
				$asAgendaListView .= '<p class="asagenda-widget-noeventfound"> ' . __('No upcoming event', 'asagenda') . ' </p>';
			endif;
			$asAgendaListView .= '</section>';
			return $asAgendaListView;
		}
		add_shortcode( 'asagenda-list', 'asagenda_shortcode_listview' );
	}
	add_action('init', 'asagenda_shortcode_list_init');