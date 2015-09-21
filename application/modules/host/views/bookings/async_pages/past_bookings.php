<?php
if (! $pastBookings) {
?>

<table class="table table-condensed">
    <tbody>
        <tr>
            <td align="center">No Past Bookings Found</td>
        </tr> 
    </tbody>
</table>

<?php
} else {
?>

<table class="table table-condensed">
    <thead>
        <tr>
            <td>ID</td>
            <td>Applied On</td>
            <td>Applied By</td>
            <td>Tenure</td>
            <td>Guest Count</td>
            <td>Booking Status</td>
        </tr>
    </thead>
    <tbody>

    <?php
        foreach ($pastBookings as $key => $thisPastBooking) {
    ?>

        <tr>
            <td><?php echo $thisPastBooking->id; ?></td>
            <td><?php echo $thisPastBooking->applied_on; ?></td>
            <td><?php echo $thisPastBooking->applied_by; ?></td>
            <td><?php echo $thisPastBooking->tenure; ?></td>
            <td><?php echo $thisPastBooking->guest_count; ?></td>
            <td><?php echo $thisPastBooking->status; ?></td>
        </tr>

    <?php
        }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6"><?php echo $pastBookingPageLinks; ?></td>
        </tr>
    </tfoot>
</table>

<?php
}
?>