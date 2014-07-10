<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon"> <strong class="ribbon-content">Payment Detail</strong> </p>
            </div>
        </section>
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft.php'); ?>
            <section class="contentCol">
                <h2 class="my_profile">Payment Detail</h2>
                <div class="login_btm">
                    <div class="usr_img_dtl_top">
                        <div class="profile">
                            <div class="usr_img_dt2"> Payment Detail </div>
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
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Transaction Id:</div>
                                    <div class="usr_img_dtl_right"><?php echo $payment['id']; ?> </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Contractor Name:</div>
                                    <div class="usr_img_dtl_right"><?php echo $payment['firstname'] . " " . $payment['lastname']; ?> </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Worksite Name:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        echo $payment['company'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Hourly Rate:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['hourlyrate'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Hours Worked:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        echo $payment['hours'];
                                        ?>
                                        Hours </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Gross Wage Amount:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['gross_amount'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Overtime:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        echo $payment['overtime'];
                                        ?>
                                        Hours </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Net Payment Amount:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['net_payment'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Rent Deduction:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['rent_deduction'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Transport Deduction:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['transport_deduction'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Other Deductions:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['other_deduction'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Total Payment Amount:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['total_payment_amount'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Contractor:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['total_payment_amount'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Other Payments:</div>
                                    <div class="usr_img_dtl_right"> $
                                        <?php
                                        echo $payment['other_payments'];
                                        ?>
                                    </div>
                                </div>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Date:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        echo date('M d, Y', $payment['date']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</article>
