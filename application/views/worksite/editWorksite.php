<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(function() {
        $( "#rent_due_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });             
        $("#myform").validate();
    });
</script>
<style>
    label.error{
        display: none !important;
    }
</style>
<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Add New Worksite</strong>
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
            <?php $this->load->view('user/sideBarLeft.php'); ?>
            <section class="contentCol2">

                <div class="left-name3" style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;"> <span class="required1">*</span> Please note that all fields  are required.</div>
                <section class="form_contant_box_nw">
                    <?php echo form_open_multipart('worksite/editWorksite/' . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5), array('name' => 'myform', 'id' => 'myform')); ?>
                    <div class="user_name_box2">
                        <div class="field_name "> Worksite Id  </div>
                        <div class="text_field_bg_nw">
                            <?php
                            echo $edit_worksite[0]['id'];
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Contacted company  </div>
                        <div class="text_field_bg_nw">
                            <?php
                            $data = array(
                                'name' => 'company',
                                'maxlength' => 26,
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('company') ? $this->input->post('company') : $edit_worksite[0]['company']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Worksite Address  </div>
                        <div class="text_field_bg_nw">
                            <?php
                            $data = array(
                                'name' => 'address',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('address') ? $this->input->post('address') : $edit_worksite[0]["address"]
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Contact Number  </div>
                        <div class="text_field_bg_nw">
                            <?php
                            $data = array(
                                'name' => 'contact',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('contact') ? $this->input->post('contact') : $edit_worksite[0]["contact"]
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>
                    <div class="user_name_box2">
                        <div class="field_name site_name_field">S.No</div>
                        <div class="text_field_bg_nw">

                            <div class="site_rate_box_nw1">
                                Site Rate ($)


                            </div>
                            <div class="site_rate_box_nw1">
                                Site Rate Name


                            </div>

                        </div>

                    </div>        
                    <?php
                    for ($i = 1; $i < 16; $i++) {
                        ?>      
                        <div class="user_name_box2">
                            <div class="field_name site_name_field"> <?php echo $i; ?></div>
                            <div class="text_field_bg_nw">

                                <div class="site_rate_box_nw1">

                                    <?php
                                    $data = array('name' => 'site_rate' . $i,
                                        'class' => 'textfield_input_nw3',
                                        'value' => $this->input->post('site_rate' . $i) ? $this->input->post('site_rate' . $i) : ($edit_worksite[0]["site_rate" . $i] == 0 ? "" : $edit_worksite[0]["site_rate" . $i])
                                    );
                                    if ($i < 4) {
                                        $data['class'] = "textfield_input_nw3 required";
                                    }
                                    echo form_input($data);
                                    ?>
                                </div>
                                <div class="site_rate_box_nw1">

                                    <?php
                                    $data = array('name' => 'site_rate_name' . $i,
                                        'class' => 'textfield_input_nw3',
                                        'value' => $this->input->post('site_rate_name' . $i) ? $this->input->post('site_rate_name' . $i) : $edit_worksite[0]["site_rate_name" . $i]
                                    );
                                    if ($i < 4) {
                                        $data['class'] = "textfield_input_nw3 required";
                                    }
                                    echo form_input($data);
                                    ?>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

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
