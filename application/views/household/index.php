<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
        <script>
            $(document).ready(function(){
                $('#house').live('change', function(e) {
                    if(this.value) {    
                        $.ajax({
                            url: "<?php echo HTTP_PATH . 'household/ajax_index/'; ?>"+this.value+"/"+$('#worksite').val(),
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
                            url: "<?php echo HTTP_PATH . 'household/ajax_index/'; ?>"+this.value,
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
                $('#worksite').change(function(e) {
                    $('#loading-image').show();
                    $('#house_dropdown').load('<?php echo HTTP_PATH; ?>users/getHousesList/'+this.value);
                    $('#loading-image').hide();
                });
<?php if ($this->uri->segment(3)) { ?>
            $('#house_dropdown').load('<?php echo HTTP_PATH; ?>users/getHousesList/'+$('#worksite').val()+"/<?php echo $this->uri->segment(3); ?>");
            $('#house').val("<?php echo $this->uri->segment(3); ?>");                                        
<?php } ?>
        //$("select option[value=<?php echo $this->input->get('house'); ?>]").attr("selected","selected");
    });
    
        </script>
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">List Households </strong>
                </p>
            </div>
        </section>    
        <section class="page-container">

            <?php $this->load->view('user/sideBarLeft'); ?>

            <section class="contentCol">
                <h2 class="my_profile">List Households </h2>
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
                <div style="margin-bottom: 50px;">
                    <div class="field_name"><b>Search Household </b></div>
                    <div class="text_field_bg">
                        <?php echo form_dropdown('worksite_id', $worksites, $this->uri->segment(4), "class = 'textfield_input' id='worksite'"); ?>
                    </div>
                    <div class="text_field_bg" id="house_dropdown">
                        <select id="house" class="textfield_input" name="houses"><option>Select House</option></select>
                    </div>
                </div>

                <div style="display: none;" class="load-image" id="loading-image">
                    <?php echo img('img/loading4.gif'); ?> 
                </div>
                <div class="login_btm" id="middle-content"><?php echo $ajax_content; ?></div>
            </section>
        </section>
    </section>
</article>


