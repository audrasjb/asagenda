<?php

/**
 * Calendar view widget.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 */

/**
 * The specifics admin widgets of the plugin.
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */

class AsAgenda_calendar extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 'asagenda_widget_calendar',
			'description' => __('Display the calendar of your upcoming AsAgenda events.', 'asagenda'),
		);
		// Instantiate the parent object
		parent::__construct( 'asagenda_widget_calendar', __('Agenda calendar view', 'asagenda'), $widget_ops );
	}
	function widget( $args, $instance ) {
		$asagendaTitle = isset($instance['asagenda_title']) ? $instance['asagenda_title'] : __('Calendar', 'asagenda');
		echo '<section id="asagenda-calendar" class="widget widget_asagenda_calendar">';
		echo '<h2 class="widget-title asagenda-widget-title">' . $asagendaTitle . '</h2>';
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
				if ( $dateStartFormatted == $dateEndFormatted ) : $dateEndFormatted = ''; endif;
				$colorPicker = get_post_meta( get_the_ID(), 'asagenda_colorpicker', true );
				if (empty($colorPicker)) : $colorPicker = '#dddddd'; endif;
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
			echo '<script>var asagendaJsonEvents = ' . $jsonEvents . ';</script>';
			echo '<div id="asagenda-widget-calendar-container" class="monthly"></div>';
		endif;
		echo '</section>';
	}
	function form( $instance ) {
		// Output admin widget options form
		$asagendaTitle = isset($instance['asagenda_title']) ? $instance['asagenda_title'] : __('Calendar', 'asagenda');
    	?>
		<p>
    	    <label for="<?php echo $this->get_field_name( 'asagenda_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'asagenda_title' ); ?>" name="<?php echo $this->get_field_name( 'asagenda_title' ); ?>" type="text" value="<?php echo $asagendaTitle; ?>" />
    	</p>
		<?php
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'AsAgenda_calendar' );
});
   