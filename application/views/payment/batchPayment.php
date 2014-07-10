<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.numeric.js"></script>
<script type="text/javascript">
    function validate(){
        var flag = 1;
        $('.required_true').map(function() {
            var value= $(this).val();
            //var id=this.id;
            if(value=="")
            { 
                flag = 0;
                $(this).addClass('error-true');
                return false;
                    
            }else
            {   
                $(this).removeClass('error-true'); 
            } 
        });
        if(flag == 1 ) {
            return true;
        }
        alert('Hours Worked fields is required');
        return false;
    }
    $(".textfield_input").numeric();
    $(document).ready(function(){
        $('.required_true').dblclick(function() {
            $(this).addClass('error-true');
            return false;
        });
        $(".textfield_input").numeric();
        $('#worksite').change(function(e) {
            window.location = "<?php echo HTTP_PATH . 'payment/batchPayment/'; ?>"+$('#worksite').val();
        });
        $( "#payment_start" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });  
        $( "#payment_close" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });  
    });

</script>
<style>
    .error-true{
        border: #b9171d solid 1px;
    }
</style>
<article id="content" class="batch_pay"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon_batch_payment">
                    <strong class="ribbon-content">Batch Payment Processing </strong>
                </p>
            </div>


        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol batch-payment">
                <h2 class="my_profile">Batch Payment Processing </h2>
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

                <?php echo form_open_multipart('payment/addBatchPayment', array('name' => 'myform', 'onsubmit' => 'return validate()')); ?>
                <div style="margin-bottom: 20px;width: 858px;float: left;">
                    <div class="batch-upper-filds">
                        <div class="field_name"><b>Select Worksite </b></div>
                        <div class="text_field_bg">
                            <?php echo form_dropdown('worksite_id', $worksites, $this->uri->segment(3), "class = 'textfield_input' id='worksite'"); ?>
                        </div>
                    </div>
                    <?php
                    if (!empty($users)) {
                        ?>
                        <div class="batch-upper-filds">
                            <div class="field_name"><b>Payment period start </b></div>
                            <div class="text_field_bg">
                                <?php echo form_input('payment_start', date('Y-m-d'), "class = 'textfield_input' id='payment_start' readonly='readonly'"); ?>
                            </div>
                        </div>
                        <div class="batch-upper-filds">
                            <div class="field_name"><b>Payment period end </b></div>
                            <div class="text_field_bg">
                                <?php echo form_input('payment_close', date('Y-m-d'), "class = 'textfield_input' id='payment_close' readonly='readonly'"); ?>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="login_btm">
                    <?php if (!empty($users)) { ?>
                        <div class="power_mode_listing_head">
                            <div class="company pany_2 pany_2_11">AdminID </div>
                            <div class="company pany_2 pany_2_1">Contractor Name </div>
                            <div class="company pany_2 pany_2_2">Hourly Rate</div>
                            <div class="Place_work Place_2 Place_2_3">Hours Worked <span class="required">*</span></div>

                            <div class="action action21 action21_5">Overtime 1</div>
                            <div class="action action21 action21_5">OT Hour 1</div>
                            <div class="action action21 action21_5">Overtime 2</div>
                            <div class="action action21 action21_5">OT Hour 2</div>
                            <div class="action action21 action21_5">Overtime 3</div>
                            <div class="action action21 action21_5">OT Hour 3</div>

                            <div class="action action_25 action_25_4">Gross Wage Amount</div>
                            <div class="action action_25 action_25_4">GST</div>
                            <div class="action action21 action21_6">Net Payment Amount</div>
                            <div class="action action21 action21_11">Other Payments</div>
                            <div class="action action21 action21_7">Rent Deduction</div>
                            <div class="action action21 action21_8">Transport Deduction</div>
                            <div class="action action21 action21_9">Other Deductions</div>
                            <div class="action action22 action21_9_comment">Invoice remark</div>
                            <div class="action action22 action21_9_comment">Comment</div>
                            <div class="action action21 action21_10_comment">Final Payment Amount</div>

                        </div>	
                        <?php
                        $i = 0;
                        foreach ($users as $row) {
                            ?>

                            <script>
                                $(document).ready(function(){
                                    $('#hours<?php echo $row->id; ?>').keyup(function(){
                                        var hourly_rate_employee = $("#hourly_rate<?php echo $row->id; ?>").val();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());                                  
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());                                  
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());                                                                                                                                                                                                                                                    
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;
                                        if(isNaN(overtime_payment)) { 
                                            overtime_payment = 0;
                                        }               
                                        var gst = (hourly_rate_employee * this.value) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var gross_service_text = (parseFloat(overtime_payment)+parseFloat(gst))*10/100;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text);
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gst) + parseFloat(overtime_payment));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
                                    });
                                    $('#overtime<?php echo $row->id; ?>').keyup(function(){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                                        var gross_weg_amount = $("#gst<?php echo $row->id; ?>").val();
                                        var gross_service_text = (parseFloat(overtime_payment)+parseFloat(gross_weg_amount))*10/100;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text); 
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount) + parseFloat(overtime_payment));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                    $('#rent_deduction<?php echo $row->id; ?>').keyup(function(){
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        var total_payment = net_payment_amount - rent_deduction - transport_deduction - other_deduction;
                                        if (isNaN(total_payment)) total_payment = 0;
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(total_payment);
                                    });
                                    $('#transport_deduction<?php echo $row->id; ?>').keyup(function(){
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        var total_payment = net_payment_amount - rent_deduction - transport_deduction - other_deduction;
                                        if (isNaN(total_payment)) total_payment = 0;
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(total_payment);
                                    });
                                    $('#other_deduction<?php echo $row->id; ?>').keyup(function(){
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        var total_payment = net_payment_amount - rent_deduction - transport_deduction - other_deduction;
                                        if (isNaN(total_payment)) total_payment = 0;
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(total_payment);
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                    $('#hours<?php echo $row->id; ?>').change(function(){
                                        var hourly_rate_employee = $("#hourly_rate<?php echo $row->id; ?>").val();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                        if(isNaN(overtime_payment)) {
                                            overtime_payment = 0;
                                        }                                                   
                                        var gst = (hourly_rate_employee * this.value) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);                                                                                                                                                                                                                                                                                   
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var gross_service_text = (parseFloat(overtime_payment)+parseFloat(gst))*10/100;
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gst) + parseFloat(overtime_payment));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    $('#overtime1<?php echo $row->id; ?>').change(function(){
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                        var gst = ($("#hourly_rate<?php echo $row->id; ?>").val() *  $('#hours<?php echo $row->id; ?>').val()) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        var gross_weg_amount = gst;
                                        var gross_service_text = parseFloat(gross_weg_amount)*10/100;
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text);   
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount));                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(parseFloat(net_payment_amount - rent_deduction - transport_deduction - other_deduction));
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    $('#overtime2<?php echo $row->id; ?>').change(function(){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                                        var gst = ($("#hourly_rate<?php echo $row->id; ?>").val() *  $('#hours<?php echo $row->id; ?>').val()) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        var gross_weg_amount = gst;
                                        var gross_service_text = parseFloat(gross_weg_amount)*10/100;
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text);   
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    $('#overtime3<?php echo $row->id; ?>').change(function(){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                                        var gst = ($("#hourly_rate<?php echo $row->id; ?>").val() *  $('#hours<?php echo $row->id; ?>').val()) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        var gross_weg_amount = gst;
                                        var gross_service_text = parseFloat(gross_weg_amount)*10/100;
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text);   
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(net_payment_amount - rent_deduction - transport_deduction - other_deduction);
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    $('#overtimeh1<?php echo $row->id; ?>').change(function(){
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                                        var gst = ($("#hourly_rate<?php echo $row->id; ?>").val() *  $('#hours<?php echo $row->id; ?>').val()) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        var gross_weg_amount = gst;
                                        var gross_service_text = parseFloat(gross_weg_amount)*10/100;
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text);   
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(parseFloat(net_payment_amount - rent_deduction - transport_deduction - other_deduction));
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    $('#overtimeh2<?php echo $row->id; ?>').change(function(){
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                        var gst = ($("#hourly_rate<?php echo $row->id; ?>").val() *  $('#hours<?php echo $row->id; ?>').val()) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        var gross_weg_amount = gst;
                                        var gross_service_text = parseFloat(gross_weg_amount)*10/100;
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text);   
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(parseFloat(net_payment_amount - rent_deduction - transport_deduction - other_deduction));
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    $('#overtimeh3<?php echo $row->id; ?>').change(function(){
                                        var hourly_rate = parseFloat($("#overtimeh1<?php echo $row->id; ?>").val());
                                        var overtime_payment1 = parseFloat(hourly_rate *  $('#overtime1<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate2 = parseFloat($("#overtimeh2<?php echo $row->id; ?>").val());
                                        var overtime_payment2 = parseFloat(hourly_rate2 *  $('#overtime2<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        var hourly_rate3 = parseFloat($("#overtimeh3<?php echo $row->id; ?>").val());
                                        var overtime_payment3 = parseFloat(hourly_rate3 *  $('#overtime3<?php echo $row->id; ?>').val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        if (isNaN(overtime_payment1)) overtime_payment1 = 0;
                                        if (isNaN(overtime_payment2)) overtime_payment2 = 0;
                                        if (isNaN(overtime_payment3)) overtime_payment3 = 0;
                                        var overtime_payment =   overtime_payment1 +   overtime_payment2 +   overtime_payment3 ;                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                        var gst = ($("#hourly_rate<?php echo $row->id; ?>").val() *  $('#hours<?php echo $row->id; ?>').val()) + overtime_payment;
                                        $("#gst<?php echo $row->id; ?>").val(gst);                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        var gross_weg_amount = gst;
                                        var gross_service_text = parseFloat(gross_weg_amount)*10/100;
                                        $("#tax<?php echo $row->id; ?>").val(gross_service_text);   
                                        $("#net_payment<?php echo $row->id; ?>").val(parseFloat(gross_service_text) + parseFloat(gross_weg_amount));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(parseFloat(net_payment_amount - rent_deduction - transport_deduction - other_deduction));
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    $('#rent_deduction<?php echo $row->id; ?>').change(function(){
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        var total_payment = net_payment_amount - rent_deduction - transport_deduction - other_deduction;
                                        if (isNaN(total_payment)) total_payment = 0;
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(total_payment);
                                    });
                                    $('#transport_deduction<?php echo $row->id; ?>').change(function(){
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        var total_payment = net_payment_amount - rent_deduction - transport_deduction - other_deduction;
                                        if (isNaN(total_payment)) total_payment = 0;
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(total_payment);
                                    });
                                    $('#other_deduction<?php echo $row->id; ?>').change(function(){
                                        var net_payment_amount = parseFloat($("#net_payment<?php echo $row->id; ?>").val());
                                        var rent_deduction = parseFloat($("#rent_deduction<?php echo $row->id; ?>").val());
                                        var transport_deduction = parseFloat($("#transport_deduction<?php echo $row->id; ?>").val());
                                        var other_deduction = parseFloat($("#other_deduction<?php echo $row->id; ?>").val());
                                        var total_payment = net_payment_amount - rent_deduction - transport_deduction - other_deduction;
                                        if (isNaN(total_payment)) total_payment = 0;
                                        $("#total_payment_amount<?php echo $row->id; ?>").val(total_payment);
                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                });
                            </script>

                            <div class="power_mode_listing">
                                <div class="company pany_2 pany_2_11">
                                    <?php echo anchor('/users/editUser/' . $row->id . "/" . $row->lastname . "/" . $row->house_id . "/" . $row->firstname, $row->admin_id, 'title = View Detail'); ?>
                                 </div>
                                <div class="company pany_2 pany_2_1">
                                    <?php echo anchor('/users/editUser/' . $row->id . "/" . $row->lastname . "/" . $row->house_id . "/" . $row->firstname, $row->lastname . ', ' . $row->firstname, 'title = View Detail'); ?>
                                    <?php echo form_hidden('employee_id[]', $row->id); ?>
                                </div>
                                <div class="company pany_3 pany_2_2">
                                    <?php
                                    $data = array('class' => 'textfield_input rate_hr1', 'id' => 'hourly_rate' . $row->id, 'name' => 'hourly_rate[]', 'value' => $row->hourlyrate);
                                    echo form_input($data);
                                    ?>  $
                                </div>
                                <div class="action  Place_2_3">
                                    <?php
                                    $data = array(
                                        'id' => 'hours' . $row->id,
                                        'class' => 'textfield_input rate_hr2 required_true',
                                        'name' => 'hours[]'
                                    );
                                    echo form_input($data);
                                    ?>Hours <span class="required">*</span>
                                </div>

                                <div class="action action21_5">
                                    <?php
                                    $data = array(
                                        'name' => 'overtime1[]',
                                        'class' => 'textfield_input rate_hr4',
                                        'id' => 'overtime1' . $row->id
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    $data = array(
                                        'name' => 'overtimeh1[]',
                                        'class' => 'textfield_input rate_hr4',
                                        'id' => 'overtimeh1' . $row->id
                                    );
                                    echo form_input($data);
                                    ?> Hours
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    $data = array(
                                        'name' => 'overtime2[]',
                                        'class' => 'textfield_input rate_hr4',
                                        'id' => 'overtime2' . $row->id
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    $data = array(
                                        'name' => 'overtimeh2[]',
                                        'class' => 'textfield_input rate_hr4',
                                        'id' => 'overtimeh2' . $row->id
                                    );
                                    echo form_input($data);
                                    ?> Hours
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    $data = array(
                                        'name' => 'overtime3[]',
                                        'class' => 'textfield_input rate_hr4',
                                        'id' => 'overtime3' . $row->id
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    $data = array(
                                        'name' => 'overtimeh3[]',
                                        'class' => 'textfield_input rate_hr4',
                                        'id' => 'overtimeh3' . $row->id
                                    );
                                    echo form_input($data);
                                    ?> Hours
                                </div>

                                <div class="action action_25_4">
                                    <?php
                                    $data = array(
                                        'name' => 'gst[]',
                                        'readonly' => 'readonly',
                                        'class' => 'textfield_input rate_hr3',
                                        'id' => 'gst' . $row->id
                                    );
                                    echo form_input($data);
                                    ?> $
                                </div>

                                <div class="action action_25_4" >
                                    <?php
                                    $data = array(
                                        'name' => 'tax[]',
                                        'readonly' => 'readonly',
                                        'class' => 'textfield_input rate_hr3',
                                        'id' => 'tax' . $row->id
                                    );
                                    echo form_input($data);
                                    ?>$
                                </div>

                                <div class="action action21_6">
                                    <?php
                                    $data = array(
                                        'name' => 'net_payment[]',
                                        'readonly' => 'readonly',
                                        'class' => 'textfield_input rate_hr5',
                                        'id' => 'net_payment' . $row->id
                                    );
                                    echo form_input($data);
                                    ?>  $
                                </div>
                                <div class="action action21">
                                    <?php
                                    $data = array(
                                        'name' => 'other_payments[]',
                                        'class' => 'textfield_input rate_hr10',
                                        'id' => 'other_payments' . $row->id
                                    );
                                    echo form_input($data);
                                    ?> $
                                </div>
                                <div class="action action21_7">
                                    <?php
                                    $data = array(
                                        'name' => 'rent_deduction[]',
                                        'id' => 'rent_deduction' . $row->id,
                                        'class' => 'textfield_input rate_hr6',
                                        'value' => 0
                                    );
                                    echo form_input($data);
                                    ?> $
                                </div>
                                <div class="action action21_8">
                                    <?php
                                    $data = array(
                                        'name' => 'transport_deduction[]',
                                        'class' => 'textfield_input rate_hr7',
                                        'id' => 'transport_deduction' . $row->id,
                                        'value' => 0
                                    );
                                    echo form_input($data);
                                    ?> $
                                </div>
                                <div class="action action21_9">
                                    <?php
                                    $data = array(
                                        'name' => 'other_deduction[]',
                                        'id' => 'other_deduction' . $row->id,
                                        'class' => 'textfield_input rate_hr8',
                                        'value' => 0
                                    );
                                    echo form_input($data);
                                    ?> $
                                </div>


                                <div class="action action22">
                                    <?php
                                    $data = array(
                                        'name' => 'remark[]',
                                        'class' => 'textfield_input1 rate_hr11'
                                    );
                                    echo form_input($data);
                                    ?> 
                                </div>

                                <div class="action action22">
                                    <?php
                                    $data = array(
                                        'name' => 'comment[]',
                                        'class' => 'textfield_input1 rate_hr11',
                                    );
                                    echo form_input($data);
                                    ?> 
                                </div>



                                <div class="action action21_10">
                                    <?php
                                    $data = array(
                                        'name' => 'total_payment_amount[]',
                                        'class' => 'textfield_input rate_hr9',
                                        'readonly' => 'readonly',
                                        'id' => 'total_payment_amount' . $row->id
                                    );
                                    echo form_input($data);
                                    ?> $
                                </div>

                            </div>	
                            <?php
                        }
                    } else {
                        ?>
                        <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg">
                        <?php
                    }
                    if (!empty($users)) {
                        ?>
                        <div  class="user_name_4">
                            <div class="login_button_2">
                                <input name="Submit" value="Submit" type="submit" class="input_submit" />
                            </div>
                            <div class="login_button_2">
                                <input name="Button" value="Reset" type="reset"  class="input_submit" />
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php echo form_close(); ?>
                <div class="pagination_new">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </section>
        </section>
    </section>
</article>


