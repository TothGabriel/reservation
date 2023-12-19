<?php 
class ReservationController {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function handle_form_submission() {
        $message = '';
        if(isset($_POST['submit_reservation'])) {
            $date = sanitize_text_field($_POST['reservation_date']);
            $timeslot = sanitize_text_field($_POST['timeslot']);
            $user_id = get_current_user_id();
    
            if(!$this->model->is_timeslot_taken($date, $timeslot)) {
                $this->model->insert_reservation($date, $timeslot, $user_id);
                $this->send_email_to_admin($date, $timeslot);
                $message = 'Réservation effectuée avec succès!';
            } else {
                $message = 'Ce créneau est déjà réservé!';
            }
        }
        return $message;
    }
    
    private function send_email_to_admin($date, $timeslot) {
        $to = get_bloginfo('admin_email');
        $subject = 'Nouvelle Réservation';
        $message = "Une nouvelle réservation a été effectuée pour le $date à $timeslot.";
        
        wp_mail($to, $subject, $message);
    }
    

    public function list_reservations() {
        $reservations = $this->model->get_all_reservations();
        
        require_once plugin_dir_path(dirname(__FILE__)) . 'views/list_reservations.php';
    }
    

}



?>