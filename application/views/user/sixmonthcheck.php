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
<script>
    $(document).ready(function(){
        $('#14days').click(function(e) {
            $.ajax({
                url: "<?php echo HTTP_PATH . "users/day_45" ?>",
                beforeSend: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").show();
                },
                complete: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").hide();
                },
                success: function(data) {
                    $('#middle-content').attr('innerHTML',data);
                    $("#recently").css('display', 'none'); 
                    $("#all").css('display', 'block'); 
                }
            });
        });
        $('#30days').click(function(e) {
            $.ajax({
                url: "<?php echo HTTP_PATH . "users/day_56" ?>",
                beforeSend: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").show();
                },
                complete: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").hide();
                },
                success: function(data) {
                    $('#middle-content').attr('innerHTML',data);
                    $("#recently").css('display', 'none'); 
                    $("#all").css('display', 'block'); 
                }
            });
        });
        $('#60days').click(function(e) {
            $.ajax({
                url: "<?php echo HTTP_PATH . "users/day_6" ?>",
                beforeSend: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").show();
                },
                complete: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").hide();
                },
                success: function(data) {
                    $('#middle-content').attr('innerHTML',data);
                    $("#recently").css('display', 'none'); 
                    $("#all").css('display', 'block'); 
                }
            });
        });
    });
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">6 Month Check </strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol">
                <h2 class="my_profile">6 Month Check </h2>
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
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                    <tr>
                        <td align="left" height="80">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->session->userdata('visaDays') == '45') {
                                $four = true;
                                $three = NULL;
                                $six = NULL;
                            }
                            if ($this->session->userdata('visaDays') == '56') {
                                $four = NULL;
                                $three = true;
                                $six = NULL;
                            }
                            if ($this->session->userdata('visaDays') == '6') {
                                $four = NULL;
                                $three = NULL;
                                $six = true;
                            } else if ($this->session->userdata('visaDays') <> '45' and $this->session->userdata('visaDays') <> '56' and $this->session->userdata('visaDays') <> '6') {
                                $four = NULL;
                                $three = NULL;
                                $six = NULL;
                            }
                            ?>
                            <h3 align="left">Please Select Option</h3>
                            <span class="chek_expir">
                                <?php
                                echo form_radio('type', '45', $four, "id='14days'");
                                ?> 4.5 to 5.5 months &nbsp;</span>
                            <span class="chek_expir">
                                <?php echo form_radio('type', '56', $three, "id='30days'"); ?> 5.5 to 6 months &nbsp;</span>
                            <span class="chek_expir">
                                <?php echo form_radio('type', '6', $six, "id='60days'"); ?> over 6 months</span>
                        </td>
                    </tr>                      
                </table>
                <div style="display: none;" class="load-image" id="loading-image">
                    <?php echo img('img/loading4.gif'); ?> 
                </div> 
                <div class="login_btm" id="middle-content"><?php echo $ajax_content; ?></div>
            </section>
        </section>
    </section>
</article>


