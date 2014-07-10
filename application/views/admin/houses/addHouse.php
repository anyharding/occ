<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
$(function() {
    $( "#rent_due_date" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        yearRange:"-90:+0",
        maxDate: new Date(2500, 0, 1),
        changeYear: true
    });
});

$(document).ready(function(){
    $('#rent_payment_amount').keyup(function () {
        var amount = null;
        //alert($('input:radio[name=payment_cycle]:checked').val());
        if($('input:radio[name=payment_cycle]:checked').val()  == 'W') {
            amount = $('#rent_payment_amount').val();
            $('#rent').val(amount);
        }
        if($('input:radio[name=payment_cycle]:checked').val() == 'M') {
            amount = $('#rent_payment_amount').val()*(0.25);
            $('#rent').val(amount);
        }
        if($('input:radio[name=payment_cycle]:checked').val() == 'F') {
            amount = $('#rent_payment_amount').val()*(0.5);
            $('#rent').val(amount);
        }
        
    });
    var amount = null;
    $('#weekly').click(function(){
        amount = $('#rent_payment_amount').val();
        $('#rent').val(amount);
    });
    $('#monthly').click(function(){
        amount = $('#rent_payment_amount').val()*(0.25);
        $('#rent').val(amount);
    });
    $('#fornightly').click(function(){
        amount = $('#rent_payment_amount').val()*(0.5);
        $('#rent').val(amount);
    });
});
</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Add New House</td>
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
                        <th>Add House</th>
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
                             echo form_open_multipart('admin/houses/addHouse', array('name'=>'myform', 'id'=>'myform'));?>
                            <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                                 <tr>
                                <td width="200">Address of house :</td>
                                <td><?php
                                        $data = array(
                                            'name'       => 'address',
                                            'id'         => 'address',
                                            'cols'         => 5,
                                            'rows'         => 5,
                                            'value'      => $this->input->post('address')
                                        );
                                        echo form_textarea($data);
                                     ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Payment cycle: <font color="red"></font></td>
                                <td>
                                <?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('payment_cycle') == 'W'){  $fortnightly = NULL;$monthly = NULL;$weekly = true;}else if($this->input->post('payment_cycle') == 'F'){ $fortnightly = true;$monthly = NULL;$weekly = true; }else { $fortnightly = NULL;$monthly = true;$weekly = true;}
                                echo form_radio('payment_cycle', 'W', $weekly, 'id="weekly"');?>Weekly &nbsp;
                                <?php echo form_radio('payment_cycle', 'F', $fortnightly, 'id="fornightly"');?>Fortnightly<?php echo form_error('gender'); ?>
                                <?php echo form_radio('payment_cycle', 'M', $monthly, 'id="monthly"');?>Monthly<?php echo form_error('gender'); ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Rent payment amount <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'rent_payment_amount',
                                            'id'        => 'rent_payment_amount',
                                            'value'      => $this->input->post('rent_payment_amount')
                                        );
                                        $rent = '';
                                        if($this->input->post('payment_cycle') == 'W') {
                                            $rent = $this->input->post('rent_payment_amount');
                                        }
                                        if($this->input->post('payment_cycle') == 'M') {
                                            $rent = $this->input->post('rent_payment_amount')*(0.25);
                                        }
                                        if($this->input->post('payment_cycle') == 'F') {
                                            $rent = $this->input->post('rent_payment_amount')*(0.5);
                                        }
                                        echo form_input($data); 
                                        ?></td>
                              </tr>
                              <tr>
                                <td width="200">Rent per week <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'rent',
                                            'id'        => 'rent',
                                            'disabled'=>'disabled',
                                            'value'      => $rent
                                        );
                                        echo form_input($data); 
                                        ?></td>
                              </tr>
                              <tr>
                                <td width="200">Tenants  :<span class="required">*</span></td>
                                <td><?php $countries[''] = "Select Employee"; echo form_dropdown('enployee_id', $users, $this->input->post('enployee_id'), "id = 'country'"); ?> <img  id="example" class="example" style="display: none;" src="<?php echo HTTP_PATH;?>img/ajax-loader.gif" /></td>
                              </tr>  
                              <tr>
                                <td width="200">Realtor Company name <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array('name'        => 'retailor_company_name',
                                            'value'       => set_value("retailor_company_name")
                                            );
                                        echo form_input($data); 
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Realtor Contact number <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                                        'name'        => 'retailor_name',
                                            'value'       => set_value("retailor_company_name")
                                                    );
                                        echo form_input($data);
                                        ?>
                                </td>
                              </tr>
                               <tr>
                                <td width="200">Realtor bank <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'retailor_bank',
                                            'id'        => 'retailor_bank',
                                            'value'       => set_value("retailor_bank")
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                               <tr>
                                <td width="200">Realtor account number <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'retailot_acc_no',
                                            'id'        => 'retailot_acc_no',
                                            'value'       => set_value("retailot_acc_no")
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>                          
                              <tr>
                                <td width="200">Realtor account BSB :</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'retailot_acc_bsb',
                                            'value'       => set_value("retailot_acc_bsb")
                                        );
                                        echo form_input($data); ?></td>
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
      </table></td>
  </tr>
  <tr>
