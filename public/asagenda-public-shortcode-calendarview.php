<?php

/**
 * Shortcode for calendar view.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 */

/**
 * Shortcode for calendar view.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 * @author     audrasjb <audrasjb@gmail.com>
 */

 	function asagenda_shortcode_calendar_init() {
 		function asagenda_shortcode_calendarview( $atts ) {
			$atts = shortcode_atts(
				array(
					'number' => -1,
				),
				$atts,
				'asagenda-calendar'
			);
			$asagendaNumber = $atts['number'];
			$asAgendaListView = '';
			$asAgendaListView .= '<section id="asagenda-list" class="asagenda-shortcode-calendarview">';
			$currentDate = date('Ymd');
			$argsAsAgenda = array(
				'post_type'	=>	'asagenda',
				'posts_per_page' => -1,
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
				$arrayEvents = array();
				while ( $queryAsAgenda->have_posts() ) :
					$queryAsAgenda->the_post();
					$dateStart = get_post_meta( get_the_ID(), 'asagenda_date_start', true );
					$dateStartFormatted = date_i18n( 'Y-m-d', strtotime( $dateStart ) );
					$dateEnd = get_post_meta( get_the_ID(), 'asagenda_date_end', true );
					$dateEndFormatted = date_i18n( 'Y-m-d', strtotime( $dateEnd ) );
					$colorPicker = get_post_meta( get_the_ID(), 'asagenda_colorpicker', true );
					if (empty($colorPicker)) : $colorPicker = '#dddddd'; endif;
					if ( $dateStartFormatted == $dateEndFormatted ) : $dateEndFormatted = ''; endif;
					$eventTitle = get_the_title();
					$eventID = get_the_title();
					$eventPermalink = get_permalink();
					$arrayEvents['monthly'][] = array( 
						'id' => $eventID, 
						'name' => $eventTitle, 
						'startdate' => $dateStartFormatted, 
						'enddate' => $dateEndFormatted, 
						'starttime' => '',
						'endtime' => '',
						'color' => $colorPicker,
						'url' => $eventPermalink
					);
				endwhile;
				$jsonEvents = json_encode($arrayEvents);
				$asAgendaListView .= '<script>var asagendaJsonEvents = ' . $jsonEvents . ';</script>';
				$asAgendaListView .= '<div id="asagenda-shortcode-calendarview-container" class="monthly"></div>';
				$asAgendaListView .= '</section>';
				return $asAgendaListView;
			endif;
		}
		add_shortcode( 'asagenda-calendar', 'asagenda_shortcode_calendarview' );
	}
	add_action('init', 'asagenda_shortcode_calendar_init');