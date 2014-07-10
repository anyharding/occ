<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Payment Detail</strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeftEmployee.php'); ?>
            <section class="contentCol">
                <h2 class="my_profile">Payment Detail</h2>
                <div class="login_btm">  
                    <div class="usr_img_dtl_top">
                        <div class="profile">
                            <div class="usr_img_dt2"> 	Payment Detail </div>
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
                            <div class="usr_img_dtl">
                                <div class="left"><div class="usr_img_dtl_lft2">Hourly Rate:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo "$" . $payment['hourly_rate'];
                                        ?> 
                                    </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Hours Worked:</div>
                                    <div class="usr_img_dtl_right"> <?php
                                        echo $payment['hours'];
                                        ?> Hours </div></div>
                                <!---------------------------------------->
                                <div class="left"><div class="usr_img_dtl_lft2">Overtime 1:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['overtime1'] ? "$" . $payment['overtime1'] : "N/A";
                                        ?> 
                                    </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">OT Hour 1:</div>
                                    <div class="usr_img_dtl_right"> <?php
                                        echo $payment['overtimeh1'] ? $payment['overtimeh1'] : "N/A";
                                        ?> Hours </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Overtime 2:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['overtime2'] ? "$" . $payment['overtime2'] : "N/A";
                                        ?> 
                                    </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">OT Hour 2:</div>
                                    <div class="usr_img_dtl_right"> <?php
                                        echo $payment['overtimeh2'] ? $payment['overtimeh2'] . " Hours" : "N/A";
                                        ?>  </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Overtime 3:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['overtime3'] ? "$" . $payment['overtime3'] : "N/A";
                                        ?> 
                                    </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">OT Hour 3:</div>
                                    <div class="usr_img_dtl_right"> <?php
                                        echo $payment['overtimeh3'] ? $payment['overtimeh3'] . " Hours" : "N/A";
                                        ?>  </div></div>
                                <!---------------------------------------->
                                <div class="left"><div class="usr_img_dtl_lft2">Gross Wage Amount:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['gross_amount'] ? "$" . $payment['gross_amount'] : "N/A";
                                        ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">GST Amount:</div>
                                    <div class="usr_img_dtl_right"> 
                                        $<?php
                                        echo (($payment['hourly_rate'] * $payment['hours']) + ($payment['overtime1'] * $payment['overtimeh1']) + ($payment['overtime2'] * $payment['overtimeh2']) + ($payment['overtime3'] * $payment['overtimeh3'])) * 10 / 100;
                                        ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Net Payment Amount:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['net_payment'] ? "$" . $payment['net_payment'] : "N/A";
                                        ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Rent Deduction:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['rent_deduction'] ? "$" . $payment['rent_deduction'] : "N/A";
                                        ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Transport Deduction:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['transport_deduction'] ? "$" . $payment['transport_deduction'] : "N/A";
                                        ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Other Deductions:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['other_deduction'] ? "$" . $payment['other_deduction'] : "N/A";
                                        ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Invoice remark:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['remark'] ? $payment['remark'] : "N/A";
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Comment:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['comment'] ? $payment['comment'] : "N/A";
                                        ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">Total Payment Amount:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['total_payment_amount'] ? "$" . $payment['total_payment_amount'] : "N/A";
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Other Payments:</div>
                                    <div class="usr_img_dtl_right"> 
                                        <?php
                                        echo $payment['other_payments'] ? "$" . $payment['other_payments'] : "N/A";
                                        ?> </div></div>



                            </div>
                        </div>



                    </div>

                </div>

            </section>

        </section>





    </section>
</article>



