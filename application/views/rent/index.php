<script>
    $(document).ready(function(){
        $(".sort").live("click", function(){
            var type = $(this).attr('alt'); 
            var worksite = $('#worksite').val()?$('#worksite').val():0;
            var page = $('#pagination').val();
            var order = $(this).attr('order'); 
            $.ajax({
                url: "<?php echo HTTP_PATH . "rent/ajax_rent/" ?>"+worksite+"/old/"+page+"?type="+type+"&order="+order,
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
                    
                    if(order == 'asc') {
                        $("."+type).attr('order', 'desc');
                        $("."+type+" div.icon").html('<?php echo img('img/dwn.png'); ?>');
                    } else {
                        $("."+type).attr('order', 'asc');
                        $("."+type+" div.icon").html('<?php echo img('img/upp.png'); ?>');
                    }
                }
            });
        });
        $(".sort_1").live("click", function(){
            var type = $(this).attr('alt'); 
            var worksite = $('#worksite').val()?$('#worksite').val():0;
            var page = $('#pagination').val();
            var order = $(this).attr('order'); 
            $.ajax({
                url: "<?php echo HTTP_PATH . "rent/ajax_rent/" ?>"+worksite+"/gold/"+page+"?type="+type+"&order="+order,
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
                    
                    if(order == 'asc') {
                        $("."+type).attr('order', 'desc');
                        $("."+type+" div.icon").html('<?php echo img('img/dwn.png'); ?>');
                    } else {
                        $("."+type).attr('order', 'asc');
                        $("."+type+" div.icon").html('<?php echo img('img/upp.png'); ?>');
                    }
                }
            });
        }); 
        
        $("#recently").click(function(){
            $('#old_items').removeAttr('checked','checked');
            $.ajax({
                url: "<?php echo HTTP_PATH . "rent/most200/" ?>"+$('#worksite').val(),
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
        $("#all").click(function(){
            $('#old_items').removeAttr('checked','checked');
            $.ajax({
                url: "<?php echo HTTP_PATH . "rent/revertMost200/" ?>"+$('#worksite').val(),
                beforeSend: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").show();
                },
                complete: function() {
                    $("#<?php echo $this->jquery_pagination->loadingId; ?>").hide();
                },
                success: function(data) {
                    $('#middle-content').attr('innerHTML',data);
                    $("#recently").css('display', 'block'); 
                    $("#all").css('display', 'none'); 
                }
            });
        });
        
        
        $('#worksite').change(function(e) {
            var value = $("#old_items").is(':checked') ? "old" : "gold";
            $.ajax({
                url: "<?php echo HTTP_PATH . 'rent/ajax_rent/'; ?>"+this.value+"/"+value,
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
        });
        $("#old_items").click(function(){        
            var value = $("#old_items").is(':checked') ? 1 : 0;
            if(value){
                $.ajax({
                    url: "<?php echo HTTP_PATH . "rent/ajax_rent/0/old" ?>",
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
            } else{
                $('#worksite').val("");
                $.ajax({
                    url: "<?php echo HTTP_PATH . "rent/ajax_rent" ?>",
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
            }
           
        });
        $(".input_submit_excel_1").live("click", function() {
            $("#myform").attr('action', '<?php echo HTTP_PATH . "rent/paidstatus"; ?>');
            if(validate()) {
                $("#myform").submit();
            } else {
                return false;
            }
            //            if (checked == false){checked = true}else{checked = false}
    //            checked = true;
    //            for (var i = 0; i < document.getElementById('myform').elements.length ; i++) {
    //                if(document.getElementById('myform').elements[i].hasAttribute("paid"))
    //                    document.getElementById('myform').elements[i].checked = checked;
    //            }
        })
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
            var values = $('input:checkbox.checkbox:checked').map(function () {
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
        for (var i = 0; i < document.getElementById('myform').elements.length ; i++) {
            if(document.getElementById('myform').elements[i].value != 'paid')
                document.getElementById('myform').elements[i].checked = checked;
        }
    } 
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">List Rent Payment</strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol">
                <h2 class="my_profile">List Rent Payment </h2>
                <?php if ($this->session->userdata('record') == '400') { ?>
                    <div class="rent_button" id="all">All </div>
                    <div class="rent_button" id="recently"  style="display: none" >Most Recently </div>
                <?php } else { ?>
                    <div class="rent_button" id="all"  style="display: none">All </div>
                    <div class="rent_button" id="recently"  >Most Recently </div>
                <?php } ?>

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
                <div style="float: left">
                    <div style="margin-bottom: 11px;float: left;width: 508px;">
                        <div class="field_name"><b>Select Worksite </b></div>
                        <div class="text_field_bg">
                            <?php echo form_dropdown('worksite_id', $worksites, $this->uri->segment(4), "class = 'textfield_input' id='worksite'"); ?>
                        </div>
                    </div>
                    <div style="margin-top: 24px;float: right;width: 190px;">
                        <?php echo form_checkbox('old_items', "1", FALSE, "id='old_items'"); ?> <b><label for="old_items" style="cursor: pointer"> Display old rent payments</label>  </b> 
                    </div>
                </div>
                <div class="login_btm" id="middle-content"><?php echo $ajax_content; ?></div>

            </section>
        </section>
    </section>
</article>