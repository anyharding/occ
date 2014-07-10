<script>
    function lshowdiv(divid1,divid2){
        if(divid1=='lpasstext'){
            if($('#popuploginpass').val()==''){
                $('#'+divid1).show();
                $('#'+divid2).hide();
            }
        }
        else{
            $('#'+divid1).show();
            $('#'+divid2).hide();
            $('#popuploginpass').focus();
        }
    }
    function lrshowdiv(divid1,divid2){
        if(divid1=='lrpasstext'){
            if($('#lrpopuploginpass').val()==''){
                $('#'+divid1).show();
                $('#'+divid2).hide();
            }
        }
        else{
            $('#'+divid1).show();
            $('#'+divid2).hide();
            $('#lrpopuploginpass').focus();
        }
    }
    function lrcshowdiv(divid1,divid2){
        if(divid1=='lrcpasstext'){
            if($('#lrcpopuploginpass').val()==''){
                $('#'+divid1).show();
                $('#'+divid2).hide();
            }
        }
        else{
            $('#'+divid1).show();
            $('#'+divid2).hide();
            $('#lrcpopuploginpass').focus();
        }
    }
</script>

<article id="content"><!-- Page Content -->
    <section class="content">
        <div class="content_bg">

            <div class=" login_box">
                <div class="top_login_text_img"><img src="<?php echo HTTP_PATH; ?>img/employee-login_text.png" alt="" />
                </div>
                <?php echo form_open('welcome/login'); ?>
                <div class="user_name">
                    <label>Username</label>
                    <div class="black_textfield_bg">
                        <?php echo form_input(array('id' => 'f_name', 'name' => 'username', 'onfocus' => "if(this.value=='Username') this.value='';", 'onblur' => "if(this.value=='') this.value='Username';", 'value' => "Username")); ?>
                    </div>
                </div>

                <div  class="password_text user_name">
                    <label>Password</label>
                    <div class="black_textfield_bg" id="lpasstext" style="display: block;">

                        <?php echo form_input(array('id' => 'f_password', 'name' => 'password', 'value' => 'Password', 'id' => "popuplabelpass", 'onfocus' => "javascript:lshowdiv('lpassfield','lpasstext')")); ?>
                    </div>
                    <div class="black_textfield_bg" id="lpassfield"  style="display: none;">

                        <?php echo form_password(array('id' => 'f_password', 'name' => 'password', 'onblur' => "javascript:lshowdiv('lpasstext','lpassfield')", 'id' => "popuploginpass")); ?>
                    </div>
                </div>
                <div  class="password_text user_name">
                    <label></label>
                    <div class="login_button">
                        <?php
                        $data = array(
                            'name' => 'login', // button name
                            // this is the button text
                            'type' => 'submit', // button type (important!)
                            'class' => 'input_text'
                        );
                        echo form_submit($data)
                        ?>   
                        <span>
                            <?php echo anchor('/welcome/forgotPassword', 'Forgot Password?'); ?></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <?php if (validation_errors() || $this->session->userdata('message') || $this->session->flashdata('message')) { ?>
                    <div class='ActionfrontMsgBox' id='msgID'>
                        <div class='error error2'>
                            <?php
                            echo validation_errors();
                            echo $this->session->userdata('message');
                            echo $this->session->flashdata('message');
                            $this->session->unset_userdata('message');
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($this->session->userdata('smessage') || $this->session->flashdata('smessage')) { ?>
                    <div class='ActionfrontMsgBox' id='msgID'>
                        <div class='success success2'>
                            <?php
                            echo $this->session->userdata('smessage');
                            echo $this->session->flashdata('smessage');
                            $this->session->unset_userdata('smessage');
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</article>
