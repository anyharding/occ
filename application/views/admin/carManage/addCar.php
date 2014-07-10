<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(function() {
        $( "#purchase_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#dob" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#rego_exp_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#next_ser_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#roadside_expiry_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#service_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#insurance_start_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#insurance_end_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });          
    });
</script>
<script>
    $(document).ready(function(){
        $('#car_username').change(function() {
        
            if(this.value != "") {
                $.ajax({
                    url:"<?php echo HTTP_PATH . "admin/carManage/getUserDOB" ?>/"+this.value,
                    success:function(data){
                        $("#dob").val(data);
                    }
                }
            );
            }
            else {
                $("#dob").val('');
            }
        });
    });
</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="32">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Add New Car Details</td>
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
                                <th>Add New Car Details</th>
                            </tr>
                            <tr><td colspan="2" align="center">

                                    <?php if (validation_errors() || $this->session->userdata('message') || $this->session->flashdata('message')) { ?>
                                        <div class='ActionMsgBox error' id='msgID'>
                                            <?php
                                            echo validation_errors();
                                            echo $this->session->userdata('message');
                                            echo $this->session->flashdata('message');
                                            $this->session->unset_userdata('message');
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('smessage') || $this->session->flashdata('smessage')) { ?>
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
                                    <?php echo form_open_multipart('admin/carManage/addCar', array('name' => 'myform')); ?>
                                    <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="200">Car Id <span class="required"></span>:</td>
                                            <td>
                                                Not Added
                                            </td>
                                        </tr>


                                        <tr>
                                            <td width="200">Car Make <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array('name' => 'car_make',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("car_make")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Car Model <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array('name' => 'model',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("model")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Car Year  <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array('name' => 'year',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("year")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Seating Capacity  <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array('name' => 'seating_capacity',
                                                    'class' => 'textfield_input number',
                                                    'value' => $this->input->post("seating_capacity")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td width="200">Purchase date <span class="required">*</span>:</td>
                                            <td>
                                                <?php
                                                $data = array(
                                                    'name' => 'purchase_date',
                                                    'id' => 'purchase_date',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post("purchase_date")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Ownership company <span class="required"></span>:</td>
                                            <td>
                                                <?php
//                                                $data = array(
//                                                    'name' => 'ownership_comp',
//                                                    'value' => $this->input->post("ownership_comp")
//                                                );
//                                                echo form_input($data);
                                                ?>
                                                <?php echo form_dropdown('ownership_comp', $company, $this->input->post('ownership_comp')); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rego No: <font color="red"></font></td>
                                            <td><?php
                                                $data = array('name' => 'rego_no',
                                                    'value' => $this->input->post("rego_no")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>Rego expiry: <font color="red"></font></td>
                                            <td><?php
                                                $data = array('name' => 'rego_exp_date',
                                                    'id' => 'rego_exp_date',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post("rego_exp_date")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td width="200">Vehicle Identification Number <span class="required">*</span> :</td>
                                            <td><?php
                                                $data = array('name' => 'vin',
                                                    'value' => $this->input->post("vin")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Engine no <font color="red">  *</font>:</td>
                                            <td><?php
                                                $data = array('name' => 'eng_no',
                                                    'value' => $this->input->post("eng_no")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td width="200">Color <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'color',
                                                    'value' => $this->input->post("color")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Next service date: <font color="red"></font></td>
                                            <td><?php
                                                $data = array('name' => 'next_ser_date',
                                                    'id' => 'next_ser_date',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post("next_ser_date")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td width="200">Next service KM <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'next_ser_km',
                                                    'value' => $this->input->post("next_ser_km")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Service date: <font color="red"></font></td>
                                            <td><?php
                                                $data = array('name' => 'service_date',
                                                    'id' => 'service_date',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post("service_date")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td width="200">Service KM <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'service_km',
                                                    'value' => $this->input->post("service_km")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Car User name <font color="red">* </font>:</td>
                                            <td><?php echo form_dropdown('car_username', $users, $this->input->post('car_username'), 'id="car_username"'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">DOB <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'dob',
                                                    'id' => 'dob',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post("dob")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>License No: <font color="red"></font></td>
                                            <td><?php
                                                $data = array('name' => 'licence_no',
                                                    'value' => $this->input->post("licence_no")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td width="200">Latest KM <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'latest_km',
                                                    'value' => $this->input->post("latest_km")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="200">Purchase Price<span class="required"></span> ($):</td>
                                            <td><?php
                                                $data = array('name' => 'purchase_price',
                                                    'value' => $this->input->post("purchase_price")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Insurance company: <font color="red"></font></td>
                                            <td><?php
                                                $data = array('name' => 'insurance_comp',
                                                    'value' => $this->input->post("insurance_comp")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td width="200">Policy Number <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'policy_no',
                                                    'value' => $this->input->post("policy_no")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Insurance cover start date <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'insurance_start_date',
                                                    'readonly' => 'readonly',
                                                    'id' => 'insurance_start_date',
                                                    'value' => $this->input->post("insurance_start_date")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Insurance cover end date <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'insurance_end_date',
                                                    'id' => 'insurance_end_date',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post("insurance_end_date")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"> Insurance cover cost <span class="required"></span> ($):</td>
                                            <td><?php
                                                $data = array('name' => 'insurance_cover_cost',
                                                    'value' => $this->input->post("insurance_cover_cost")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="200">Assigned location <span class="required"></span>:</td>
                                            <td>
                                                <?php
//                                                $data = array('name' => 'car_use_location',
//                                                    'value' => $this->input->post("car_use_location")
//                                                );
//                                                echo form_input($data);
                                                ?>
                                                <?php echo form_dropdown('car_use_location', $worksites, $this->input->post('car_use_location')); ?>
                                            </td>
                                        </tr>



                                        <tr>
                                            <td width="200">Roadside assist <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $array = array('selected' => 'selected');
                                                if ($this->input->post('roadside') == '0') {
                                                    $yes = NULL;
                                                    $no = true;
                                                } else {
                                                    $yes = true;
                                                    $no = NULL;
                                                }
                                                echo form_radio('roadside', '1', $yes);
                                                ?><label>Yes</label> &nbsp;
                                                <?php echo form_radio('roadside', '0', $no); ?><label>No</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Roadside assist number <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array('name' => 'roadside_assist_number',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("roadside_assist_number")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Roadside assist company <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array('name' => 'roadside_assist_company',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("roadside_assist_company")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Roadside expiry date <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array('name' => 'roadside_expiry_date',
                                                    'id' => 'roadside_expiry_date',
                                                    'class' => 'textfield_input',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post("roadside_expiry_date")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>



                                        <tr>
                                            <td width="200">E-toll  <span class="required"></span>:</td>
                                            <td><?php
                                                $array = array('selected' => 'selected');
                                                if ($this->input->post('e_troll') == '0') {
                                                    $yes = NULL;
                                                    $no = true;
                                                } else {
                                                    $yes = true;
                                                    $no = NULL;
                                                }
                                                echo form_radio('e_troll', '1', $yes);
                                                ?>
                                                <label>Yes</label><?php echo form_radio('e_troll', '0', $no); ?><label>No</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">E-toll account number <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'e_troll_account',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("e_troll_account")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">E-toll tag number <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'e_troll_tag',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("e_troll_tag")
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"> E-toll password <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'e_troll_password',
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post("e_troll_password")
                                                );
                                                echo form_password($data);
                                                ?>     </td>
                                        </tr>
                                        <tr>
                                            <td width="200"> Notes <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                $data = array(
                                                    'name' => 'notes',
                                                    'rows' => "5",
                                                    'cols' => "40",
                                                    'id' => "notes",
                                                    'class' => 'textfield_input',
                                                    'value' => $this->input->post('notes')
                                                );
                                                echo form_textarea($data);
                                                ?>
                                            </td>
                                        </tr>




                                        <tr>
                                            <td></td>
                                            <td><input type="image" src="<?php echo HTTP_PATH . 'img/submitBtn.png'; ?>"> &nbsp;
                                                <img onclick="document.myform.reset();return false;" src="<?php echo HTTP_PATH . 'img/reset.png'; ?>" width="108" height="39">

                                            </td>

                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                    <?php echo form_close(); ?>
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
