<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(function() {
        $( "#payment_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
             
        $('#house').change(function(e) {
            $.ajax({
                url: '<?php echo HTTP_PATH; ?>admin/users/getRent/'+this.value,
                type: 'POST',
                cache: false,
                success: function(data)
                {
                    $("#fill").html(data);
                    $("#loading-image").hide();initdatepicker();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error while contacting server, please try again');
                },
                beforeSend:function(){
                    $("#loading-image").show();
                }
            }); 
        });
        $('#c_date').click(function(){
            $( "#payment_date" ).val("<?php echo date('Y-m-d'); ?>");
        });
        $("#myform").validate();
    });
    function initdatepicker(){
        $( ".payment_date1" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        }); 
    }
    $(document).ready(function(){
        initdatepicker();
    });
</script>
<style>
    #c_date{
        background: #6292c2;
        color: white;
        border: 2px solid #eee;
        height: 28px;
        width: 115px;
        margin: 10px 0 0 10px;
        padding: 5px;
        overflow: hidden;
        cursor: pointer;
        display: block;
    }    
</style>
<div style="display: none;" class="load-image" id="loading-image">
    <?php echo img('img/loading4.gif'); ?> 
</div>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Add New Rent Payment</strong>
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
                    <?php echo form_open_multipart('rent/addRent', array('name' => 'myform', 'id' => 'myform')); ?>
                    <div class="user_name_box2">
                        <div class="field_name "> Select House   <span class="required1">*</span>  </div>
                        <div class="text_field_bg err_2">
                            <?php
                            $get_houses[''] = "Select house";
                            echo form_dropdown('house', $get_houses, $this->input->post('house'), "id = 'house' class='select_box required'");
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Payment Amount ($)  <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'amount',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("amount")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Payment Date   <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'payment_date',
                                'id' => 'payment_date', 'readonly' => "readonly",
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("payment_date")
                            );
                            echo form_input($data);
                            ?>
                            <div style="display: inline" id="c_date">use current date</div>
                        </div>
                    </div>
                    <div id="fill">
                        <div class='user_name_box2'>
                            <div class='field_name '> Rent Due Date  <span class='required1'>*</span>  </div>
                            <div class='text_field_bg'>
                                <input type='text' readonly='readonly'  class='textfield_input payment_date1 required'  name='due_date' id='payment_date1'>
                            </div>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name">Paid  <span class="required1">*</span></div>
                        <div class="text_field_bg3 err_0">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->input->post('paid') == 'no') {
                                $yes = NULL;
                                $no = true;
                            } else if ($this->input->post('paid') == 'yes') {
                                $yes = true;
                                $no = NULL;
                            } else {
                                $yes = NULL;
                                $no = NULL;
                            }
                            ?>
                            <?php echo form_radio('paid', 'yes', $yes, "class='required'"); ?><label>YES</label>
                            <?php echo form_radio('paid', 'no', $no, "class='required'"); ?><label>NO</label>
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
