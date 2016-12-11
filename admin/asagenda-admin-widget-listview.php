<?php

/**
 * List view widget.
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

class AsAgenda_list extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 'asagenda_widget_list',
			'description' => __('Display the list of your upcoming AsAgenda events.', 'asagenda'),
		);
		// Instantiate the parent object
		parent::__construct( 'asagenda_widget_list', __('Agenda list view', 'asagenda'), $widget_ops );
	}
	function widget( $args, $instance ) {
		$asagendaTitle = isset($instance['asagenda_title']) ? $instance['asagenda_title'] : __('Agenda', 'asagenda');
		$asagendaNumber = isset($instance['asagenda_nbevents']) ? $instance['asagenda_nbevents'] : -1;
		echo '<section id="asagenda-list" class="widget widget_asagenda_list">';
		echo '<h2 class="widget-title asagenda-widget-title">' . $asagendaTitle . '</h2>';
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
			echo '<ul class="asgenda-widget-list">';
			while ( $queryAsAgenda->have_posts() ) :
				$queryAsAgenda->the_post();
				$dateStart = get_post_meta( get_the_ID(), 'asagenda_date_start', true );
				$dateStartFormatted = date_i18n( get_option( 'date_format' ), strtotime( $dateStart ) );
				$dateEnd = get_post_meta( get_the_ID(), 'asagenda_date_end', true );
				$dateEndFormatted = date_i18n( get_option( 'date_format' ), strtotime( $dateEnd ) );
				echo '<li>';
				echo '<a href=" ' . get_permalink() . ' ">';
				echo '<h3>' . get_the_title() . '</h3>';
				if ( $dateStart == $dateEnd ) : 
					echo '<p class="asagenda-widget-date">' . $dateStartFormatted . '</p>';
				else : 
					echo '<p class="asagenda-widget-date"> ' . __('From', 'asgenda') . ' ' . $dateStartFormatted . ' ' . __('to', 'asagenda') . ' ' . $dateEndFormatted . '</p>';
				endif;
				echo '</a>';
				echo '</li>';
			endwhile;
			echo '</ul>';
		else : 
			echo '<p class="asagenda-widget-noeventfound"> ' . __('No upcoming event', 'asagenda') . ' </p>';
		endif;
		echo '</ul>';
		echo '</section>';
	}
	function form( $instance ) {
		// Output admin widget options form
		$asagendaTitle = isset($instance['asagenda_title']) ? $instance['asagenda_title'] : __('Agenda', 'asagenda');
		$asagendaNumber = isset($instance['asagenda_nbevents']) ? $instance['asagenda_nbevents'] : '-1';
    	?>
		<p>
    	    <label for="<?php echo $this->get_field_name( 'asagenda_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'asagenda_title' ); ?>" name="<?php echo $this->get_field_name( 'asagenda_title' ); ?>" type="text" value="<?php echo $asagendaTitle; ?>" />
    	</p>
		<p>
    	    <label for="<?php echo $this->get_field_name( 'asagenda_nbevents' ); ?>"><?php _e( 'Number of events to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'asagenda_nbevents' ); ?>" name="<?php echo $this->get_field_name( 'asagenda_nbevents' ); ?>" type="number" value="<?php echo $asagendaNumber; ?>" size="3" min="-1" />
			<br /><small><?php _e( 'Use <code>-1</code> if you want to show all upcoming events.', 'asagenda' ); ?></small>
    	</p>
		<?php
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'AsAgenda_list' );
});
   