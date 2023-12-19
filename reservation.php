<?php
/*
Plugin Name: Réservation de Créneaux
Description: Permet la réservation de créneaux.
Version: 1.0
Author: Votre nom
*/

function reserver_creneaux_form() {
    require_once plugin_dir_path(__FILE__) . 'models/reservation.php';
    require_once plugin_dir_path(__FILE__) . 'controllers/reservation_controller.php';
    
    $model = new ReservationModel();
    $controller = new ReservationController($model);
    
    $message = $controller->handle_form_submission();
    
    ob_start();
    include plugin_dir_path(__FILE__) . 'views/reservation_form.php';
    return ob_get_clean();
}

add_shortcode('reserver_creneaux', 'reserver_creneaux_form');


function reserver_creneaux_activate() {
    require_once plugin_dir_path(__FILE__) . 'models/reservation.php';
    $model = new ReservationModel();
    $model->create_table();
}
register_activation_hook(__FILE__, 'reserver_creneaux_activate');

function reserver_creneaux_deactivate() {
    // Ici, code qui s'éxécute à la désactivation du plugin
}
register_deactivation_hook(__FILE__, 'reserver_creneaux_deactivate');


function reserver_creneaux_admin_menu() {
    add_menu_page('Gestion des Réservations', 'Réservations', 'manage_options', 'reservations-list', 'render_reservations_page', 'dashicons-calendar-alt', 6);
}

function render_reservations_page() {
    require_once plugin_dir_path(__FILE__) . 'models/reservation.php';
    require_once plugin_dir_path(__FILE__) . 'controllers/reservation_controller.php';
    
    $model = new ReservationModel();
    $controller = new ReservationController($model);

    $controller->list_reservations();
}

add_action('admin_menu', 'reserver_creneaux_admin_menu');



;?>




