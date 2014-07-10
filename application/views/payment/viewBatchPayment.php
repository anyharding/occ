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
        $(".textfield_input").numeric();
        $('#worksite').change(function(e) {
            window.location = "<?php echo HTTP_PATH . 'payment/batchPayment/'; ?>"+$('#worksite').val();
        });
    });
    function generateABA() {
        if($("#required").val() == ""){
            alert("Please Select Pay Company");
            return false;
        }else {
            window.open("<?php echo HTTP_PATH . 'payment/addABAGeneration/' . $this->uri->segment(3) . '/' . md5(time()); ?>/"+$("#required").val());
        }
    }
</script>
<style>
    .error-true{
        border: #b9171d solid 1px;
    }
</style>
<article id="content" class="batch_pay batch_pay_view_payment"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_3">
                <p class="ribbon_payment_detail">
                    <strong class="ribbon-content">Batch Payment Details </strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol">
                <h2 class="my_profile">Batch Payment Details </h2>
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
                <div style="margin-bottom: 10px;float: left;width: 1370px;">
                    <div class="text_field_bg">
                        <h3 style="color:#549FC6; display: inline;padding-right: 0px;">Payment period start: </h3>
                        <h3 style="display: inline"><?php echo $payment['payment_start']; ?></h3>
                    </div>
                    <div class="text_field_bg">
                        <h3 style="color:#549FC6; display: inline;padding-right: 0px;">Payment period end: </h3>
                        <h3 style="display: inline"><?php echo $payment['payment_close']; ?></h3>
                    </div>
                    <div class="text_field_bg">
                        <h3 style="color:#549FC6; display: inline;padding-right: 0px;">Worksite: </h3>
                        <h3 style="display: inline"><?php echo $payment['company']; ?></h3>
                    </div>
                </div>
                <div style="margin-bottom: 10px;float: left;width: 1370px;">

                    <div class="text_field_bg">
                        <h3 style="color:#549FC6; display: inline;padding-right: 0px;"> Pay company: </h3>
                        <h3 style="display: inline"><?php echo form_dropdown('pay_company', $this->payment_model->getPayCompany(), "", "class='select_box' style='float:none' id='required'"); ?></h3>
                    </div>
                </div>
                <div class="login_btm">
                    <?php if (!empty($batch_payment)) { ?>
                        <div class="power_mode_listing_head_payment_detail">
                            <div class="company pany_2 pany_2_1">Contractor Name </div>
                            <div class="company pany_2 pany_2_2">Hourly Rate</div>
                            <div class="Place_work Place_2 Place_2_3">Hours Worked </div>

                            <div class="action action21 action21_5">Overtime 1</div>
                            <div class="action action21 action21_5">OT Hour 1</div>
                            <div class="action action21 action21_5">Overtime 2</div>
                            <div class="action action21 action21_5">OT Hour 2</div>
                            <div class="action action21 action21_5">Overtime 3</div>
                            <div class="action action21 action21_5">OT Hour 3</div>

                            <div class="action action_25 action_25_4">Gross Wage Amount</div>
                            <div class="action action_25 action_25_48 ">GST</div>
                            <div class="action action21 action21_6 other_pay">Net Payment Amount</div>
                            <div class="action action21 action21_11 ">Other Payments</div>
                            <div class="action action21 action21_7">Rent Deduction</div>
                            <div class="action action21 action21_8">Transport Deduction</div>
                            <div class="action action21 action21_9">Other Deductions</div>
                            <div class="action action22 action21_10">Invoice remark</div>
                            <div class="action action21 action21_10">Comment</div>
                            <div class="action action23 action21_10">Final Payment Amount</div>

                        </div>	
                        <?php
                        $i = 0;
                        foreach ($batch_payment as $row) {
                            ?>
                            <div class="power_mode_listing_shukha_worker">
                                <div class="company pany_2 pany_2_1">
                                    <?php echo anchor('/users/editUser/' . $row->user_id . "/" . $row->lastname . "/" . $row->house_id . "/" . $row->firstname, $row->lastname . ', ' . $row->firstname, 'title = View Detail'); ?>
                                    <?php echo form_hidden('employee_id[]', $row->id); ?>
                                </div>
                                <div class="company pany_3 pany_2_2">
                                    $<?php
                            echo number_format($row->hourly_rate, 2);
                                    ?>  
                                </div>
                                <div class="action  Place_2_3">
                                    <?php
                                    echo $row->hours;
                                    ?>Hours
                                </div>

                                <div class="action action21_5">
                                    $<?php
                            echo $row->overtime1;
                                    ?> 
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    echo $row->overtimeh1;
                                    ?> Hours
                                </div>
                                <div class="action action21_5">
                                    $<?php
                            echo $row->overtime2;
                                    ?> 
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    echo $row->overtimeh2;
                                    ?> Hours
                                </div>
                                <div class="action action21_5">
                                    $<?php
                            echo $row->overtime3;
                                    ?> 
                                </div>
                                <div class="action action21_5">
                                    <?php
                                    echo $row->overtimeh3;
                                    ?> Hours
                                </div>

                                <div class="action action_25 action_25_4">
                                    $<?php
                            echo number_format($row->gross_amount, 2);
                                    ?>  
                                </div>

                                <div class="action action_25 action_25_48 ">
                                    $<?php
                            echo number_format(($row->gross_amount * 10 / 100), 2);
                                    ?>  
                                </div>

                                <div class="action action21_6 other_pay">
                                    $<?php
                            echo number_format($row->net_payment, 2);
                                    ?>  
                                </div>

                                <div class="action action21 other_pay1">
                                    $<?php
                            echo number_format($row->other_payments, 2);
                                    ?> 
                                </div>
                                <div class="action action21_7">
                                    $<?php
                            echo number_format($row->rent_deduction, 2);
                                    ?> 
                                </div>
                                <div class="action action21_8">
                                    $<?php
                            echo number_format($row->transport_deduction, 2);
                                    ?> 
                                </div>
                                <div class="action action21_9">
                                    $<?php
                            echo number_format($row->other_deduction, 2);
                                    ?> 
                                </div>
                                <div class="action action21_10">
                                    <?php
                                    if ($row->remark) {
                                        echo $row->remark;
                                    } else {
                                        echo "N/A";
                                    }
                                    ?> 
                                </div>
                                <div class="action action21_10_comment">
                                    <?php
                                    if ($row->comment) {
                                        echo $row->comment;
                                    } else {
                                        echo "N/A";
                                    }
                                    ?> 
                                </div>
                                <div class="action action21_10">
                                    $<?php
                            echo number_format($row->total_payment_amount, 2);
                                    ?> 
                                </div>
                            </div>	
                            <?php
                        }
                    } else {
                        ?>
                        <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg">
                        <?php
                    }
                    ?>
                </div>
                <?php if (!empty($batch_payment)) { ?>
                    <span class="aba_file">
                        <a href="javascript:void(0)" target="_blank" class="generate_file" onclick="return generateABA()"><img src="<?php echo HTTP_PATH ?>img/generate.png" alt=""> Generate ABA file</a>
                        <?php // echo anchor('/payment/addABAGeneration/' . $this->uri->segment(3) . "/" . md5(time()), img('img/generate.png') . ' Generate ABA file', array('target' => '_blank', 'class' => 'generate_file', 'onclick' => 'return generate()')) ?>
                    </span>
                    <span class="aba_file">
                        <?php echo anchor('/payment/excelGeneration/' . $this->uri->segment(3) . "/" . md5(time()), img('img/generate.png') . ' Generate Excel file', array('target' => '_blank', 'class' => 'generate_file')) ?>
                    </span>
                <?php } ?>
            </section>
        </section>
    </section>
</article>


