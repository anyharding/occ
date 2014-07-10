<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(function() {
        $( "#rent_due_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#lcd" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#led" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
    });
    function preventCharecter(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)){  
            return false;
        }
        var sbs = $('#bsb').val().length;
        var sbsValue  = $('#bsb').val();
        if(sbs ==3){
            $('#bsb').val(sbsValue+'-');
        }else if(sbs >6){
            pattern = "^[0-9]{3}-[0-9]{3}$";//American Express
                        
            if (sbsValue.search(pattern)!=0) {
                            
            } else {
                alert('What you have entered does not appear to be a valid BSB number. Please supply the six digit BSB number in the format ‘xxx-xxx’');
                $('#bsb').val('');
            }
        }
    }
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
        $("#myform").validate();
    });
</script>

<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Add House</strong>
                </p>
            </div>


        </section>   
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
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol2">
                <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
                <section class="form_contant_box_nw">

                    <?php echo form_open('houses/addHouse', array('name' => 'myform', 'id' => 'myform')); ?>
                    <div class="user_name_box2">
                        <div class="field_name ">Address of House <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'address',
                                'id' => 'address',
                                'class' => 'textfield_input required',
                                'cols' => 5,
                                'rows' => 5,
                                'value' => $this->input->post('address')
                            );
                            echo form_textarea($data);
                            ?>
                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Payment cycle <span class="required1">*</span></div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->input->post('payment_cycle') == 'W') {
                                $fortnightly = NULL;
                                $monthly = NULL;
                                $weekly = true;
                            } else if ($this->input->post('payment_cycle') == 'F') {
                                $fortnightly = true;
                                $monthly = NULL;
                                $weekly = true;
                            } else {
                                $fortnightly = NULL;
                                $monthly = true;
                                $weekly = true;
                            }
                            echo form_radio('payment_cycle', 'W', $weekly, 'id="weekly"');
                            ?><label>Weekly</label> &nbsp;
                            <?php echo form_radio('payment_cycle', 'F', $fortnightly, 'id="fornightly" class="required"'); ?><label>Fortnightly</label><?php echo form_error('gender'); ?>
                            <?php echo form_radio('payment_cycle', 'M', $monthly, 'id="monthly" class="required"'); ?><label>Monthly</label><?php echo form_error('gender'); ?>

                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Rent payment amount <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'rent_payment_amount',
                                'id' => 'rent_payment_amount',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('rent_payment_amount')
                            );
                            $rent = '';
                            if ($this->input->post('payment_cycle') == 'W') {
                                $rent = $this->input->post('rent_payment_amount');
                            }
                            if ($this->input->post('payment_cycle') == 'M') {
                                $rent = $this->input->post('rent_payment_amount') * (0.25);
                            }
                            if ($this->input->post('payment_cycle') == 'F') {
                                $rent = $this->input->post('rent_payment_amount') * (0.5);
                            }
                            echo form_input($data);
                            ?>

                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Rent bond amount  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'rent_bound',
                                'id' => 'rent_bound',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('rent_bound')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Rent per week  <span class="required1">*</span> </div>
                        <div class="text_field_bg">

                            <?php
                            $data = array(
                                'name' => 'rent',
                                'id' => 'rent',
                                'disabled' => 'disabled',
                                'class' => 'textfield_input required',
                                'value' => $rent
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Realtor Company Name <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'retailor_company_name',
                                'class' => 'textfield_input required',
                                'value' => set_value("retailor_company_name")
                            );
                            echo form_input($data);
                            ?>

                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Realtor Name/Contact <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'retailor_name',
                                'class' => 'textfield_input required',
                                'value' => set_value("retailor_name")
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Realtor Bank <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            // $data = array(
                                // 'name' => 'retailor_bank',
                                // 'class' => 'textfield_input required',
                                // 'id' => 'retailor_bank',
                                // 'value' => set_value("retailor_bank")
                            // );
                            //echo form_input($data);
                            echo form_dropdown('retailor_bank', $retailor_bank, $this->input->post('retailor_bank'), 'id="retailor_bank" class="textfield_input required"');
                            ?>
                        </div>

                    </div>
                     <div class="user_name_box2">
                        <div class="field_name ">Realtor Account Name <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'retailot_acc_name',
                                'class' => 'textfield_input required',
                                'id' => 'retailot_acc_name',
                                'value' => set_value("retailot_acc_name")
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Realtor Account Number <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'retailot_acc_no',
                                'class' => 'textfield_input required',
                                'id' => 'retailot_acc_no',
                                'value' => set_value("retailot_acc_no")
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Realtor Account BSB <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'retailot_acc_bsb',
                                'class' => 'textfield_input required',
                                'id' => 'bsb',
                                'onkeypress' => 'return preventCharecter(event)',
                                'value' => set_value("retailot_acc_bsb")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>



                    <div class="user_name_box2">
                        <div class="field_name "> Lease commence date  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'lcd',
                                'id' => 'lcd',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $this->input->post('lcd')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Lease expire date  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'led',
                                'id' => 'led',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $this->input->post('led')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Internet connection  <span class="required"></span> </div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->input->post('internet') == '0') {
                                $yes = NULL;
                                $no = true;
                            } else {
                                $yes = true;
                                $no = NULL;
                            }
                            ?>

                            <?php echo form_radio('internet', '1', $yes); ?><label>Yes</label>
                            <?php echo form_radio('internet', '0', $no); ?><label>No</label>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> ISP  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'isp',
                                'id' => 'isp',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('isp')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> ISP Username  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'isp_username',
                                'id' => 'isp_username',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('isp_username')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> ISP Password  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'isp_pass',
                                'id' => 'isp_pass',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('isp_pass')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Phone number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'phone',
                                'id' => 'phone',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('phone')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Electricity company name  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'ele_comp',
                                'id' => 'ele_comp',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('ele_comp')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Electricity account number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'ele_account',
                                'id' => 'ele_account',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('ele_account')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Electricity Meter number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'electricity_meter',
                                'id' => 'electricity_meter',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('electricity_meter')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Electricity Co contact number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'electricity_co',
                                'id' => 'electricity_co',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('electricity_co')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <!--for water-->
                    <div class="user_name_box2">
                        <div class="field_name "> Water utility company  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'water_utility_company',
                                'id' => 'water_utility_company',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('water_utility_company')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Water account number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'water_account',
                                'id' => 'water_account',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('water_account')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Water meter number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'water_meter',
                                'id' => 'water_meter',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('water_meter')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Water utility contact number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'water_utility_contact',
                                'id' => 'water_utility_contact',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('water_utility_contact')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <!--end for water-->


                    <div class="user_name_box2">
                        <div class="field_name "> Gas company name  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'gas_comp',
                                'id' => 'gas_comp',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('gas_comp')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Gas account number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'gas_account',
                                'id' => 'gas_account',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('gas_account')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Landlord email address  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'langlord',
                                'id' => 'langlord',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('langlord')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name">Worksite <span class="required1">*</span></div>
                        <div class="text_field_bg_nw">
                            <?php echo form_dropdown('worksite_id', $worksites, $this->input->post('worksite_id'), "class = 'textfield_input required' id='worksite'"); ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Insurance  </div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->input->post('insurance') == 'no') {
                                $yes = NULL;
                                $no = true;
                            } elseif ($this->input->post('insurance') == 'yes') {
                                $yes = true;
                                $no = NULL;
                            } else {
                                $yes = NULL;
                                $no = NULL;
                            }
                            ?>

                            <?php echo form_radio('insurance', 'yes', $yes); ?><label>Yes</label>
                            <?php echo form_radio('insurance', 'no', $no); ?><label>No</label>
                        </div>
                    </div> 

                    <div class="user_name_box2">
                        <div class="field_name "> Insurance company <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'insurance_company',
                                'id' => 'insurance_company',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('insurance_company')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Insurance Policy Number <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'insurance_policy',
                                'id' => 'insurance_policy',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('insurance_policy')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Active  <span class="required1">*</span> </div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->input->post('status') == '0') {
                                $yes = NULL;
                                $no = true;
                            } elseif ($this->input->post('status') == '1') {
                                $yes = true;
                                $no = NULL;
                            } else {
                                $yes = NULL;
                                $no = NULL;
                            }
                            ?>

                            <?php echo form_radio('status', '1', $yes); ?><label>Yes</label>
                            <?php echo form_radio('status', '0', $no); ?><label>No</label>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name">Notes</div>
                        <div class="text_field_bg">
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
                        </div>
                    </div>


                    <div  class="user_name_3">
                        <div class="login_button_2"><input name="Submit" value="Submit" type="submit" class="input_submit" />

                        </div>

                        <div class="login_button_2">
                            <input name="Button" value="Back" type="button" onclick="window.history.back()" class="input_submit" />
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </section>
            </section>  



        </section>
</article>

