<?php

/**
 * The specifics admin metaboxes of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 */

/**
 * The specifics admin metaboxes of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */
class asagenda_Admin_Metaboxes {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta	The post meta data.
	 */
	private $meta;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//$this->set_meta();

	}

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function asagenda_Add_Metaboxes() {
		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
	
		add_meta_box(
			'asagenda_dates_metabox', 
			__('Start &amp; End dates'), 
			'asagenda_Create_Dates_Metabox', 
			'agenda', 
			'side', 
			'high'
		);

	}


	private function asagenda_Create_Dates_Metabox( $post ) {
		
		// Afficher les dates déjà enregistrées (le cas échéant).
		$dateStart = get_post_meta( $post->ID, 'asagenda_date_start', true );
		$dateEnd = get_post_meta( $post->ID, 'asagenda_date_end', true );
 
		// Utilisation de Nonce pour la vérification des champs (sécurité)
		wp_nonce_field( plugin_basename(__FILE__), 'asagenda_metabox_nonce');
		
		// Opérations sur les dates pour obtenir un format de comparaison
		$today = date('Ymd');
		if ($dateEnd != '') {
			if ($today > $dateEnd) {
	    		// C'est fini
				echo '<p style="color: #c00;">Ce contenu ne s\'affiche plus sur le site car sa date de fin est inférieure à celle d\'aujourd\'hui.<br /><br />Vous pouvez modifier ces dates si vous le souhaitez.</p>';
	    	} else {
	    		// C'est encore d'actualité
				echo '<p style="color: #0c0;">Ce contenu est actuellement affiché sur le site. Vous pouvez modifier les dates de début et de fin à volonté.</p>';
	    	}
		}
		?>
		<p>Date de début : <br /><input id="date-start" name="date-start" type="text" value="<?php if ($dateStart) { echo substr($dateStart,6,2).'/'.substr($dateStart,4,2).'/'.substr($dateStart,0,4); } ?>" /></p>
		<p>Date de fin : <br /><input id="date-end" name="date-end" type="text" value="<?php if ($dateEnd) { echo substr($dateEnd,6,2).'/'.substr($dateEnd,4,2).'/'.substr($dateEnd,0,4); } ?>" /></p>
		<p style="font-style: italic; color: #777;">La date de fin est utilisée pour l'arrêt de l'affichage du contenu sur le site.</p>
		<?php
	}

	// Enregistrer les valeurs saisies.
	public function asagenda_Save_Dates_Metabox($post_id) {
 		// Vérifier si la méta existe. Sinon, et bien on va l'ajouter !
 		// on utilise d'abord add_post_meta, qui s'exécute uniquement si la méta n'existe pas encore pour ce contenu, dans la BDD
 		$dateStart = $_POST['date-start'];
 		$formatedDateStart = explode("/", $dateStart);
 		$formatedDateStart = $formatedDateStart[2].$formatedDateStart[1].$formatedDateStart[0];
 		add_post_meta($post_id, 'asagenda_date_start', $formatedDateStart, true);
 		update_post_meta($post_id, 'asagenda_date_start', $formatedDateStart);

 		$dateEnd = $_POST['date-end'];
 		$formatedDateEnd = explode("/", $dateEnd);
 		$formatedDateEnd = $formatedDateEnd[2].$formatedDateEnd[1].$formatedDateEnd[0];
 		add_post_meta($post_id, 'asagenda_date_end', $formatedDateEnd, true);
 		update_post_meta($post_id, 'asagenda_date_end', $formatedDateEnd);
 		
 		// 13/09/13 : ajout des variables destinées au tri des contenus
 		$formatedDateStartSort = explode("/", $datedebut);
 		$formatedDateStartSort = $formatedDateStartSort[2].$formatedDateStartSort[1].$formatedDateStartSort[0];
 		add_post_meta($post_id, 'asagenda_date_start_sort', $formatedDateStartSort, true);
 		update_post_meta($post_id, 'asagenda_date_start_sort', $formatedDateStartSort);
	}


}