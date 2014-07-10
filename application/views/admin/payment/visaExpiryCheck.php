<script>
    checked = false;
    function checkedAll () {
            if (checked == false){checked = true}else{checked = false}
            for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
                document.getElementById('myform').elements[i].checked = checked;
            }
    }
    function submitform()
    {
            document.forms["myform"].submit();
    }
    function submitform1()
    {
            document.forms["myform"].action = "<?php  if($this->uri->segment(3) == 'advOwners') echo base_url().'admin/applicant/deactivateallpoweruser/advOwners'; else echo base_url().'admin/applicant/deactivateallPoweruser'; ?>";
            document.forms["myform"].submit();
    }
    function submitform2()
    {
            document.forms["myform"].action = "<?php  echo base_url().'admin/payment/deleteallPayment'; ?>";
            document.forms["myform"].submit();
    }
    
</script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"> </script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery.tablesorter.js"> </script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/sort_style.css'; ?>" type="text/css" />
<script type="text/javascript">

$(document).ready(function() 
    { 
        $("#ListTable").tablesorter();
    }   
); 

</script>

<script>
$(document).ready(function(){
    $('#14days').click(function(e) {
        window.location = "<?php echo HTTP_PATH."admin/payment/visaExpiryCheck/14days" ?>";
    });
    $('#30days').click(function(e) {
        window.location = "<?php echo HTTP_PATH."admin/payment/visaExpiryCheck/30days" ?>";
    });
    $('#60days').click(function(e) {
        window.location = "<?php echo HTTP_PATH."admin/payment/visaExpiryCheck/60days" ?>";
    });
});

</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
            <td class="breadcrumb">Administrator > Visa Expiry Check Management</td>
            <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="9" height="70" valign="middle">
      <div class="Block table">
              <div class="BlockContent">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                <tr>
                  <th>Please Select Option</th>
                </tr>
                <tr>
                  <td align="left" height="80">
                    <?php
                    $array = array('selected'=>'selected');
                    if($this->uri->segment(4) == '14days'){  $four = true;$three = NULL; $six = NULL;}
                    if($this->uri->segment(4) == '30days'){  $four = NULL;$three = true; $six = NULL;}
                    if($this->uri->segment(4) == '60days'){  $four = NULL;$three = NULL; $six = true;}
                    else if($this->uri->segment(4) <> '60days' and $this->uri->segment(4) <> '14days' and $this->uri->segment(4) <> '30days' ) { $four = NULL;$three = NULL; $six = NULL;}
                    echo form_radio('type', '14days', $four, "id='14days'");?>Expiry date + 14 days &nbsp;
                    <?php echo form_radio('type', '30days', $three, "id='30days'"); ?>Expiry date + 30 days &nbsp;
                    <?php echo form_radio('type', '60days', $six, "id='60days'");?>Expiry date + 60 days
                </td>
                </tr>                      
              </table>
              </div>
          </div>
        </td>
    </tr>
    <tr>
      <td class="paging"><?php  echo $this->pagination->create_links(); ?></td>
    </tr>
    <tr>
      <td colspan="9"><?php
      
			    if(validation_errors()  || $this->session->userdata('message')|| $this->session->flashdata('message')){ ?>
        <div class='ActionMsgBox error' id='msgID' style='margin:10 10 0 0;margin-top: 10px;'>
          <?php
					  		echo validation_errors();
					  		echo $this->session->flashdata('message');
					  	?>
        </div>
        <?php }       
        ?>
      <?php
                            if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
                            <div class='ActionMsgBox success' id='msgID'>
                                <?php //
                                            echo $this->session->userdata('smessage');
                                            echo $this->session->flashdata('smessage');
                                            $this->session->unset_userdata('smessage');
                                    ?>
                            </div>
                            <?php } ?>
      </td>
    </tr>
    <?php
    if(!empty($users)) {
                  ?>
    <tr>
      <td><?php echo form_open('/admin/applicant/activateallpoweruser', array('id'=>'myform'));?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="ListTable">
                <thead>
                  <tr>
                    <th width="15%" class="bl">Employee ID</th>
                    <th width="15%" class="bl">Employee Name</th>
                    <th width="17%" class="bl">Email</th>
                    <th width="13%" class="bl">Place of work</th>
                    <th width="13%" class="bl">Phone No</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
			$i=0;
			foreach($users as $row){
                                ?>
                  <tr>
                    <td width="14%" class="bl"><?php echo $row->id;?></td>
                   <td width="14%" class="bl"><?php echo $row->lastname.', '.$row->firstname;?></td>
                    <td width="17%" class="bl"><?php echo $row->email;?></td>
                    <td width="13%" class="bl"><?php echo $this->user_model->getWorksiteCompName($row->worksite_id);?></td>
                    <td width="13%" class="bl"><?php echo $row->contact_no;?></td>
                  </tr>
                  <?php
			}?>
                </tbody>
              </table></td>
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="0" class="NoDataTable">
                <tr>
                  <!--td align="left"><a href="javascript: submitform()"><img src="<?php echo HTTP_PATH; ?>img/activeBtn.png" width="109" height="42"></a></td>
                  <td align="left"><a href="javascript: submitform1()"><img src="<?php echo HTTP_PATH; ?>img/deactiveBtn.png" width="107" height="41"></a></td-->
                  </tr>
              </table>
              <?php echo form_close(); ?></td>
          </tr>
          <?php
                  }else {
                  ?>
          <tr>
            <td colspan="9" align="center"><img style="margin-top: 20px;" src="<?php echo HTTP_PATH;?>img/no-record.jpg"></td>
          </tr>
          <?php
                  }
                  ?>
        </table></td>
    </tr>
  </table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr> 