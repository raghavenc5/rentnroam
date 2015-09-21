<?php
if (! $viewedMessages) {
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
    $statusClassMap = array(
        'inquiry' => 'inquiry',
        'accepted' => 'accepted',
        'declined' => 'declined',
    );
?>

<table class="table table-condensed">
    <tbody>

<?php
    foreach ($viewedMessages as $key => $thisViewedMessage) {
?>

        <tr>
            <th>
                <i class="fa fa-stop"></i>
            </th>
            <td>
                <p class="name"><?php echo $thisViewedMessage->sender_full_name; ?></p>
                <p class="time"><?php echo $thisViewedMessage->sent_on; ?></p>
                <p><?php echo filterDbOutput($thisViewedMessage->message);?></p>
            </td>
            <td class="status">
                <p class="<?php echo array_search($thisViewedMessage->status, $statusClassMap); ?>"><?php echo $thisViewedMessage->status; ?></p>
            </td>
        </tr>

<?php
    }
?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"><?php echo $viewMessagesPageLinks; ?></td>
        </tr>
    </tfoot>
</table>

<?php
}
?>