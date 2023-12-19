<?php 

class ReservationModel {

    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function create_table() {
        $charset_collate = $this->wpdb->get_charset_collate();
        $table_name = $this->wpdb->prefix . 'reservations';

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            date date NOT NULL,
            timeslot varchar(50) NOT NULL,
            user_id mediumint(9) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function insert_reservation($date, $timeslot, $user_id) {
        $table_name = $this->wpdb->prefix . 'reservations';
        $this->wpdb->insert(
            $table_name,
            array(
                'date' => $date,
                'timeslot' => $timeslot,
                'user_id' => $user_id
            )
        );
    }

    public function is_timeslot_taken($date, $timeslot) {
        $table_name = $this->wpdb->prefix . 'reservations';
        $taken = $this->wpdb->get_var($this->wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE date = %s AND timeslot = %s",  // fct prepare sécurise les injections SQL 
            $date,
            $timeslot
        ));
        return $taken > 0;
    }
    public function get_all_reservations() {
        $table_name = $this->wpdb->prefix . 'reservations';
        return $this->wpdb->get_results("SELECT * FROM $table_name ORDER BY date, timeslot ASC");
    }
    


}




;?>
