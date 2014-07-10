<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
$(function() {
    $("#dob").datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(1995, 0, 1),
            changeYear: true
    });
    $( "#firstvisastart" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#firstvisaend" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#secondvisastart" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#secondvisaend" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#employmentdate" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });

});
function showhide()
{            
     if($('input:radio[name=statusofabn]:checked').val()=='1'){
      $("#namebank").show(1000);   
     }
     if($('input:radio[name=statusofabn]:checked').val()=='2'){
      $("#namebank").hide(500);   
     }
} 

</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Add New Employee</td>
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
                        <th>Personal Details</th>
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
                            if($this->uri->segment(4) == 'advOwners') {
                                $type = '/advOwners';
                            }
                            else {
                                $type = '';
                            }
                            echo form_open_multipart('admin/users/addUser'.$type, array('name'=>'myform'));?>
                            <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="200">First Name <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'firstname',
                                            'value'       => set_value("firstname")
                                        );
                                        echo form_input($data); 
                                        ?></td>
                              </tr>
                              <tr>
                                <td width="200">Last Name <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'lastname',
                                            'value'       => set_value("lastname")
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                              <tr>
                                <td width="200">Email Address <span class="required">*</span>:</td>
                                <td><?php  $data = array('name'=> 'email','value'       => set_value("email")); echo form_input($data); ?></td>
                              </tr>
                               <tr>
                                <td width="200">Contact Number :</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'contact',
                                            'value'       => $this->input->post('contact')
                                        );
                                        echo form_input($data); ?></td>
                              </tr>
                              <tr>
                                <td width="200">Password <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                                        'name'        => 'password'
                                                    );
                                        echo form_password($data); 
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Confirm Password <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                                        'name'        => 'cpassword'
                                                    );
                                        echo form_password($data);
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Gender: <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('gender') == 'F'){  $male = NULL;$female = true;}else {$male = true;$female = NULL;  }
                                echo form_radio('gender', 'M', $male);?>Male &nbsp;
                                <?php echo form_radio('gender', 'F', $female);?>Female<?php echo form_error('gender'); ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Height <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'height',
                                            'value'       => $this->input->post('height')
                                        );
                                        echo form_input($data);
                                       ?> cm</td>
                              </tr>
                              <tr>
                                <td width="200">Weight <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'weight',
                                            'value'       =>  $this->input->post('weight')
                                        );
                                        echo form_input($data);
                                       ?> Kg</td>
                              </tr>
                              <tr>
                                <td>Tax Type : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('taxtype') == '1'){  $abn = NULL;$tfn = true;}else if($this->input->post('taxtype') == '2'){$abn = true;$tfn = NULL;  }else{$abn = false;$tfn = false; }
                                
                                echo form_radio('taxtype', '1', $abn);?>ABN &nbsp;
                                <?php echo form_radio('taxtype', '2', $tfn);?>TFN<?php echo form_error('taxtype'); ?>
                                </td>
                              </tr>  
                               <tr>
                                <td width="200"> Tax Number <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'tax_num',
                                            'id'        => 'tax_num',
                                            'value'       => $this->input->post('tax_num')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                               <tr id="namebank">
                                <td width="200">ABN number <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'abnnumber',
                                                'id'        => 'abnnumber',
                                                'value'       => $this->input->post('abnnumber')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">DOB <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'dob',
                                            'id'        => 'dob',
                                            'value'       => $this->input->post('dob')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                               <tr>
                                <td>Vaccination status : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('statusvaccination') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_radio('statusvaccination', '1', $yes);?>Yes &nbsp;
                                <?php echo form_radio('statusvaccination', '2', $no);?>No<?php echo form_error('statusvaccination'); ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Shift Type : <font color="red"></font></td>
                                <td><?php
                                      $options = array('1' => 'Morning','2' => 'Afternoon','3' => 'Night');
                                       $selected = array();                                       
                                       echo form_dropdown('shifttype[]', $options, $this->input->post('shifttype')); ?>
                                </td>
                              </tr> 
                              <tr>
                                <td>Position : <font color="red"></font></td>
                                <td><?php
                                      $options = array('1' => 'General hand','2' => 'Slicer','3' => 'Boner','4' => 'Packer','5' => 'Floor boy','6' => 'Maintenance','7' => 'Cleaning','8' => 'Loading');
                                       $nextselected = array();
                                       echo form_dropdown('position', $options,  $this->input->post('position')); ?>
                                </td>
                              </tr> 
                              <tr>
                                <td width="200">Nationality  :<span class="required">*</span></td>
                                <td><?php $countries[''] = "Select Nationality"; echo form_dropdown('country_id', $countries, $this->input->post('country_id'), "id = 'country'"); ?> <img  id="example" class="example" style="display: none;" src="<?php echo HTTP_PATH;?>img/ajax-loader.gif" /></td>
                              </tr>                             
                              <tr>
                                <td width="200">Passport number :</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'passport_number',
                                            'value'       => $this->input->post('passport_number')
                                        );
                                        echo form_input($data); ?></td>
                              </tr>
                               <tr>
                                <td>Visa Type : <font color="red"></font></td>
                                <td><?php
                                      $visaoptions = array('1' => 'Working holiday','2' => 'Dependant 457 visa full work rights','3' => 'PR/citizen','4' => 'Bridging visa full work rights','5' => 'Other visa','6' => 'Limited work rights');
                                       $visaselected = array();
                                       echo form_dropdown('visa_type', $visaoptions, $nextselected); ?>
                                </td>
                              </tr> 
                               <tr>
                                <td width="200">First visa start date <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'firstvisastart',
                                            'id'        => 'firstvisastart',
                                            'value'       => $this->input->post('firstvisastart')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                               <tr>
                                <td width="200">First visa end date <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'firstvisaend',
                                            'id'        => 'firstvisaend',
                                            'value'       => $this->input->post('firstvisaend')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                              <tr>
                                <td width="200">Second visa start date <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'secondvisastart',
                                            'id'        => 'secondvisastart',
                                            'value'       => $this->input->post('secondvisastart')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                               <tr>
                                <td width="200">Second visa end date <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'secondvisaend',
                                            'id'        => 'secondvisaend',
                                            'value'       => $this->input->post('secondvisaend')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                             
                              <tr>
                                <td>Has ABN: <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('statusofabn') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_checkbox('statusofabn', '2', $no);?><?php echo form_error('statusofabn'); ?>
                                </td>
                              </tr>
                               <tr>
                                <td width="200">Account Name <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'nameofbank',
                                                'id'        => 'nameofbank',
                                                'value'       => $this->input->post('nameofbank')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">Account Number <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'numberofbank',
                                                'value'       => $this->input->post('numberofbank')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">BSB <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'branchofbank',
                                                'value'       => $this->input->post('branchofbank')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">Place of work <span class="required"></span>:</td>
                                <td>
                                    <?php $worksites[''] = 'Select Worksite'; echo form_dropdown('placeofwork', $worksites, $this->input->post('placeofwork')); ?>
                                </td>
                              </tr>
                               <tr>
                                <td width="200">Start employment date <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'employmentdate',
                                                'id'        => 'employmentdate',
                                                'value'       => $this->input->post('employmentdate')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                              <tr>
                                <td width="200">Hourly rate description <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'hourlyrate',
                                                'value'       => $this->input->post('hourlyrate')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                              <tr>
                                <td width="200">Total One Off Deductions ($)<span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'deductions',
                                                'value'       => $this->input->post('deductions')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                              <tr>
                                <td width="200">Reasons for Deductions ($) <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'reason_deductions',
                                                'value'       => $this->input->post('reason_deductions')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                              <tr>
                                <td width="200">Place of stay <span class="required"></span>:</td>
                                <td>
                                <?php $houses[''] = 'Select House'; echo form_dropdown('placeofstay', $houses, $this->input->post('placeofstay'), 'id="select_house"'); ?>
                                </td>
                              </tr>
                               <tr>
                                <td width="200">Weekly rent rate ($) <span class="required"></span>:</td>
                                <td id="loadcon"><?php
                                        $data = array(
                                                'name'        => 'weeklyrent',
                                                'id'        => 'weeklyrent',
                                                'value'       => $this->input->post('weeklyrent')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td>Bond Payed : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');                                
                                if($this->input->post('statusofbond') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_radio('statusofbond', '1', $yes);?>Yes &nbsp;
                                <?php echo form_radio('statusofbond', '2', $no);?>No<?php echo form_error('statusofbond'); ?>
                                </td>
                              </tr>
                               <tr>
                                <td width="200">Amount of bond payment ($) <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'bondamount',
                                                'value'       =>  $this->input->post('bondamount')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                              <tr>
                                <td>Status of issued equipment : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('statusofissued') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_radio('statusofissued', '1', $yes);?>Yes &nbsp;
                                <?php echo form_radio('statusofissued', '2', $no);?>No<?php echo form_error('statusofissued'); ?>
                                </td>
                              </tr>
                              <tr>
                                    <td width="200">Equipment name 1 <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'equipment_name1',
                                                'value'       => $this->input->post('equipment_name1')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">Equipment value 1 <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'equipment_value1',
                                                'value'       => $this->input->post('equipment_value1')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td>Paid for by 1 : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('paidforby1') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_radio('paidforby1', '1', $yes);?>Company &nbsp;
                                <?php echo form_radio('paidforby1', '2', $no);?>Employee<?php echo form_error('paidforby1'); ?>
                                </td>
                              </tr>
                                                                                           <tr>
                                <td width="200">Equipment name 2 <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'equipment_name2',
                                                'value'       => $this->input->post('equipment_name2')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">Equipment value 2 <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'equipment_value2',
                                                'value'       => $this->input->post('equipment_value2')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td>Paid for by 2 : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('paidforby2') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_radio('paidforby2', '1', $yes);?>Company &nbsp;
                                <?php echo form_radio('paidforby2', '2', $no);?>Employee<?php echo form_error('paidforby2'); ?>
                                </td>
                              </tr>
                                                                                           <tr>
                                <td width="200">Equipment name 3 <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'equipment_name3',
                                                'value'       => $this->input->post('equipment_name3')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">Equipment value 3 <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'equipment_value3',
                                                'value'       => $this->input->post('equipment_value3')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td>Paid for by 3 : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('paidforby3') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_radio('paidforby3', '1', $yes);?>Company &nbsp;
                                <?php echo form_radio('paidforby3', '2', $no);?>Employee<?php echo form_error('paidforby3'); ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Possible Future employment : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('future_employment') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_checkbox('future_employment', '2', $no);
                                ?>
                                </td>
                              </tr>
                               <tr>
                                <td>Currently Employed : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('employee_employed') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_checkbox('employee_employed', '2', $no);?>
                                </td>
                              </tr>
                               <tr>
                                <td width="200">Description of final position <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'final_position',
                                                'value'       => $this->input->post('final_position')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                              
                               <tr>
                                <td width="200">Resignation Approved By <span class="required"></span>:</td>
                                <td><?php
                                        $data = array(
                                                'name'        => 'r_ap_by',
                                                'value'       => $this->input->post('r_ap_by')
                                            );
                                    echo form_input($data);
                                    ?></td>
                              </tr>
                               <tr>
                                <td width="200">Resignation reason :</td>
                                <td><?php $data = array('name'=> 'reason','id'=> 'reason','value'=> $this->input->post('reason'),'rows'=>"5",'cols'=>"40");
                                        echo form_textarea($data);
                                     ?>
                                </td>
                              </tr>
                                <tr>
                                <td>Left Australia : <font color="red"></font></td>
                                <td><?php
                                $array = array('selected'=>'selected');
                                if($this->input->post('left_australia') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                                echo form_checkbox('left_australia', '2', $no);?>
                                </td>
                              </tr>
                              <!--tr>
                                <td width="200">Image : </td>
                                <td> <?php
                                      /*  $data = array(
                                                        'name'        => 'image'
                                                    );
                                        echo form_upload($data);*/
                                        ?><br>Supported File Types: gif, jpg, png (Max. 200KB)</td>
                              </tr-->
                              
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
