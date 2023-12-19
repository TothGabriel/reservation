<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h2>Liste des Réservations</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Créneau</th>
                <th>Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation->id; ?></td>
                    <td><?php echo $reservation->date; ?></td>
                    <td><?php echo $reservation->timeslot; ?></td>
                    <td><?php echo get_userdata($reservation->user_id)->display_name; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
