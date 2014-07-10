<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<script>
    $(document).ready(function(){
        $('#worksite').change(function(e) {
            if(this.value) {    
                $.ajax({
                    url: "<?php echo HTTP_PATH . 'houses/ajax_houses/worksite/'; ?>"+this.value,
                    type: 'POST',cache: false,
                    success: function(data)
                    {
                        $("#middle-content").html(data);
                        $("#loading-image").hide();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        $('.message_member').html('Error while contacting server, please try again');
                    },
                    beforeSend:function(){
                        $("#loading-image").show();
                    }
                });
            }
            else{            
                $.ajax({
                    url: "<?php echo HTTP_PATH . 'houses/ajax_houses/worksite/'; ?>"+this.value,
                    type: 'POST',cache: false,
                    success: function(data)
                    {
                        $("#middle-content").html(data);
                        $("#loading-image").hide();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        $('.message_member').html('Error while contacting server, please try again');
                    },
                    beforeSend:function(){
                        $("#loading-image").show();
                    }
                });
            }
        });
    });
    
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">List Houses </strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol">
                <h2 class="my_profile">List Houses </h2>
                <?php if (validation_errors() || $this->session->userdata('message') || $this->session->flashdata('message')) { ?>
                    <div class='ActionMsgBox error' id='msgID'>
                        <?php
                        echo validation_errors();
                        echo $this->session->flashdata('message');
                        ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->userdata('smessage') || $this->session->flashdata('smessage')) { ?>
                    <div class='ActionMsgBox success' id='msgID'>
                        <?php
                        echo $this->session->flashdata('smessage');
                        ?>
                    </div>
                <?php } ?>           
                <div style="display: none;" class="load-image" id="loading-image">
                    <?php echo img('img/loading4.gif'); ?> 
                </div> 

                <?php if (($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '') and $this->uri->segment(1) == 'houses') { ?>
                    <div style="margin-bottom: 50px;">
                        <div class="field_name"><b>Search Houses </b></div>
                        <div class="text_field_bg">
                            <?php echo form_dropdown('worksite_id', $worksites, $this->uri->segment(4), "class = 'textfield_input' id='worksite'"); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="login_btm" id="middle-content"><?php echo $ajax_content; ?></div>
                <div class="pagination_new">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </section>
        </section>
    </section>
</article>


