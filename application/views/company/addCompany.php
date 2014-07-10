<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script>
    $(document).ready(function(){
        $("#myform").validate();
    });
</script>



<article id="content"><!-- Page Content -->




    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Add Company</strong>
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

                    <?php echo form_open_multipart('company/addCompany', array('name' => 'myform', 'id' => 'myform')); ?>
                    <div class="user_name_box2">
                        <div class="field_name ">Company Name <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'company',
                                'id' => 'company',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('company')
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> ABN  <span class="required1">*</span> </div>
                        <div class="text_field_bg">

                            <?php
                            $data = array(
                                'name' => 'abn',
                                'id' => 'abn',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('abn')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> ACN  <span class="required1">*</span> </div>
                        <div class="text_field_bg">

                            <?php
                            $data = array(
                                'name' => 'acn',
                                'id' => 'acn',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('acn')
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">Company Address <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'address',
                                'class' => 'textfield_input required',
                                'value' => set_value("address")
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

