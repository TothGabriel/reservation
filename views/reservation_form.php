<div><?php echo $message; ?></div>
<form method="post">
    Sélectionnez une date: 
    <input type="date" name="reservation_date">
    
    Choisissez un créneau:
    <select name="timeslot">
        <?php for($hour=8; $hour<=17; $hour++): ?>
            <option value="<?php echo $hour; ?>:00"><?php echo $hour; ?>:00</option>
        <?php endfor; ?>
    </select>

    <input type="submit" name="submit_reservation" value="Réserver">
</form>
