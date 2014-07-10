<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script><script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.pstrength-min.1.2.js"></script>
<script type="text/javascript">
    $(function() {
        $('.password').pstrength();
<?php if (form_error('date_check')) { ?>
            if (window.location.hash == "") {
                window.location = window.location + "#probation";
            }
<?php } ?>
    });
    function preventCharecter(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)){  
            return false;
        }
    }
</script>
<style>
    .password {
        background: none repeat scroll 0 0 transparent;
        border: medium none;
        font-size: 12px;
        height: 23px;
        margin: 0;
        padding-left: 3px;
        padding-top: 5px;
        width: 205px;
    }
    .pstrength-minchar {
        font-size : 10px;
    }
    .rent_label label.error{
        margin-top: -23px !important;
    }
</style>
<script>
    $(function() {
        $("#dob").datepicker({
            changeMonth: true,
            maxDate:new Date(),yearRange: 'c-30:c+10',
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });
        $( "#visa_expiry_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            minDate:"2000-1-1",
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
        $( "#address_update_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });

        $( "#q1" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
        });
        $( "#q2" ).datepicker({
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

    function popitup() {
        window.open ("<?php echo HTTP_PATH . 'welcome/termAndConditions' ?>", "mywindow","location=1,status=1,scrollbars=1, width=1000,height=500");

    }

    $(document).ready(function(){
        $('#worksite').change(function(e) {
            $('#examples').fadeIn();
            $('#site_rate').load('<?php echo HTTP_PATH; ?>users/getWorksiteRateAndName/'+this.value);
            $('#examples').fadeOut();
        });
        $('#site_rate').change(function(e) {
            var arr = this.value.split('||');
            $("#rate_value").val(arr[0]);
            $("#rate_name").val(arr[1]);
        });
        $('#site_rate').load('<?php echo HTTP_PATH; ?>users/getWorksiteRateAndName/'+$('#worksite').val()+"/<?php echo $user_detail[0]['site_rate']; ?>");
        
        //jQuery.validator.addMethod("alpha", function(value, element) {
        //   return this.optional(element) || /^[a-z]+$/i.test(value);
        //}, "Letters only please")
        
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[-a-zA-Z0-9_ ]+$/);
        }, "Only letters, Numbers & Space/underscore Allowed.");
        jQuery.validator.addMethod("BSB", function(value, element) {
            return this.optional(element) || value.match(/^[0-9]{3}[0-9]{3}$/);
        }, 'Please enter valid formate.');
        
        $("#register").validate({
            rules: {
                branchofbank: {
                    BSB: true
                }
            },
            messages: {
                branchofbank: {
                    BSB: "Format should be ‘xxxxxx’"
                }
            }
        });
        
        
        $("#select_house").click(function(){
            if(this.value != ""){
                $("#non_comp_address").val("");
            }
        });
        $("#non_comp_address").keyup(function(){
            if(this.value != ""){
                $("#select_house").val("");
            }
        });
                
        $(".rental_type").click(function(){
            if(this.value == 'company'){
                $("#select_house").addClass("required");
                $("#non_comp_address").removeClass("required");
                $(".display_place").show();
                $(".display_non_company").hide();
            } else {
                $("#select_house").removeClass("required");
                $("#non_comp_address").addClass("required");
                $(".display_place").hide();
                $(".display_non_company").show();
            }
        });
<?php if (($this->input->post("rental_type") ? $this->input->post("rental_type") : $user_detail[0]['rental_type']) == 'company') {
    ?>
                $("#select_house").addClass("required");
                $("#non_comp_address").removeClass("required");
                $(".display_place").show();
                $(".display_non_company").hide();
    <?php
} elseif (($this->input->post("rental_type") ? $this->input->post("rental_type") : $user_detail[0]['rental_type']) == 'non-company') {
    ?>
                $("#select_house").removeClass("required");
                $("#non_comp_address").addClass("required");
                $(".display_place").hide();
                $(".display_non_company").show();
<?php } else {
    ?>
                $("#select_house").removeClass("required");
                $("#non_comp_address").removeClass("required");
                $(".display_place").hide();
                $(".display_non_company").hide();
    <?php
}
?>
                
        $(".bond_payed").live("click", function(){
            if(this.value == '1'){
                $("#bondamount").addClass("required");
                $("#bondamount").removeAttr('disabled');
                $(".amount_box").show();
            } else {
                $("#bondamount").attr('disabled', 'disabled');
                $(".amount_box").hide();
                $("#bondamount").removeClass("required");
                $("#bondamount").val("");
            }
        });
        
<?php if (($this->input->post("statusofbond") ? $this->input->post("statusofbond") : $user_detail[0]['statusofbond']) == '1') { ?>
            $("#bondamount").addClass("required");
    <?php
    if ($user_detail[0]['rental_type'] == 'company') {
        ?>
                        $(".amount_box").show();
    <?php } ?>
                $("#bondamount").removeAttr('disabled');
<?php } else if (($this->input->post("statusofbond") ? $this->input->post("statusofbond") : $user_detail[0]['statusofbond']) == '2') { ?>
            $("#bondamount").attr('disabled', 'disabled');
            $(".amount_box").hide();
            $("#bondamount").removeClass("required");
            $("#bondamount").val("");
<?php } ?>
        
<?php
if ($user_detail[0]['rental_type'] != 'company') {
    ?>
                $(".amount_box").hide();
<?php } ?>
        
        $(".q_fever").live("click", function(){
            if(this.value == 'yes'){
                $("#q1").removeAttr('disabled');
                $("#q2").removeAttr('disabled');
            } else {
                $("#q1").attr('disabled', 'disabled');
                $("#q1").val("");
                $("#q2").attr('disabled', 'disabled');
                $("#q2").val("");
            }
        });
        
        
<?php if (($this->input->post("q_fever") ? $this->input->post("q_fever") : $user_detail[0]['q_fever']) == 'yes') { ?>
            $("#q1").removeAttr('disabled');
            $("#q2").removeAttr('disabled');
<?php } else if (($this->input->post("q_fever") ? $this->input->post("q_fever") : $user_detail[0]['q_fever']) == 'no') { ?>
            $("#q1").attr('disabled', 'disabled');
            $("#q1").val("");
            $("#q2").attr('disabled', 'disabled');
            $("#q2").val("");
<?php } ?>
    
    });
</script>
<article id="content"><!-- Page Content -->

    <section class="content_2">

        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon"> <strong class="ribbon-content"> Update Contractor Detail</strong> </p>
            </div>
        </section><?php if (validation_errors() || $this->session->userdata('message') || $this->session->flashdata('message')) { ?>
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

            <?php //$this->load->view('user/sideBarLeft.php');  ?>
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol2">
                <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
                <div class="form_contant_box_nw">
                    <?php echo form_open('users/editUser/' . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6), array('id' => 'register')); ?>
                    <div style="display: block;">
                        <div class="user_name_box2">
                            <div class="field_name">Contractor Id </div>
                            <div class="text_field_bg" style="font-size:15px;">
                                <?php
                                echo $user_detail[0]['id'];
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">AdminID </div>
                            <div class="text_field_bg" style="font-size:15px;">
                                <?php
                                echo $user_detail[0]['admin_id'] ? $user_detail[0]['admin_id'] : "N/A";
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Last Edit Date </div>
                            <div class="text_field_bg" style="font-size:15px;">
                                <?php
                                echo $user_detail[0]['last_update'] <> '0000-00-00 00:00:00' ? date("M d, Y h:i a", strtotime($user_detail[0]['last_update'])) : "N/A";
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">First Name <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'firstname',
                                    'class' => 'textfield_input required',
                                    'value' => $this->input->post('firstname') ? $this->input->post('firstname') : $user_detail[0]['firstname']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Last Name <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'lastname',
                                    'class' => 'textfield_input required',
                                    'value' => $this->input->post('lastname') ? $this->input->post('lastname') : $user_detail[0]['lastname']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">English Name <span class="required"></span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'enname',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('enname') ? $this->input->post('enname') : $user_detail[0]['enname']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Email Address <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array('name' => 'email',
                                    'class' => 'textfield_input required', 'value' => $this->input->post('email') ? $this->input->post('email') : $user_detail[0]['email']);
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Password <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array('name' => 'password',
                                    'minlength' => 8,
                                    'class' => 'textfield_input required', 'value' => $this->input->post('password') ? $this->input->post('password') : $user_detail[0]['password']);
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <!--div class="user_name_box2">
                          <div class="field_name">Confirm Password <span class="required1">*</span></div>
                          <div class="text_field_bg">
                        <?php
                        $data = array('name' => 'cpassword',
                            'class' => 'textfield_input', 'value' => $user_detail[0]['password']);
                        echo form_input($data);
                        ?>
                          </div>
                        </div-->
                        <div class="user_name_box2">
                            <div class="field_name">Contact Number <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array('name' => 'contact',
                                    'class' => 'textfield_input required', 'value' => $this->input->post('contact') ? $this->input->post('contact') : $user_detail[0]['contact_no']);
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Address <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array('name' => 'address', 'rows' => 5,
                                    'class' => 'textfield_input required', 'value' => $this->input->post('address') ? $this->input->post('address') : $user_detail[0]['address']);
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Gender <span class="required1">*</span></div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('gender') ? $this->input->post('gender') : $user_detail[0]['gender']) == 'F') {
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
                            <div class="field_name">Height</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'height',
                                    'class' => 'textfield_input number',
                                    'value' => $this->input->post('height') ? $this->input->post('height') : $user_detail[0]['height']
                                );
                                echo form_input($data);
                                ?> cm
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Weight</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'weight',
                                    'class' => 'textfield_input number',
                                    'value' => $this->input->post('weight') ? $this->input->post('weight') : $user_detail[0]['weight']
                                );
                                echo form_input($data);
                                ?> Kg
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">TFN declaration form  <span class="required1"></span></div>
                            <div class="text_field_bg3 err_0">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('tfn') ? $this->input->post('tfn') : $user_detail[0]['tfn']) == 'no') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('tfn') ? $this->input->post('tfn') : $user_detail[0]['tfn']) == 'yes') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('tfn', 'yes', $yes, "class=''"); ?><label>YES</label>
                                <?php echo form_radio('tfn', 'no', $no, "class=''"); ?><label>NO</label>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">ABN authority  <span class="required1"></span></div>
                            <div class="text_field_bg3 err_0">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('abn') ? $this->input->post('abn') : $user_detail[0]['abn']) == 'no') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('abn') ? $this->input->post('abn') : $user_detail[0]['abn']) == 'yes') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('abn', 'yes', $yes, "class=''"); ?><label>YES</label>
                                <?php echo form_radio('abn', 'no', $no, "class=''"); ?><label>NO</label>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">DOB <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'dob',
                                    'class' => 'textfield_input required', 'readonly' => "readonly",
                                    'id' => 'dob',
                                    'value' => $this->input->post('dob') ? $this->input->post('dob') : $user_detail[0]['dob']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Vehicle  <span class="required1"></span></div>
                            <div class="text_field_bg3 err_0">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('vehicle') ? $this->input->post('vehicle') : $user_detail[0]['vehicle']) == 'no') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('vehicle') ? $this->input->post('vehicle') : $user_detail[0]['vehicle']) == 'yes') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('vehicle', 'yes', $yes, "class=''"); ?><label>YES</label>
                                <?php echo form_radio('vehicle', 'no', $no, "class=''"); ?><label>NO</label>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Vaccination status <span class="required1">*</span></div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('statusvaccination') ? $this->input->post('statusvaccination') : $user_detail[0]['statusvaccination']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else {
                                    $yes = true;
                                    $no = NULL;
                                }
                                echo form_radio('statusvaccination', '1', $yes);
                                ?><label>Yes</label> &nbsp;
                                <?php echo form_radio('statusvaccination', '2', $no); ?><label>No</label><?php echo form_error('statusvaccination'); ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">Fee Member  <span class="required1"></span></div>
                            <div class="text_field_bg3 err_0">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('fee_member') ? $this->input->post('fee_member') : $user_detail[0]['fee_member']) == 'no') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('fee_member') ? $this->input->post('fee_member') : $user_detail[0]['fee_member']) == 'yes') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('fee_member', 'yes', $yes, "class=''"); ?><label>YES</label>
                                <?php echo form_radio('fee_member', 'no', $no, "class=''"); ?><label>NO</label>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Fee Amount ($)</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'fee_amount',
                                    'class' => 'textfield_input',
                                    'id' => 'fee_amount',
                                    'value' => $this->input->post('fee_amount') ? $this->input->post('fee_amount') : $user_detail[0]['fee_amount']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Q-fever  <span class="required1"></span></div>
                            <div class="text_field_bg3 err_0">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('q_fever') ? $this->input->post('q_fever') : $user_detail[0]['q_fever']) == 'no') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('q_fever') ? $this->input->post('q_fever') : $user_detail[0]['q_fever']) == 'yes') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('q_fever', 'yes', $yes, "class='q_fever'"); ?><label>YES</label>
                                <?php echo form_radio('q_fever', 'no', $no, "class='q_fever'"); ?><label>NO</label>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Q-fever 1 <span class="required1"></span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'q1',
                                    'class' => 'textfield_input', 'readonly' => "readonly",
                                    'id' => 'q1',
                                    'value' => $this->input->post('q1') ? $this->input->post('q1') : $user_detail[0]['q1']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Q-fever 2 <span class="required1"></span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'q2',
                                    'class' => 'textfield_input', 'readonly' => "readonly",
                                    'id' => 'q2',
                                    'value' => $this->input->post('q2') ? $this->input->post('q2') : $user_detail[0]['q2']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Shift Type <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $options = array('' => 'Select Shift Type', '1' => 'Morning', '2' => 'Afternoon', '3' => 'Night');
                                $selected = $this->input->post('shifttype') ? $this->input->post('shifttype') : $user_detail[0]['shifttype'];
                                echo form_dropdown('shifttype', $options, $selected, ' class="select_box"');
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Position</div>
                            <div class="text_field_bg">
                                <?php
                                $options = array('' => 'Select Position', '1' => 'General hand', '2' => 'Slicer', '3' => 'Boner', '5' => 'Slaughterer', '4' => 'Packer', '6' => 'Maintenance', '7' => 'Cleaning', '8' => 'Loading', '9' => 'Chill room', '10' => 'Loadout', '11' => 'Other');
                                $nextselected = $this->input->post('position') ? $this->input->post('position') : $user_detail[0]['position'];
                                echo form_dropdown('position', $options, $nextselected, ' class="select_box"');
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Nationality <span class="required1">*</span></div>
                            <div class="text_field_bg err_2">
                                <?php
                                $countries[''] = "Select Nationality";
                                echo form_dropdown('country_id', $countries, $this->input->post('country_id') ? $this->input->post('country_id') : $user_detail[0]["country_id"], "class = 'select_box required'");
                                ?> 
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Passport number <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'passport_number',
                                    'class' => 'textfield_input required',
                                    'value' => $this->input->post('passport_number') ? $this->input->post('passport_number') : $user_detail[0]['passport_number']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Visa Type <span class="required1">*</span></div>
                            <div class="text_field_bg err_2">
                                <?php
                                $visaoptions = array('' => 'Select Visa Type', '1' => 'Working holiday', '2' => 'Dependant 457 visa full work rights', '3' => 'PR/citizen', '4' => 'Bridging visa full work rights', '5' => 'Other visa', '6' => 'Limited work rights');
                                $visaselected = $this->input->post('visa_type') ? $this->input->post('visa_type') : $user_detail[0]['visa_type'];
                                echo form_dropdown('visa_type', $visaoptions, $visaselected, ' class="select_box required" ');
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
                                    'value' => $this->input->post('visa_number') ? $this->input->post('visa_number') : $user_detail[0]['visa_number']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Visa Expiry date</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'visa_expiry_date',
                                    'readonly' => "readonly",
                                    'class' => 'textfield_input',
                                    'id' => 'visa_expiry_date',
                                    'value' => $this->input->post('visa_expiry_date') ? $this->input->post('visa_expiry_date') : $user_detail[0]['visa_expiry_date']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">Tax Type <span class="required1">*</span></div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('taxtype') ? $this->input->post('taxtype') : $user_detail[0]['taxtype']) == '2') {
                                    $abn = NULL;
                                    $tfn = true;
                                } else {
                                    $abn = true;
                                    $tfn = NULL;
                                }
                                echo form_radio('taxtype', '1', $abn);
                                ?><label>ABN</label> &nbsp;
                                <?php echo form_radio('taxtype', '2', $tfn); ?><label>TFN</label><?php echo form_error('taxtype'); ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">Has ABN</div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('statusofabn') ? $this->input->post('statusofabn') : $user_detail[0]['statusofabn']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('statusofabn') ? $this->input->post('statusofabn') : $user_detail[0]['statusofabn']) == '1') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('statusofabn', '2', $no); ?><label>YES</label>
                                <?php echo form_radio('statusofabn', '1', $yes); ?><label>NO</label> &nbsp;
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Tax Number</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'tax_num',
                                    'class' => 'textfield_input',
                                    'id' => 'tax_num',
                                    'value' => $this->input->post('tax_num') ? $this->input->post('tax_num') : $user_detail[0]['tax_number']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">ABN Number</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'abnnumber',
                                    'class' => 'textfield_input',
                                    'id' => 'abnnumber',
                                    'value' => $this->input->post('abnnumber') ? $this->input->post('abnnumber') : $user_detail[0]['abnnumber']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Bank <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'bank',
                                    'class' => 'textfield_input required',
                                    'id' => 'bank',
                                    'value' => $this->input->post('bank') ? $this->input->post('bank') : $user_detail[0]['bank']
                                );
