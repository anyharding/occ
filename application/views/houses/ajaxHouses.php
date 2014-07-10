<?php /* if (!empty($houses)) { ?>
  <div class="power_mode_listing_head">
  <div class="action">House Id</div>
  <div class="r_n white">Address </div>
  <div class="company">No Of Contractor in house</div>
  <div class="action">
  <?php
  if ($this->uri->segment(1) == 'houses' and ($this->uri->segment(2) == '' or $this->uri->segment(2) == 'index' or $this->uri->segment(2) == 'ajax_houses' )) {

  if ($this->session->userdata('rent_due_date')) {
  if ($this->session->userdata('rent_due_date') == 'asc') {
  ?><a style="font-size:13px; color: white; text-decoration: underline" onclick="$.post('<?php echo HTTP_PATH; ?>houses/ajax_houses/<?php echo $status; ?>/<?php echo $worksite_id; ?>/<?php echo $offset; ?>?order=desc', {'t' : 't', beforeSend: function() {
  $('#loading-image').show();
  }}, function(data){
  $('#middle-content').attr('innerHTML',data);$('#loading-image').hide();}); ;return false;" href="#">Rent Due Date <?php echo img('img/dwn.png'); ?></a>

  <?php
  } else {
  ?><a  style="font-size:13px; color: white; text-decoration: underline" onclick="$.post('<?php echo HTTP_PATH; ?>houses/ajax_houses/<?php echo $status; ?>/<?php echo $worksite_id; ?>/<?php echo $offset; ?>?order=asc', {'t' : 't', beforeSend: function() {
  $('#loading-image').show();
  }}, function(data){
  $('#middle-content').attr('innerHTML',data);$('#loading-image').hide();}); ;return false;" href="#">Rent Due Date <?php echo img('img/upp.png'); ?></a>
  <?php
  }
  } else {
  ?>
  <a style="font-size:13px; color: white; text-decoration: underline" onclick="$.post('<?php echo HTTP_PATH; ?>houses/ajax_houses/<?php echo $status; ?>/<?php echo $worksite_id; ?>/<?php echo $offset; ?>?order=asc', {'t' : 't', beforeSend: function() {
  $('#loading-image').show();
  }}, function(data){
  $('#middle-content').attr('innerHTML',data);$('#loading-image').hide();}); ;return false;" href="#">Rent Due Date <?php echo img('img/upp.png'); ?></a>

  <?php
  }
  } else {
  echo "Rent Due Date";
  }
  ?>
  </div>
  <div class="action">Action</div>

  </div>
  <?php
  $i = 0;
  foreach ($houses as $row) {
  ?>
  <div class="power_mode_listing">
  <div class="action"><?php echo anchor('/houses/viewHouse/' . $row->id . "/" . $row->realtor_account . "/" . $row->company_name . "/" . $row->realtor_name, $row->id, 'title = "View" class="hyperlink"'); ?></div>
  <div class="r_n">
  <?php
  if ($this->session->userdata('role') == 'poweruser')
  echo anchor('/houses/editHouse/' . $row->id . "/" . md5($row->id), $row->address, "class='hyperlink'");
  else
  echo $row->address;
  ?>
  </div>
  <div class="company">
  <?php
  if ($this->session->userdata('role') == 'poweruser')
  echo anchor('/users/employeeInHouse/' . $row->id, $this->house_model->noOfEmployees($row->id), 'class="hyperlink"');
  else
  echo $this->house_model->noOfEmployees($row->id);
  ?>
  </div>
  <div class="action"><?php if ($row->rent_due_date <> '') echo $row->rent_due_date; else echo "N/A"; ?></div>
  <div class="action">
  <?php
  if ($this->session->userdata('role') == 'poweruser') {
  echo anchor('/houses/editHouse/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit');
  }
  ?>
  <?php echo anchor('/houses/viewHouse/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View'); ?>
  <?php
  if ($this->session->userdata('role') == 'poweruser')
  echo anchor('/houses/deleteHouse/' . $row->id . "/" . md5($row->id), "<img width='14' src=" . HTTP_PATH . "img/delete.png" . "  border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')"));
  ?>
  </div>
  </div>
  <?php
  }
  } else {
  ?>
  <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg">
  <?php
  } */
?>
<!--<div class="pagination_new">
    <?php // echo $this->jquery_pagination->create_links(); ?>
