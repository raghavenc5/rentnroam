<?php
if (! $upcomingBookings) {
?>

<table class="table table-condensed">
    <tbody>
        <tr>
            <td align="center">No Upcoming Bookings Found</td>
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
        foreach ($upcomingBookings as $key => $thisUpcomingBooking) {
    ?>

        <tr>
            <td><?php echo $thisUpcomingBooking->id; ?></td>
            <td><?php echo $thisUpcomingBooking->applied_on; ?></td>
            <td><?php echo $thisUpcomingBooking->applied_by; ?></td>
            <td><?php echo $thisUpcomingBooking->tenure; ?></td>
            <td><?php echo $thisUpcomingBooking->guest_count; ?></td>
            <td><?php echo $thisUpcomingBooking->status; ?></td>
        </tr>

    <?php
        }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6"><?php echo $upcomingBookingPageLinks; ?></td>
        </tr>
    </tfoot>
</table>

<?php
}
?>