//                                echo form_input($data);
                                echo form_dropdown('bank', $banks, ($this->input->post('bank') ? $this->input->post('bank') : $user_detail[0]['bank']), 'id="bank" class="textfield_input required"')
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Account Name <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'nameofbank',
                                    'class' => 'textfield_input required alpha',
                                    'id' => 'nameofbank',
                                    'value' => $this->input->post('nameofbank') ? $this->input->post('nameofbank') : $user_detail[0]['nameofbank']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Account Number <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'numberofbank',
                                    'class' => 'textfield_input required',
                                    'maxlength' => '9',
                                    'value' => $this->input->post('numberofbank') ? $this->input->post('numberofbank') : $user_detail[0]['numberofbank']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">BSB   <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'id' => 'branchofbank',
                                    'onkeypress' => 'return preventCharecter(event)',
                                    'name' => 'branchofbank',
                                    'maxlength' => 6,
                                    'class' => 'textfield_input required',
                                    'value' => $this->input->post('branchofbank') ? $this->input->post('branchofbank') : $user_detail[0]['branchofbank']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Start employment date <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'employmentdate', 'readonly' => "readonly",
                                    'class' => 'textfield_input required',
                                    'id' => 'employmentdate',
                                    'value' => $this->input->post('employmentdate') ? $this->input->post('employmentdate') : $user_detail[0]['employmentdate']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Place of work <span class="required1">*</span></div>
                            <div class="text_field_bg_nw">
                                <?php echo form_dropdown('placeofwork', $worksites, $this->input->post('placeofwork') ? $this->input->post('placeofwork') : $user_detail[0]['worksite_id'], "class = 'textfield_input_nw required' id='worksite'"); ?>

                                <select class = 'textfield_input_nw required' id="site_rate" name="site_rate"><option>Select Site Rate Name</option></select>

                                <?php echo form_error('date_check') ? '<a name="probation"></a>' : ""; ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Hourly rate description</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'hourlyrate_des', 'rows' => "5",
                                    'cols' => "40",
                                    'id' => "rate_name",
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('hourlyrate_des') ? $this->input->post('hourlyrate_des') : $user_detail[0]['hourlyrate_des']
                                );
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Hourly Rate ($) <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'hourlyrate',
                                    'id' => "rate_value",
                                    'class' => 'textfield_input required',
                                    'value' => $this->input->post('hourlyrate') ? $this->input->post('hourlyrate') : $user_detail[0]['hourlyrate']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">Probation  <span class="required1">*</span></div>
                            <div class="text_field_bg3 err_0">
                                <?php
                                $array = array('selected' => 'selected');
                                if ((($this->input->post('probation') ? $this->input->post('probation') : $user_detail[0]['probation'])) == 'no') {
                                    $yes = NULL;
                                    $no = true;
                                } else if ((($this->input->post('probation') ? $this->input->post('probation') : $user_detail[0]['probation'])) == 'yes') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('probation', 'yes', $yes, "class='required'"); ?><label>YES</label>
                                <?php echo form_radio('probation', 'no', $no, "class='required'"); ?><label>NO</label> &nbsp;
                                <?php echo form_error('date_check') ? '<div id="msgID" class="ActionMsgBox error" style="margin-top: 10px;width: 151%;">' . form_error('date_check') . "</div>" : ""; ?>
                            </div>                            

                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Total One Off Deductions  ($)</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'deductions',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('deductions') ? $this->input->post('deductions') : $user_detail[0]['deductions']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Reasons for Deductions</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'reason_deductions',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('reason_deductions') ? $this->input->post('reason_deductions') : $user_detail[0]['reason_deductions']
                                );
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">Rental Type  <span class="required1">*</span></div>
                            <div class="text_field_bg3 rent_label" >
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('rental_type') ? $this->input->post('rental_type') : $user_detail[0]['rental_type']) == 'non-company') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('rental_type') ? $this->input->post('rental_type') : $user_detail[0]['rental_type']) == 'company') {
                                    $yes = true;
                                    $no = NULL;
                                } else if (($this->input->post('rental_type') ? $this->input->post('rental_type') : $user_detail[0]['rental_type']) <> 'company' and ($this->input->post('rental_type') ? $this->input->post('rental_type') : $user_detail[0]['rental_type']) <> 'non-company') {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                $yes_comp = $yes;
                                ?>

                                <?php echo form_radio('rental_type', 'company', $yes, "class='required rental_type'"); ?><label>Company</label>
                                <?php echo form_radio('rental_type', 'non-company', $no, "class='required rental_type'"); ?><label>Non Company</label><?php echo form_error('rental_type'); ?>
                            </div>
                        </div>

                        <div class="user_name_box2 display_place" style="display: none">
                            <div class="field_name">Place of stay   <span class="required1">*</span></div>
                            <div class="text_field_bg_nw">
                                <?php
                                $houses[0] = 'Select House';
                                echo form_dropdown('placeofstay', $houses, $this->input->post('placeofstay') ? $this->input->post('placeofstay') : $user_detail[0]['house_id'], 'id="select_house" class = "textfield_input"');
                                ?>

                            </div>
                        </div>

                        <div class="user_name_box2 display_non_company" style="display: none">
                            <div class="field_name">Non Company Address  <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'non_comp_address', 'rows' => "5",
                                    'cols' => "40",
                                    'id' => "non_comp_address",
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('non_comp_address') ? $this->input->post('non_comp_address') : $user_detail[0]['non_comp_address']
                                );
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name"> Last Address Update Date</div>
                            <div class="text_field_bg">
                                <?php
