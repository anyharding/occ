<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.numeric.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>


<script>
    $(document).ready(function(){   
        $('#14days').click(function(e) {
            $.ajax({
                catche:false,
                url: "<?php echo HTTP_PATH . "rent/ajax_batchPayments" ?>",
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
                catche:false,
                url: "<?php echo HTTP_PATH . "rent/ajax_batchPaymentsBatch" ?>",
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
                    $(".numeric").numeric();
                    $( ".due_date" ).datepicker({
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        yearRange:"-90:+28",
                        maxDate: new Date(2500, 0, 1),
                        changeYear: true
                    });  
                }
            });
        });
    })
    function validate(){
        var flag = 1;
        $('.required_true').map(function() {
            var value= $(this).val();
            if(value=="")
            { 
                flag = 0;
                $(this).addClass('error-true');
                return false;
                    
            }else
            {   
                $(this).removeClass('error-true'); 
            } 
        });
        if(flag == 1 ) {
            var values = $('input:checkbox:checked').map(function () {
                return this.value;
            }).get(); 
            if(values == ''){
                alert("Please select atleast one option ");
                return false;
            } else {
                $("#msgID1").hide();                
                return true;
            }            
            return true;
        }
        alert('Please fill all the fields.');
        return false;
    }
</script>
<script>
    checked = false;
    function checkedAll () {
        if (checked == false){checked = true}else{checked = false}
        for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
            document.getElementById('myform').elements[i].checked = checked;
        }
    } 
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">List Rent Batch Payment</strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol">
                <h2 class="my_profile">List Rent Batch Payment </h2>
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
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                    <tr>
                        <td align="left" height="80">
                            <h3 align="left">Please Select Option</h3>
                            <span class="chek_expir">
                                <?php echo form_radio('type', 'single', TRUE, "id='14days'"); ?> <label for="14days">Single Payment &nbsp;</label>
                            </span>
                            <span class="chek_expir">
                                <?php echo form_radio('type', 'batch', null, "id='30days'"); ?> <label for="30days">Batch Payment &nbsp;</label>
                            </span>                            
                        </td>
                    </tr>                      
                </table>
                <div class="login_btm" id="middle-content"><?php echo $ajax_content; ?></div>
            </section>
        </section>
    </section>
</article>