<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.8.23/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-ui-sliderAccess.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.8.21/themes/ui-lightness/jquery-ui.css" />
<script>

    $(function() {
        $("#time").datepicker({
            changeMonth: true,
            maxDate:new Date(),yearRange: 'c-30:c+10',
            dateFormat: 'yy-mm-dd',
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
                    <strong class="ribbon-content">Add New Household</strong>
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

                    <?php echo form_open_multipart('household/addHousehold', array('name' => 'myform', 'id' => 'myform')); ?>



                    <div class="user_name_box2">
                        <div class="field_name "> Select Household Category   <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            echo form_dropdown('category', $category, $this->input->post('category'), "class='textfield_input required' size='10'");
                            ?>
                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Short description of household item  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'des',
                                'rows' => '4',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("des")
                            );
                            echo form_textarea($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Suppliers Contact Number  <span class="required1">*</span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'contact',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("contact")
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Purchased Date   <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'time', 'readonly' => "readonly",
                                'id' => 'time',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("time")
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Supplier Name   <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'shop',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("shop")
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Receipt Number  <span class="required1">*</span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'receipt',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("receipt")
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Select House  <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $get_houses[''] = "Select house";
                            echo form_dropdown('house', $get_houses, $this->input->post('house'), "id = 'house' class='textfield_input required'");
                            ?> 

                        </div>

                    </div>

                    <div  class="user_name_3">
                        <div class="login_button_2">
                            <input name="Submit" value="Submit" type="submit" class="input_submit" />
                        </div>
                        <div class="login_button_2">
                            <input name="Button" value="Back" type="button" onclick="window.history.back()" class="input_submit" />
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </section>
            </section>  
        </section>


    </section>
</article>
