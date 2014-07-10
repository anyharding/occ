<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">My Profile</strong>
                </p>
            </div>


        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeftEmployee.php'); ?>
            <section class="contentCol">
                <h2 class="my_profile">My Profile</h2>
                <div class="login_btm">  
                    <div class="usr_img_dtl_top">
                        <div class="profile">
                            <div class="usr_img_dt2"> 	Account Detail </div>
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
                                <div class="left"><div class="usr_img_dtl_lft2">Employee Id:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['id']; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">First Name:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['firstname']; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Last Name:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['lastname']; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Contact No:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['contact_no'] ? $user_detail['contact_no'] : "N/A"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Address:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['address'] ? $user_detail['address'] : "N/A"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Bank:</div>
                                    <div class="usr_img_dtl_right"><?php echo $this->User->getFullbankname($user_detail['bank']); ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Account Name:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['nameofbank'] ? $user_detail['nameofbank'] : "N/A"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Account Number:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['numberofbank'] ? $user_detail['numberofbank'] : "N/A"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">BSB:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['branchofbank'] ? $user_detail['branchofbank'] : 'N/A'; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Start employment date:</div>
                                    <div class="usr_img_dtl_right"><?php if ($user_detail['employmentdate'] <> '') echo date('d M Y ', strtotime($user_detail['employmentdate'])); ?> </div></div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</article>



