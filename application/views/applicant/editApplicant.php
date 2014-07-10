<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(function() {
        $( "#dob" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(1995, 0, 1),
            changeYear: true
        });        
        $( "#date1" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            changeYear: true
        });
        $( "#date2" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            changeYear: true
        }); 
        $( "#expiry" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            changeYear: true
        });
        
        $("#myform").validate();
    });
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Edit Applicant</strong>
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
            <section class="contentCol2">
                <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
                <section class="form_contant_box_nw">
                    <?php echo form_open_multipart('applicant/editApplicant/' . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5), array('name' => 'myform', 'id' => 'myform')); ?>
                    <div class="user_name_box2">
                        <div class="field_name ">First Name <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'firstname',
                                'class' => 'textfield_input required',
                                'value' => $applicant['firstname']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Last Name <span class="required1">*</span></div>
                        <div class="text_field_bg3">
                            <?php
                            $data = array(
                                'name' => 'lastname',
                                'class' => 'textfield_input required',
                                'value' => $applicant['lastname']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Mobile No </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'mobile',
                                'class' => 'textfield_input',
                                'value' => $applicant['mobile']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Email Address <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'email', 'readonly' => 'readonly',
                                'class' => 'textfield_input required', 'value' => $applicant['email']);
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Referrer </div>
                        <div class="text_field_bg">
                            <?php echo form_dropdown('referrer', $users, $applicant['referrer'], ' class="select_box"'); ?>
                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Gender</div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($applicant['gender'] == 'F') {
                                $male = NULL;
                                $female = true;
                            } else {
                                $male = true;
                                $female = NULL;
                            }
                            echo form_radio('gender', 'M', $male);
                            ?><label>Male</label> &nbsp;
                            <?php echo form_radio('gender', 'F', $female); ?><label>Female</label><?php echo form_error('gender'); ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Height </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'height',
                                'class' => 'textfield_input',
                                'value' => $applicant['height']
                            );
                            echo form_input($data);
                            ?> cm
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Weight </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'weight',
                                'class' => 'textfield_input',
                                'value' => $applicant['weight']
                            );
                            echo form_input($data);
                            ?> kg
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Passport number </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'passport_no',
                                'class' => 'textfield_input',
                                'value' => $applicant['passport_no']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Visa number </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'visa_number',
                                'class' => 'textfield_input',
                                'value' => $applicant['visa_number']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Visa expiry date </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'expiry',
                                'id' => 'expiry',
                                'readonly' => 'readonly',
                                'class' => 'textfield_input',
                                'value' => $applicant['expiry']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Applicant's status <span class="required1">*</span></div>
                        <div class="text_field_bg3">


                            <?php
                            $array = array('selected' => 'selected');
                            if ($applicant['status'] == 'seeking') {
                                $terminated = FALSE;
                                $employed = FALSE;
                                $seeking = true;
                            } else if ($applicant['status'] == 'terminated') {
                                $terminated = true;
                                $employed = FALSE;
                                $seeking = FALSE;
                            } else if ($applicant['status'] == 'employed') {
                                $terminated = FALSE;
                                $employed = true;
                                $seeking = FALSE;
                            } else {
                                $terminated = FALSE;
                                $employed = FALSE;
                                $seeking = FALSE;
                            }
                            echo form_radio('status', 'seeking', $seeking);
                            ?><label>Seeking</label> &nbsp;
                            <?php echo form_radio('status', 'employed', $employed, ' class="required"'); ?><label>Employed</label>
                            <?php echo form_radio('status', 'terminated', $terminated, ' class="required"'); ?><label>Terminated</label>
                        </div>

                    </div>





                    <div class="user_name_box2">
                        <div class="field_name ">Q-fever date 1 </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'date1',
                                'id' => 'date1',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $applicant['date1']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Q-fever date 2 </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'date2',
                                'id' => 'date2',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $applicant['date2']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">English level </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'english',
                                'class' => 'textfield_input',
                                'value' => $applicant['english']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Experience </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'exp',
                                'class' => 'textfield_input',
                                'value' => $applicant['exp']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Vehicle </div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($applicant['vahicle'] == '0') {
                                $yes = NULL;
                                $no = true;
                            } else {
                                $yes = true;
                                $no = NULL;
                            }
                            echo form_radio('vehicle', '1', $yes);
                            ?><label>Yes</label> &nbsp;
                            <?php echo form_radio('vehicle', '0', $no); ?><label>No</label>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name ">Comments </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'comment',
                                'class' => 'textfield_input',
                                'value' => $applicant['comment']
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
</article>

