<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">x</button>
  <!--<h3>Update Request for <?php /*echo $full_name*/?></h3>-->
</div>
<div class="modal-body">
  <form class="form-horizontal"  >
  <fieldset>
    <input type="hidden" name="request_user_id" id="request_user_id" value="<?php echo $user_id;?>" />
    <div class="control-group <?php echo (form_error('status') != '' ) ? 'error' : '';?>">
    <label class="control-label" for="focusedInput">Select Status : </label>
      <div class="controls">
        <label class="radio">
          <input type="radio" name="status" id="pending" value="Inactive" <?php echo ($status == 'Inactive') ? 'checked' : ''; ?>>								
          Pending
        </label>
        <div style="clear:both"></div>
        <label class="radio">
          <input type="radio" name="status" id="approved" value="Active"  <?php echo ($status == 'Active') ? 'checked' : ''; ?>>
          Approved
        </label>
      </div>
    </div>
  </fieldset>
  </form>		  
</div>
<div class="modal-footer">
  <a href="javascript:void(0)" onclick="change_status()" class="btn btn-primary">Save changes</a>
  <a href="#" class="btn" data-dismiss="modal">Close</a>				
</div>