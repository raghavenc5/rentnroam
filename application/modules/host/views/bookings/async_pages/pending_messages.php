<?php
if (! $pendingMessages) {
?>

<table class="table table-condensed">
    <tbody>
        <tr>
            <td align="center">No Messages Found</td>
        </tr> 
    </tbody>
</table>

<?php
} else {
?>

<table class="table table-condensed">
    <tbody>

<?php
    foreach ($pendingMessages as $key => $thisPendingMessage) {
?>

        <tr>
            <th>
                <i class="fa fa-stop"></i>
            </th>
            <td>
                <p class="name"><?php echo $thisPendingMessage->sender_full_name; ?></p>
                <p class="time"><?php echo $thisPendingMessage->sent_on; ?></p>
                <p><?php echo filterDbOutput($thisPendingMessage->message);?></p>
            </td>
            <td class="status">
                <p class="declined"><?php echo $thisPendingMessage->status; ?></p>
            </td>
        </tr>

<?php
    }
?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"><?php echo $pendingMessagesPageLinks; ?></td>
        </tr>
    </tfoot>
</table>

<?php
}
?>