</div>-->

<?php if (!empty($houses)) { ?>
    <div class="power_mode_listing_head">
        <div class="action">House Id</div>
        <div class="r_n white">Address </div>
        <div class="company">No Of Contractor in house</div>
        <div class="action">
            <?php
            if ($this->uri->segment(1) == 'houses' and ($this->uri->segment(2) == '' or $this->uri->segment(2) == 'index' or $this->uri->segment(2) == 'ajax_houses' )) {

                if ($this->session->userdata('rent_due_date')) {
                    if ($this->session->userdata('rent_due_date') == 'asc') {
                        ?><a style="font-size:13px; color: white; text-decoration: underline" onclick="$.post('<?php echo HTTP_PATH; ?>houses/ajax_houses/<?php echo $status; ?>/<?php echo $worksite_id; ?>/<?php echo $offset; ?>?order=desc', {'t' : 't', beforeSend: function() {
                                            $('#loading-image').show();
                                        }}, function(data){
                                        $('#middle-content').attr('innerHTML',data);$('#loading-image').hide();}); ;return false;" href="#">Rent Due Date <?php echo img('img/dwn.png'); ?></a>

                        <?php
                    } else {
                        ?><a  style="font-size:13px; color: white; text-decoration: underline" onclick="$.post('<?php echo HTTP_PATH; ?>houses/ajax_houses/<?php echo $status; ?>/<?php echo $worksite_id; ?>/<?php echo $offset; ?>?order=asc', {'t' : 't', beforeSend: function() {
                                    $('#loading-image').show();
                                }}, function(data){
                                $('#middle-content').attr('innerHTML',data);$('#loading-image').hide();}); ;return false;" href="#">Rent Due Date <?php echo img('img/upp.png'); ?></a>
                            <?php
                        }
                    } else {
                        ?>
                    <a style="font-size:13px; color: white; text-decoration: underline" onclick="$.post('<?php echo HTTP_PATH; ?>houses/ajax_houses/<?php echo $status; ?>/<?php echo $worksite_id; ?>/<?php echo $offset; ?>?order=asc', {'t' : 't', beforeSend: function() {
            $('#loading-image').show();
            }}, function(data){
            $('#middle-content').attr('innerHTML',data);$('#loading-image').hide();}); ;return false;" href="#">Rent Due Date <?php echo img('img/upp.png'); ?></a>

                    <?php
                }
            } else {
                echo "Rent Due Date";
            }
            ?>
        </div>
        <div class="action">Action</div>

    </div>
    <?php
    $i = 0;
    foreach ($houses as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="action"><?php echo anchor('/houses/viewHouse/' . $row->id . "/" . $row->realtor_account . "/" . $row->company_name . "/" . $row->realtor_name, $row->id, 'title = "View" class="hyperlink"'); ?></div> 
            <div class="r_n">
                <?php
                if ($this->session->userdata('role') == 'poweruser')
                    echo anchor('/houses/editHouse/' . $row->id . "/" . md5($row->id), $row->address, "class='hyperlink'");
                else
                    echo $row->address;
                ?>
            </div>
            <div class="company">
                <?php
                if ($this->session->userdata('role') == 'poweruser')
                    echo anchor('/users/employeeInHouse/' . $row->id, $this->house_model->noOfEmployees($row->id), 'class="hyperlink"');
                else
                    echo $this->house_model->noOfEmployees($row->id);
                ?>
            </div>
            <div class="action"><?php if ($row->rent_due_date <> '') echo $row->rent_due_date; else echo "N/A"; ?></div>
            <div class="action">
                <?php
                if ($this->session->userdata('role') == 'poweruser') {
                    echo anchor('/houses/editHouse/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit');
                }
                ?>
                <?php echo anchor('/houses/viewHouse/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View'); ?>
                <?php
                if ($this->session->userdata('role') == 'poweruser')
                    echo anchor('/houses/deleteHouse/' . $row->id . "/" . md5($row->id), "<img width='14' src=" . HTTP_PATH . "img/delete.png" . "  border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')"));
                ?>
            </div>
        </div>	
        <?php
    }
} else {
    ?>
    <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg">
    <?php
}
?>
<div class="pagination_new">
    <?php echo $this->jquery_pagination->create_links(); ?>
</div>