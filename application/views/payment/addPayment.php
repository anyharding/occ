<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(document).ready(function(){
        $('#employee').change(function() {
            if(this.value != "") {
                $.ajax({
                    url:"<?php echo HTTP_PATH . "admin/payment/getUserInfo" ?>/"+this.value,
                    success:function(data){
                        var record = data.split("::");
                        $("#worksite").val(record[0]);
                        $("#name").val(record[1]);
                        $("#hourly_rate").val(record[2]);
                    }
                });
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
<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Add Contractor Payment</strong>
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
            <section class="contentCol2 add-payment">
                <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
                <section class="form_contant_box_nw">

                    <?php echo form_open_multipart('payment/addPayment', array('name' => 'myform')); ?>


                    <div class="user_name_box2">
                        <div class="field_name "> Select Contractor    <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php echo form_dropdown('employee_id', $users, $this->input->post('employee_id'), 'id="employee" class  = "textfield_input"'); ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Worksite   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'worksite',
                                'id' => 'worksite',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $this->input->post('worksite')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Contractor Name   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'name', 'class' => 'textfield_input', 'readonly' => 'readonly', 'id' => 'name', 'value' => $this->input->post('name'));
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Hourly Rate   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('readonly' => 'readonly', 'class' => 'textfield_input', 'id' => 'hourly_rate', 'name' => 'hourly_rate', 'value' => $this->input->post('hourly_rate'));
                            echo form_input($data);
                            ?>  $
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Hours Worked  <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'id' => 'hours',
                                'class' => 'textfield_input',
                                'name' => 'hours'
                            );
                            echo form_input($data);
                            ?> Hours
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Gross Wage Amount   <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'gst',
                                'readonly' => 'readonly',
                                'class' => 'textfield_input',
                                'id' => 'gst'
                            );
                            echo form_input($data);
                            ?> $
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Overtime   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'overtime',
                                'class' => 'textfield_input',
                                'id' => 'overtime'
                            );
                            echo form_input($data);
                            ?> Hours
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Net Payment Amount  <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'net_payment',
                                'readonly' => 'readonly',
                                'class' => 'textfield_input',
                                'id' => 'net_payment'
                            );
                            echo form_input($data);
                            ?>  $
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Rent Deduction   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'rent_deduction',
                                'id' => 'rent_deduction',
                                'class' => 'textfield_input',
                                'value' => 0
                            );
                            echo form_input($data);
                            ?> $
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Transport Deduction  <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'transport_deduction',
                                'class' => 'textfield_input',
                                'id' => 'transport_deduction',
                                'value' => 0
                            );
                            echo form_input($data);
                            ?> $
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Other Deductions   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'other_deduction',
                                'id' => 'other_deduction',
                                'class' => 'textfield_input',
                                'value' => 0
                            );
                            echo form_input($data);
                            ?> $
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Total Payment Amount   <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'total_payment_amount',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'id' => 'total_payment_amount'
                            );
                            echo form_input($data);
                            ?> $
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Other Payments   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'other_payments',
                                'class' => 'textfield_input',
                                'id' => 'other_payments'
                            );
                            echo form_input($data);
                            ?> $
                        </div>
                    </div>

                    <div id="fill">

                    </div>
                    <div  class="user_name_3">
                        <div class="login_button_2">
                            <input name="Submit" value="Submit" type="submit" class="input_submit" />
                        </div>
                        <div class="login_button_2">
                            <input name="Button" value="Reset" type="reset"  class="input_submit" />
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </section>
            </section>  
        </section>  



    </section>
</article>
