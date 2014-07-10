<article id="content"><!-- Page Content -->
    <section class="content">
        <div class="content_bg_employee">

            <div class=" login_box">
                <div class="top_login_text_img"><img src="<?php echo HTTP_PATH; ?>img/contactor_login.png" alt="" /></div>
                <?php echo form_open(''); ?>
                <div class="user_name">
                    <label>EmployeeID</label>
                    <div class="black_textfield_bg">
                        <?php echo form_input(array('name' => 'username', 'placeholder' => 'Your EmployeeID')); ?>
                    </div>
                </div>

                <div  class="password_text user_name">
                    <label>Password</label>
                    <div class="black_textfield_bg" id="lpassfield">
                        <?php echo form_password(array('name' => 'password', 'placeholder' => 'Your Password')); ?>
                    </div>
                </div>
                <div  class="password_text user_name">
                    <label></label>
                    <div class="login_button">
                        <?php
                        $data = array(
                            'name' => 'login',
                            'type' => 'submit',
                            'class' => 'input_text'
                        );
                        echo form_submit($data)
                        ?>   
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
