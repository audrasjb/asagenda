<?php

/**
 * Widgets.
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
			'description' => 'Display the list of your upcoming AsAgenda events.',
		);
		// Instantiate the parent object
		parent::__construct( 'asagenda_widget_list', 'Agenda list view', $widget_ops );
	}
	function widget( $args, $instance ) {
		$nbEvents = isset($instance['nbevents']) ? $instance['nbevents'] : '';
		if ( empty($nbEvents) ) : $nbEvents = 1; endif;
		echo '<section id="asagenda-list" class="widget widget_asagenda_list">';
		echo '<h2 class="widget-title asagenda-widget-title">' . __('Agenda', 'asagenda') . '</h2>';
		$argsAsAgenda = array(
			'post_type'	=>	'asagenda',
			'posts_per_page' => $nbEvents,
		);
		$queryAsAgenda = new WP_Query($argsAsAgenda);
		if ( $queryAsAgenda->have_posts() ) :
			echo '<ul class="asgenda-widget-list">';
			while ( $queryAsAgenda->have_posts() ) :
				$queryAsAgenda->the_post();
				$dateStart = get_post_meta( get_the_ID(), 'asagenda_date_start', true );
				$dateEnd = get_post_meta( get_the_ID(), 'asagenda_date_end', true );
				echo '<li>';
				echo '<a href=" ' . get_permalink() . ' ">';
				echo '<h3>' . get_the_title() . '</h3>';
				echo '<p>Start: ' . $dateStart . ' – End: ' . $dateEnd . '</p>';
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
		$nbEvents = isset($instance['nbevents']) ? $instance['nbevents'] : '';
    	?>
		<p>
    	    <label for="<?php echo $this->get_field_name( 'nbevents' ); ?>"><?php _e( 'Maximal number of events to display' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'nbevents' ); ?>" name="<?php echo $this->get_field_name( 'nbevents' ); ?>" type="number" value="<?php echo $nbEvents; ?>" />
    	</p>
		<?php
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'AsAgenda_list' );
});
   