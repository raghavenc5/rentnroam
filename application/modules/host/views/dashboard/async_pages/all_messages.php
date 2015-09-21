<table class="table table-condensed">
    <tbody>
        <?php
        if ($messages) {
            foreach ($messages as $key => $thisMessageData) {
        ?>

        <tr>
            <th>
                <i class="fa fa-stop"></i>
            </th>
            <td>
                <p class="name"><?php echo isset($thisMessageData->sender_full_name) ? filterDbOutput($thisMessageData->sender_full_name) : 'Not Found'; ?></p>
                <p class="time"><?php echo isset($thisMessageData->sent_on) ? $thisMessageData->sent_on: 'Not Given'; ?></p>
            </td>
            <td class="address">
                <p><?php echo isset($thisMessageData->message) ? nl2br(filterDbOutput($thisMessageData->message)) : 'Not Given'; ?></p>
            </td>
            <td class="status">
                <p class="declined"><?php echo $thisMessageData->status ? $thisMessageData->status : 'Not Given'; ?></p>
            </td>
        </tr>

        <?php
            }
        } else {
        ?>

        <tr>
            <th>
                <i class="fa fa-stop"></i>
            </th>
            <td colspan="3">
                <p class="name">No messages were found</p>
            </td>
        </tr>

        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"><?php echo $messagePageLinks; ?></td>
        </tr>
    </tfoot>
</table>