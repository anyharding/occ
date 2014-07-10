<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Payments List </strong>
                </p>
            </div>


        </section>    
        <section class="page-container">

            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol">
                <h2 class="my_profile">Payments List </h2>
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

                <div class="login_btm">
                    <?php if (!empty($payment)) { ?>
                        <div class="power_mode_listing_head">
                            <div class="Place_work">Contractor</div>
                            <div class="Place_work">Batch Payment Date</div>
                            <div class="action">Gross Wage Amount</div>
                            <div class="action">Total Payment Amount</div>
                            <div class="action">Action</div>

                        </div>	
                        <?php
                        $i = 0;
                        foreach ($payment as $row) {
                            ?>
                            <div class="power_mode_listing">
                                <div class="Place_work"><?php echo $row->lastname . ", " . $row->firstname; ?></div> 
                                <div class="Place_work"><?php echo date('M d, Y', $row->date); ?></div> 
                                <div class="action">$<?php echo $row->gross_amount; ?></div>
                                <div class="action">$<?php echo $row->total_payment_amount; ?></div>
                                <div class="action">
                                    <?php
                                    echo anchor('/payment/viewPaymentEmployee/' . $row->batch_id . "/" . $row->user_id, "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' ';
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
                <div class="pagination_new">
                    <?php echo $this->pagination->create_links(); ?>

                </div>
            </section>

        </section>





    </section>
</article>


