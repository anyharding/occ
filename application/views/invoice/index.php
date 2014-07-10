<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Invoices List </strong>
                </p>
            </div>


        </section>    
        <section class="page-container">

            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol">
                <h2 class="my_profile">Invoices List </h2>
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
                    <?php
                    $payment = $invoice;
                    if (!empty($payment)) {
                        ?>
                        <div class="power_mode_listing_head">
                            <div class="Place_work">Invoice Id</div>
                            <div class="action">Employee </div>
                            <div class="company">Company </div>
                            <div class="action">Gross Wage Amount</div>
                            <div class="action">Action</div>

                        </div>	
                        <?php
                        $i = 0;
                        foreach ($payment as $row) {
                            ?>
                            <div class="power_mode_listing">
                                <div class="Place_work">#<?php
                    echo str_pad($row->invoice_id, 3, "0", STR_PAD_LEFT);
                            ?>
                                </div> 
                                <div class="action"><?php echo $row->firstname . " " . $row->lastname; ?></div>
                                <div class="company"><?php echo $row->company; ?></div>
                                <div class="action">$<?php echo $row->gross_amount; ?></div>
                                <div class="action">
                                    <?php
                                    echo anchor('/invoice/viewInvoice/' . $row->invoice_id . "/" . md5($row->invoice_id), "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' ';
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


