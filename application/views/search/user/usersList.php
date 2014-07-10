<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<script>
    $(document).ready(function(){
        $('#worksite').change(function(e) {
            if(this.value)
                window.location = "<?php echo HTTP_PATH . 'users/index/worksite/'; ?>"+this.value+"/<?php echo md5(time()); ?>";
            else
                window.location = "<?php echo HTTP_PATH . 'users/index/worksite/'; ?>"+this.value;
        });
    });
    
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Contractors List </strong>
                </p>
            </div>
        </section>    
        <section class="page-container">

            <?php $this->load->view('user/sideBarLeft'); ?>

            <section class="contentCol">
                <h2 class="my_profile">Contractors List </h2>
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
                <div style="display: none;" class="load-image" id="loading-image">
                    <?php echo img('img/loading4.gif'); ?> 
                </div>
                <?php echo $ajax_content; ?>
            </section>
        </section>
    </section>
</article>