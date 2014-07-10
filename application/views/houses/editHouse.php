<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    //http://en.wikipedia.org/wiki/Lists_of_people_by_nationality
    $(document).ready(function(){
        $('#country').change(function(e) {
            $('#example').fadeIn();
            $('#state').load('<?php echo HTTP_PATH; ?>admin/houses/getstate/'+this.value);
            $('#example').fadeOut();
        });   
    });function preventCharecter(evt){
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
                    <strong class="ribbon-content">Edit House</strong>
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
            <?php $this->load->view('user/sideBarLeft.php'); ?>
            <section class="contentCol2">
                <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
                <section class="form_contant_box_nw">

                    <?php echo form_open_multipart('houses/editHouse/' . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6), array('name' => 'myform', 'id' => 'myform')); ?>
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
                                'value' => $this->input->post('address') ? $this->input->post('address') : $house_detail[0]['address']
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
                            if (($this->input->post('payment_cycle') ? $this->input->post('payment_cycle') : $house_detail[0]['payment_cycle']) == 'W') {
                                $fortnightly = NULL;
                                $monthly = NULL;
                                $weekly = true;
                            } else if (($this->input->post('payment_cycle') ? $this->input->post('payment_cycle') : $house_detail[0]['payment_cycle']) == 'F') {
                                $fortnightly = true;
                                $monthly = NULL;
                                $weekly = true;
                            } else {
                                $fortnightly = NULL;
                                $monthly = true;
                                $weekly = true;
                            }
                            echo form_radio('payment_cycle', 'W', $weekly, 'id="weekly" class="required"');
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
                                'value' => $this->input->post('rent_payment_amount') ? $this->input->post('rent_payment_amount') : $house_detail[0]['rent_payment_amount']
                            );
                            $rent = '';
                            echo form_input($data);
                            if (($this->input->post('payment_cycle') ? $this->input->post('payment_cycle') : $house_detail[0]['payment_cycle']) == 'W') {
                                $rent = $this->input->post('rent_payment_amount') ? $this->input->post('rent_payment_amount') : $house_detail[0]['rent_payment_amount'];
                            }
                            if (($this->input->post('payment_cycle') ? $this->input->post('payment_cycle') : $house_detail[0]['payment_cycle']) == 'M') {
                                $rent = $this->input->post('rent_payment_amount') ? $this->input->post('rent_payment_amount') : $house_detail[0]['rent_payment_amount'] * (0.25);
                            }
                            if (($this->input->post('payment_cycle') ? $this->input->post('payment_cycle') : $house_detail[0]['payment_cycle']) == 'F') {
                                $rent = $this->input->post('rent_payment_amount') ? $this->input->post('rent_payment_amount') : $house_detail[0]['rent_payment_amount'] * (0.5);
                            }
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
                                'value' => $this->input->post('rent_bound') ? $this->input->post('rent_bound') : $house_detail[0]['rent_bound']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Rent per week   <span class="required1">*</span></div>
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
                                'value' => $this->input->post('retailor_company_name') ? $this->input->post('retailor_company_name') : $house_detail[0]['company_name']
                            );
                            echo form_input($data);
                            ?>

                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Realor Name/Contact <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'retailor_name',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('retailor_name') ? $this->input->post('retailor_name') : $house_detail[0]['realtor_name']
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
                                // 'value' => $this->input->post('retailor_bank') ? $this->input->post('retailor_bank') : $house_detail[0]['realtor_bank']
                            // );
                           // echo form_input($data);
                          
                            $retailor_bank_val = $this->input->post('retailor_bank') ? $this->input->post('retailor_bank') : $house_detail[0]['realtor_bank'];
							echo form_dropdown('retailor_bank', $retailor_bank, $retailor_bank_val, 'id="retailor_bank" class="textfield_input required"')
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
                                'value' => $this->input->post('retailot_acc_name') ? $this->input->post('retailot_acc_name') : $house_detail[0]['realtor_account_name']
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
                                'value' => $this->input->post('retailot_acc_no') ? $this->input->post('retailot_acc_no') : $house_detail[0]['realtor_account']
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
                                'id' => 'bsb',
                                'onkeypress' => 'return preventCharecter(event)',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('realtor_account_bsb') ? $this->input->post('realtor_account_bsb') : $house_detail[0]['realtor_account_bsb']
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
                                'value' => $this->input->post('lcd') ? $this->input->post('lcd') : $house_detail[0]['lcd']
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
                                'value' => $this->input->post('led') ? $this->input->post('led') : $house_detail[0]['led']
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
                            if (($this->input->post('internet') ? $this->input->post('internet') : $house_detail[0]['internet']) == '0') {
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

                    <!--for isp-->
                    <div class="user_name_box2">
                        <div class="field_name "> ISP  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'isp',
                                'id' => 'isp',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('isp') ? $this->input->post('isp') : $house_detail[0]['isp']
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
                                'value' => $this->input->post('isp_username') ? $this->input->post('isp_username') : $house_detail[0]['isp_username']
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
                                'value' => $this->input->post('isp_pass') ? $this->input->post('isp_pass') : $house_detail[0]['isp_password']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <!--end isp-->

                    <div class="user_name_box2">
                        <div class="field_name "> Phone number  <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'phone',
                                'id' => 'phone',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('phone') ? $this->input->post('phone') : $house_detail[0]['phone']
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
                                'value' => $this->input->post('ele_comp') ? $this->input->post('ele_comp') : $house_detail[0]['ele_comp']
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
                                'value' => $this->input->post('ele_account') ? $this->input->post('ele_account') : $house_detail[0]['ele_account']
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
                                'value' => $this->input->post('electricity_meter') ? $this->input->post('electricity_meter') : $house_detail[0]['electricity_meter']
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
                                'value' => $this->input->post('electricity_co') ? $this->input->post('electricity_co') : $house_detail[0]['electricity_co']
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
                                'value' => $this->input->post('water_utility_company') ? $this->input->post('water_utility_company') : $house_detail[0]['water_utility_company']
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
                                'value' => $this->input->post('water_account') ? $this->input->post('water_account') : $house_detail[0]['water_account']
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
                                'value' => $this->input->post('water_meter') ? $this->input->post('water_meter') : $house_detail[0]['water_meter']
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
                                'value' => $this->input->post('water_utility_contact') ? $this->input->post('water_utility_contact') : $house_detail[0]['water_utility_contact']
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
                                'value' => $this->input->post('gas_comp') ? $this->input->post('gas_comp') : $house_detail[0]['gas_comp']
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
                                'value' => $this->input->post('gas_account') ? $this->input->post('gas_account') : $house_detail[0]['gas_account']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Landlord  email address <span class="required"></span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'langlord',
                                'id' => 'langlord',
                                'class' => 'textfield_input',
                                'value' => $this->input->post('langlord') ? $this->input->post('langlord') : $house_detail[0]['langlord']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name">Worksite <span class="required1">*</span></div>
                        <div class="text_field_bg_nw">
                            <?php echo form_dropdown('worksite_id', $worksites, ($this->input->post('worksite_id') ? $this->input->post('worksite_id') : $house_detail[0]['worksite_id']), "class = 'textfield_input required' id='worksite'"); ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Insurance  </div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if (($this->input->post('insurance') ? $this->input->post('insurance') : $house_detail[0]['insurance']) == 'no') {
                                $yes = NULL;
                                $no = true;
                            } elseif (($this->input->post('insurance') ? $this->input->post('insurance') : $house_detail[0]['insurance']) == 'yes') {
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
                                'value' => $this->input->post('insurance_company') ? $this->input->post('insurance_company') : $house_detail[0]['insurance_company']
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
                                'value' => $this->input->post('insurance_policy') ? $this->input->post('insurance_policy') : $house_detail[0]['insurance_policy']
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
                            if (($this->input->post('status') ? $this->input->post('status') : $house_detail[0]['status']) == '0') {
                                $yes = NULL;
                                $no = true;
                            } else {
                                $yes = true;
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
                                'value' => $this->input->post('notes') ? $this->input->post('notes') : $house_detail[0]['notes']
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

    </section>
</article>

