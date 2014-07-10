<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<!--<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>-->
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    //http://en.wikipedia.org/wiki/Lists_of_people_by_nationality
    $(document).ready(function(){
    
        if($('input:radio[name=statusofabn]:checked').val()=='1'){
            $("#namebank").show(1000);   
        }
        if($('input:radio[name=statusofabn]:checked').val()=='2'){
            $("#namebank").hide(500);   
        }
      
    });
    $(function() {
        $( "#dob" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            maxDate:new Date(),
            changeYear: true
        });
        $( "#firstvisastart" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });
        $( "#firstvisaend" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });
        $( "#secondvisastart" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });
        $( "#secondvisaend" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });
        $( "#employmentdate" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });        

    });
    function showhide()
    {                  
        if($('input:radio[name=statusofabn]:checked').val()=='1'){
            $("#namebank").show(1000);   
        }
        if($('input:radio[name=statusofabn]:checked').val()=='2'){
            $("#namebank").hide(500);   
        }
    }
</script>


<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Edit Profile</strong>
                </p>
            </div>


        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>

            <section class="contentCol">
                <h2 class="my_profile">Edit Profile</h2>

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
                    <div class="contact-container">
                        <?php echo form_open('welcome/editProfile'); ?>
                        <div class="left-name2" style="text-align: left; width:700px;"> <span class="red-mark">*</span> Please note that all fields that have an asterisk (*) are required.</div>

                        <div class="cntct_mdl">
                            <div class="left-name">First Name <span class="red-mark">*</span> </div>
                            <div class="text_field_bg right-inputs_2">
                                <?php echo form_input(array('name' => 'firstname', 'class' => 'textfield_input', 'id' => 'firstname', 'value' => $this->input->post('firstname') ? $this->input->post('firstname') : $user_detail[0]['firstname'])) ?>
                            </div>
                        </div>
                        <div class="cntct_mdl">
                            <div class="left-name">Last Name <span class="red-mark">*</span></div>
                            <div class="text_field_bg right-inputs_2">
                                <?php echo form_input(array('name' => 'lastname', 'class' => 'textfield_input', 'id' => 'lastname', 'value' => $this->input->post('lastname') ? $this->input->post('lastname') : $user_detail[0]['lastname'])) ?>
                            </div>
                        </div>
                        <div class="cntct_mdl">
                            <div class="left-name">Username <span class="red-mark">*</span></div>
                            <div class="text_field_bg right-inputs_2">
                                <?php echo form_input(array('name' => 'username', 'class' => 'textfield_input', 'id' => 'username', 'value' => $this->input->post('username') ? $this->input->post('username') : $user_detail[0]['username'])) ?>
                            </div>
                        </div>
                        <div class="cntct_mdl">
                            <div class="left-name">Email Address  </div>
                            <div class="text_field_bg right-inputs_2">
                                <?php echo form_input(array('name' => 'email', 'disabled' => 'disabled', 'class' => 'textfield_input', 'id' => 'email', 'value' => $this->input->post('email') ? $this->input->post('email') : $user_detail[0]['email'])) ?>
                            </div>
                        </div>
                        <div class="cntct_mdl">
                            <div class="left-name">Contact Number  </div>
                            <div class="text_field_bg right-inputs_2">
                                <?php
                                $data = array(
                                    'name' => 'contact',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('contact') ? $this->input->post('contact') : $user_detail[0]['contact_no']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>

                        <?php
                        if ($user_detail[0]['role'] == 3) {
                            ?>

                            <div class="cntct_mdl">
                                <div class="left-name">Position</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $options = array('1' => 'General hand', '2' => 'Slicer', '3' => 'Boner', '4' => 'Packer', '5' => 'Floor boy', '6' => 'Maintenance', '7' => 'Cleaning', '8' => 'Loading', '8' => 'Other');
                                    $nextselected = array($user_detail[0]['position']);
                                    echo form_dropdown('position', $options, $nextselected, ' class="select_box"');
                                    ?>
                                </div>
                            </div>

                            <div class="cntct_mdl">
                                <div class="left-name">Visa Type</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $visaoptions = array('1' => 'Working holiday', '2' => 'Dependant 457 visa full work rights', '3' => 'PR/citizen', '4' => 'Bridging visa full work rights', '5' => 'Other visa', '6' => 'Limited work rights');
                                    $visaselected = array($user_detail[0]['visa_type']);
                                    echo form_dropdown('visa_type', $visaoptions, $visaselected, ' class="select_box" ');
                                    ?>
                                </div>
                            </div>


                            <div class="cntct_mdl">
                                <div class="left-name">Account Name</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $data = array(
                                        'name' => 'nameofbank',
                                        'class' => 'textfield_input',
                                        'id' => 'nameofbank',
                                        'value' => $user_detail[0]['nameofbank']
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>

                            <div class="cntct_mdl">
                                <div class="left-name">Account Number</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $data = array(
                                        'name' => 'numberofbank',
                                        'class' => 'textfield_input',
                                        'value' => $user_detail[0]['numberofbank']
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>
                            <div class="cntct_mdl">
                                <div class="left-name">BSB </div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $data = array(
                                        'name' => 'branchofbank',
                                        'class' => 'textfield_input',
                                        'value' => $user_detail[0]['branchofbank']
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>


                            <div class="cntct_mdl">
                                <div class="left-name">Hourly rate description</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $data = array(
                                        'name' => 'hourlyrate_des', 'rows' => "5",
                                        'cols' => "40",
                                        'class' => 'textfield_input',
                                        'value' => $user_detail[0]['hourlyrate_des']
                                    );
                                    echo form_textarea($data);
                                    ?>
                                </div>
                            </div>

                            <div class="cntct_mdl">
                                <div class="left-name">Total One Off Deductions  ($)</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $data = array(
                                        'name' => 'deductions',
                                        'class' => 'textfield_input',
                                        'value' => $user_detail[0]['deductions']
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>


                            <div class="cntct_mdl">
                                <div class="left-name">Reasons for Deductions</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $data = array(
                                        'name' => 'reason_deductions',
                                        'class' => 'textfield_input',
                                        'value' => $user_detail[0]['reason_deductions']
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>
                            <div class="cntct_mdl">
                                <div class="left-name">Weekly rent rate  ($)</div>
                                <div class="text_field_bg right-inputs_2">
                                    <?php
                                    $data = array(
                                        'name' => 'weeklyrent',
                                        'class' => 'textfield_input',
                                        'value' => $user_detail[0]['weeklyrent']
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>

                            <?php
                        }
                        ?>

                        <div class="cntct_mdl">
                            <div class="left-name">&nbsp;</div>
                            <div class="right-inputs">
                                <input type="submit" name="submit" value="Update" class="update_btn" >

                            </div>
                        </div>
                        <?php echo form_close(); ?> 
                    </div>

                </div>



            </section>

        </section>





    </section>
</article>


