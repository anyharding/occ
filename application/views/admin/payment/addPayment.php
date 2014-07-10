<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
$(document).ready(function(){
    $('#employee').change(function() {
        if(this.value != "") {
        $.ajax({
            url:"<?php echo HTTP_PATH."admin/payment/getUserInfo" ?>/"+this.value,
                success:function(data){
                    
                    var record = data.split("::");
                    $("#worksite").val(record[0]);
                    $("#name").val(record[1]);
                    $("#hourly_rate").val(record[2]);
                }
            }
        );
        
        }
        else {
            $("#worksite").val('');
            $("#name").val('');
            $("#hourly_rate").val('');
        }
        
    }); 
        $('#hours').keyup(function(){
           var hourly_rate = $("#hourly_rate").val();
           var gst = hourly_rate * this.value;
           $("#gst").val(gst);
           
           var overtime = $('#overtime').val();
           var overtime_payment = hourly_rate * overtime;
           var gross_service_text = (parseFloat(overtime_payment)+parseFloat(gst))*10/100;
           $("#net_payment").val(parseFloat(gross_service_text) + parseFloat(gst) + parseFloat(overtime_payment));
           
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#overtime').keyup(function(){
           var hourly_rate = $("#hourly_rate").val();
           var overtime_payment = hourly_rate * this.value;
           var gross_weg_amount = $("#gst").val();
           var gross_service_text = (parseFloat(overtime_payment)+parseFloat(gross_weg_amount))*10/100;
           $("#net_payment").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount) + parseFloat(overtime_payment));
           
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#rent_deduction').keyup(function(){
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#transport_deduction').keyup(function(){
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#other_deduction').keyup(function(){
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        
        
        $('#hours').change(function(){
           var hourly_rate = $("#hourly_rate").val();
           var gst = hourly_rate * this.value;
           $("#gst").val(gst);
           
           var overtime = $('#overtime').val();
           var overtime_payment = hourly_rate * overtime;
           var gross_service_text = (parseFloat(overtime_payment)+parseFloat(gst))*10/100;
           $("#net_payment").val(parseFloat(gross_service_text) + parseFloat(gst) + parseFloat(overtime_payment));
           
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#overtime').change(function(){
           var hourly_rate = $("#hourly_rate").val();
           var overtime_payment = hourly_rate * this.value;
           var gross_weg_amount = $("#gst").val();
           var gross_service_text = (parseFloat(overtime_payment)+parseFloat(gross_weg_amount))*10/100;
           $("#net_payment").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount) + parseFloat(overtime_payment));
           
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#rent_deduction').change(function(){
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#transport_deduction').change(function(){
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
        $('#other_deduction').change(function(){
           var net_payment_amount = parseFloat($("#net_payment").val());
           var rent_deduction = parseFloat($("#rent_deduction").val());
           var transport_deduction = parseFloat($("#transport_deduction").val());
           var other_deduction = parseFloat($("#other_deduction").val());
           $("#total_payment_amount").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
        });
    
});
</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Add Employee Payment</td>
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
                        <th>Add Employee Payment</th>
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
                             echo form_open_multipart('admin/payment/addPayment', array('name'=>'myform'));?>
                            <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                              
                              <tr>
                                <td width="200">Select Employee <span class="required"> * </span>:</td>
                                <td><?php  echo form_dropdown('employee_id', $users, $this->input->post('employee_id'), 'id="employee"'); ?></td>
                              </tr>
                              <tr>
                                <td width="200">Worksite<span class="required">  </span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'worksite',
                                            'id'        => 'worksite',
                                            'readonly'=> 'readonly',
                                            'value'       => $this->input->post('worksite')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                              <tr>
                                <td width="200">Employee Name <span class="required">  </span>:</td>
                                <td><?php  $data = array('name'=> 'name','readonly'=> 'readonly','id'=> 'name','value'       => $this->input->post('name')); echo form_input($data); ?></td>
                              </tr>
                              <tr>
                                <td width="200">Hourly Rate <span class="required"> * </span>:</td>
                                <td><?php  $data = array('readonly'=> 'readonly','id'=> 'hourly_rate','name'=> 'hourly_rate','value' => $this->input->post('hourly_rate')); echo form_input($data); ?>  $</td>
                              </tr>
                              
                              <tr>
                                <td width="200">Hours Worked <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'id'        => 'hours',
                                            'name'        => 'hours'
                                        );
                                        echo form_input($data);
                                       ?> Hours
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Gross Wage Amount :</td>
                                <td><?php
                                        $data = array(
                                                        'name' => 'gst',
                                                        'readonly'=> 'readonly',
                                                        'id' => 'gst'
                                                    );
                                        echo form_input($data);
                                        ?> $
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Overtime :</td>
                                <td><?php
                                        $data = array(
                                                        'name' => 'overtime',
                                                        'id' => 'overtime'
                                                    );
                                        echo form_input($data);
                                        ?> Hours
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Net Payment Amount :</td>
                                <td><?php
                                        $data = array(
                                                        'name' => 'net_payment',
                                                        'readonly'=> 'readonly',
                                                        'id' => 'net_payment'
                                                    );
                                        echo form_input($data);
                                        ?>  $
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Rent Deduction :</td>
                                <td><?php
                                
                                        
                                        $data = array(
                                                        'name' => 'rent_deduction',
                                                        'id' => 'rent_deduction',
                                                        'value'=> 0
                                                    );
                                        echo form_input($data);
                                        ?> $
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Transport Deduction :</td>
                                <td><?php
                                        $data = array(
                                                        'name' => 'transport_deduction',
                                                        'id' => 'transport_deduction',
                                                        'value'=> 0
                                                    );
                                        echo form_input($data);
                                        ?> $
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Other Deductions :</td>
                                <td><?php
                                
                                        $data = array(
                                                        'name' => 'other_deduction',
                                                        'id' => 'other_deduction',
                                                        'value'=> 0
                                                    );
                                        echo form_input($data);
                                        ?> $
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Total Payment Amount :</td>
                                <td><?php
                                        $data = array(
                                                        'name' => 'total_payment_amount',
                                                        'readonly'=> 'readonly',
                                                        'id' => 'total_payment_amount'
                                                    );
                                        echo form_input($data);
                                        ?> $
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Other Payments :</td>
                                <td><?php
                                        $data = array(
                                                        'name' => 'other_payments',
                                                        'id' => 'other_payments'
                                                    );
                                        echo form_input($data);
                                        ?> $
                                </td>
                              </tr>
                              
                              
                              <tr>
                                <td></td>
                                <td><input type="image" src="<?php echo HTTP_PATH.'img/submitBtn.png';?>"> &nbsp;
                                    <img onclick="document.myform.reset();return false;" src="<?php echo HTTP_PATH.'img/reset.png';?>" style=" cursor: pointer;" width="108" height="39">
                                
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
