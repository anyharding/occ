<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<script>
    $(document).ready(function(){
        $('#worksite').change(function(e) {
            if(this.value) {    
                $.ajax({
                    url: "<?php echo HTTP_PATH . 'users/ajax_users/worksite/'; ?>"+this.value+"/<?php echo md5(time()); ?>",
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
                    url: "<?php echo HTTP_PATH . 'users/ajax_users/worksite/'; ?>"+this.value,
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
        $('.delete').live("click", function(e) {
            e.preventDefault();
            var redirect = $(this).attr('href');
            if(confirm("Do you want to transfer this employees details to the applicant list")){
                window.location = redirect+"/move";
            } else {
                if(confirm("Do you want to delete this employee?")){
                    window.location = redirect;
                }
            }
        })
    });
    function validateDelete(id){
        alert(id);
        return false;
    }
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
                <?php if (($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '') and $this->uri->segment(1) == 'users') { ?>
                    <div style="margin-bottom: 50px;">
                        <div class="field_name"><b>Search Contractors </b></div>
                        <div class="text_field_bg">
                            <?php echo form_dropdown('worksite_id', $worksites, $this->uri->segment(4), "class = 'textfield_input' id='worksite'"); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="login_btm" id="middle-content"><?php echo $ajax_content; ?></div>

            </section>
        </section>
    </section>
</article>