//                                echo $user_detail[0]['address_update_date'] ? date("M d, Y", strtotime($user_detail[0]['address_update_date'])) : "N/A";
                                ?>
                                <?php
                                $data = array(
                                    'id' => 'address_update_date',
                                    'readonly' => 'readonly',
                                    'name' => 'address_update_date',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('address_update_date') ? $this->input->post('address_update_date') : $user_detail[0]['address_update_date']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2  display_place" <?php if ($yes_comp) echo 'style="display: none"'; ?> >
                            <div class="field_name">Weekly rent rate ($) <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'weeklyrent',
                                    'class' => 'textfield_input required',
                                    'value' => $this->input->post('weeklyrent') ? $this->input->post('weeklyrent') : $user_detail[0]['weeklyrent']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                            <?php if (!$user_detail[0]['weeklyrent'] and !$user_detail[0]['bondamount']) { ?>
                                <div class="prompt">Please update the Weekly rent rate and Amount of bond payment fields for the contract</div>
                            <?php } ?>
                        </div>
                        <div class="user_name_box2  display_place" <?php if ($yes_comp) echo 'style="display: none"'; ?> >
                            <div class="field_name">Bond Payed <span class="required1">*</span> </div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('statusofbond') ? $this->input->post('statusofbond') : $user_detail[0]['statusofbond']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else {
                                    $yes = true;
                                    $no = NULL;
                                }
                                echo form_radio('statusofbond', '1', $yes, 'class="bond_payed"');
                                ?><label>Yes</label> &nbsp;
                                <?php echo form_radio('statusofbond', '2', $no, 'class="bond_payed"'); ?><label>No</label><?php echo form_error('statusofbond'); ?>
                            </div>
                        </div>
                        <div class="user_name_box2 amount_box  display_place"  <?php if ($yes_comp) echo 'style="display: none !important"'; ?> >
                            <div class="field_name">Amount of bond payment ($) <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'bondamount',
                                    'id' => 'bondamount',
                                    'class' => 'textfield_input required',
                                    'value' => $this->input->post('bondamount') ? $this->input->post('bondamount') : $user_detail[0]['bondamount']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">Currently Employed  <span class="required1">*</span></div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('employee_employed') ? $this->input->post('employee_employed') : $user_detail[0]['employee_employed']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('employee_employed') ? $this->input->post('employee_employed') : $user_detail[0]['employee_employed']) == '1') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('employee_employed', '2', $no, "class='employed'"); ?><label>YES</label>
                                <?php echo form_radio('employee_employed', '1', $yes, "class='employed'"); ?><label>NO</label> &nbsp;


                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Possible Future employment <span class="required1">*</span></div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('future_employment') ? $this->input->post('future_employment') : $user_detail[0]['future_employment']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('future_employment') ? $this->input->post('future_employment') : $user_detail[0]['future_employment']) == '1') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('future_employment', '2', $no, 'class="required future"'); ?><label>YES</label>
                                <?php echo form_radio('future_employment', '1', $yes, 'class="required future"'); ?><label>NO</label> &nbsp;
                            </div>
                        </div>

                        <div class="user_name_box2">
                            <div class="field_name">Description of final position</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'final_position',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('final_position') ? $this->input->post('final_position') : $user_detail[0]['final_position']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Resignation Approved By</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'r_ap_by',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('r_ap_by') ? $this->input->post('r_ap_by') : $user_detail[0]['regignation_approve_by']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Resignation reason</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array('name' => 'reason', 'class' => 'textfield_input', 'id' => 'reason', 'value' => $this->input->post('reason') ? $this->input->post('reason') : $user_detail[0]['reason'], 'rows' => "5", 'cols' => "40");
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Left Australia  <span class="required1">*</span></div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');

                                if (($this->input->post('left_australia') ? $this->input->post('left_australia') : $user_detail[0]['left_australia']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else if (($this->input->post('left_australia') ? $this->input->post('left_australia') : $user_detail[0]['left_australia']) == '1') {
                                    $yes = true;
                                    $no = NULL;
                                } else {
                                    $yes = NULL;
                                    $no = NULL;
                                }
                                ?>
                                <?php echo form_radio('left_australia', '2', $no, 'class="australia"' . ($user_detail[0]['employee_employed'] == '2' ? "" : "")); ?><label>YES</label>
                                <?php echo form_radio('left_australia', '1', $yes, 'class="australia"' . ($user_detail[0]['employee_employed'] == '2' ? "" : "")); ?><label>NO</label> &nbsp;
                            </div>
                        </div> 

                        <div class="user_name_box2">
                            <div class="field_name">Status of issued equipment</div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('statusofissued') ? $this->input->post('statusofissued') : $user_detail[0]['statusofissued']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else {
                                    $yes = true;
                                    $no = NULL;
                                }
                                echo form_radio('statusofissued', '1', $yes);
                                ?><label>Yes</label> &nbsp;
                                <?php echo form_radio('statusofissued', '2', $no); ?><label>No</label><?php echo form_error('statusofissued'); ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Equipment name 1 </div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'equipment_name1',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('equipment_name1') ? $this->input->post('equipment_name1') : $user_detail[0]['equipment_name1']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Equipment value 1 ($)</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'equipment_value1',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('equipment_value1') ? $this->input->post('equipment_value1') : $user_detail[0]['equipment_value1']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Paid for by 1</div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('paidforby1') ? $this->input->post('paidforby1') : $user_detail[0]['paidforby1']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else {
                                    $yes = true;
                                    $no = NULL;
                                }
                                echo form_radio('paidforby1', '1', $yes);
                                ?><label>Company</label> &nbsp;
                                <?php echo form_radio('paidforby1', '2', $no); ?><label>Contractor</label><?php echo form_error('paidforby1'); ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Equipment name 2 </div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'equipment_name2',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('equipment_name2') ? $this->input->post('equipment_name2') : $user_detail[0]['equipment_name2']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Equipment value 2  ($)</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'equipment_value2',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('equipment_value2') ? $this->input->post('equipment_value2') : $user_detail[0]['equipment_value2']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Paid for by 2</div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('paidforby2') ? $this->input->post('paidforby2') : $user_detail[0]['paidforby2']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else {
                                    $yes = true;
                                    $no = NULL;
                                }
                                echo form_radio('paidforby2', '1', $yes);
                                ?><label>Company</label> &nbsp;
                                <?php echo form_radio('paidforby2', '2', $no); ?><label>Contractor</label><?php echo form_error('paidforby2'); ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Equipment name 3 </div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'equipment_name3',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('equipment_name3') ? $this->input->post('equipment_name3') : $user_detail[0]['equipment_name3']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Equipment value 3  ($)</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'equipment_value3',
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('equipment_value3') ? $this->input->post('equipment_value3') : $user_detail[0]['equipment_value3']
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="user_name_box2">
                            <div class="field_name">Paid for by 3</div>
                            <div class="text_field_bg3">
                                <?php
                                $array = array('selected' => 'selected');
                                if (($this->input->post('paidforby3') ? $this->input->post('paidforby3') : $user_detail[0]['paidforby3']) == '2') {
                                    $yes = NULL;
                                    $no = true;
                                } else {
                                    $yes = true;
                                    $no = NULL;
                                }
                                echo form_radio('paidforby3', '1', $yes);
                                ?><label>Company</label> &nbsp;
                                <?php echo form_radio('paidforby3', '2', $no); ?><label>Contractor</label><?php echo form_error('paidforby3'); ?>
                            </div>
                        </div> 

                        <div class="user_name_box2">
                            <div class="field_name">Notes</div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'notes',
                                    'rows' => "5",
                                    'cols' => "40",
                                    'id' => "notes",
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('notes') ? $this->input->post('notes') : $user_detail[0]['notes']
                                );
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div  class="user_name_3">
                        <div class="login_button_2">
                            <input name="Submit" value="Update" type="submit" class="input_submit" />

                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </section>

        </section>
    </section>
</article>
