<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<script>
    $(document).ready(function(){
        $('#worksite').change(function(e) {
            $('#examples').fadeIn();
            $('#site_rate').load('<?php echo HTTP_PATH; ?>users/getWorksiteRateAndName1/'+this.value);
            $('#examples').fadeOut();
        });
        $('#site_rate').change(function(e) {
            window.location = "<?php echo HTTP_PATH . 'users/index/'; ?>"+$('#worksite').val()+"/"+this.value;
        });
        $('#site_rate').load("<?php echo HTTP_PATH; ?>users/getWorksiteRateAndName1/<?php echo $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5); ?>");
        //$("select option[value=<?php echo $this->input->get('value'); ?>]").attr("selected","selected");

    });

</script>

<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Contractors Resignation List </strong>
                </p>
            </div>


        </section>    
        <section class="page-container">

            <?php $this->load->view('user/sideBarLeft'); ?>

            <section class="contentCol">
                <h2 class="my_profile">Contractors Resignation List </h2>
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

                <div class="login_btm" id="middle-content"><?php echo $ajax_content; ?></div>
            </section>
        </section>
    </section>
</article>


