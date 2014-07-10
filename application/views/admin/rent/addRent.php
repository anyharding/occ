<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
$(function() {
    $( "#due_date" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        yearRange:"-90:+0",
        maxDate: new Date(2500, 0, 1),
        changeYear: true
    }); 
    $( "#payment_date" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        yearRange:"-90:+0",
        maxDate: new Date(2500, 0, 1),
        changeYear: true
    });     
$('#house').change(function(e) {
        $('#fill').load('<?php echo HTTP_PATH;?>admin/users/getRent/'+this.value);
    });        
});
</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Add New Rent</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <div class="Block table">
                    	<div class="BlockContent">
		                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                      <tr>
                        <th>Add Rent</th>
                      </tr>
			<tr><td colspan="2" align="center">
			
			<?php
			    if(validation_errors()  || $this->session->userdata('message')  || $this->session->flashdata('message')){ ?>
					  <div class='ActionMsgBox error' id='msgID'>
					  	<?php
					  		echo validation_errors();
					  		echo $this->session->userdata('message');
					  		echo $this->session->flashdata('message');
					  		$this->session->unset_userdata('message');
					  	?>
					  </div>
			  <?php } ?>
                                <?php
                            if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
                            <div class='ActionMsgBox success' id='msgID'>
                                <?php
                                            echo $this->session->userdata('smessage');
                                            echo $this->session->flashdata('smessage');
                                            $this->session->unset_userdata('smessage');
                                    ?>
                            </div>
                            <?php } ?>
			</td></tr>
					  <tr>
                        <td>
                        <?php
                             echo form_open_multipart('admin/rent/addRent', array('name'=>'myform'));?>
                            <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="200">Select House <span class="required">*</span>:</td>
                                <td><?php $get_houses[''] = "Select house"; echo form_dropdown('house', $get_houses, $this->input->post('house'), "id = 'house'"); ?> </td>
                              </tr>
                              <tr>
                                <td>Payment Amount ($) : <font color="red">*</font></td>
                                <td><?php
                                        $data = array('name'   => 'amount',
                                            'value'  => set_value("amount")
                                            );
                                        echo form_input($data); 
                                        ?>
                                </td>
                              </tr> 
                              <tr>
                                <td width="200">Payment Date <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array('name'  => 'payment_date',
                                            'id'  => 'payment_date',
                                            'value'       => set_value("payment_date")
                                            );
                                        echo form_input($data); 
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Rent Due Date <span class="required">*</span>:</td>
                                <td id="fill"><?php
                                        $data = array('name'  => 'due_date',
                                            'id'  => 'due_date',
                                            'value'       => set_value("due_date")
                                            );
                                        echo form_input($data); 
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td><input type="image" src="<?php echo HTTP_PATH.'img/submitBtn.png';?>"> &nbsp;
                                    <img onclick="document.myform.reset();return false;" src="<?php echo HTTP_PATH.'img/reset.png';?>" width="108" height="39">
                                
                                </td>

                              </tr>
                               
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>
			<?php echo form_close();?>
                        </td>
                      </tr>                      
                    </table>
                    	</div>
                    </div>
                    </td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
</td>
  </tr>
  <tr>
