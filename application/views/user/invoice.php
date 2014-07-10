<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>

        <script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
        <script>
            $(document).ready(function(){
                $('#house').live('change', function(e) {
                    if(this.value)
                        window.location = "<?php echo HTTP_PATH . 'household/index/'; ?>"+this.value+"/"+$('#worksite').val();
                    else
                        window.location = "<?php echo HTTP_PATH . 'household/index/'; ?>"+this.value;
                });
                $('#worksite').change(function(e) {
                    $('#examples').fadeIn();
                    $('#house_dropdown').load('<?php echo HTTP_PATH; ?>users/getEmployeesList/'+this.value);
                    $('#examples').fadeOut();
                });
<?php if ($this->uri->segment(3)) { ?>
            $('#house_dropdown').load('<?php echo HTTP_PATH; ?>users/getEmployeesList/'+$('#worksite').val()+"/<?php echo $this->uri->segment(3); ?>");
            $('#house').val("<?php echo $this->uri->segment(3); ?>");                                        
<?php } ?>
    });
    
        </script>
        <article id="content"><!-- Page Content -->
            <section class="content_2">
                <section class="top_login_text_head">
                    <div class="ribbon_2">
                        <p class="ribbon">
                            <strong class="ribbon-content">Generate Invoice </strong>
                        </p>
                    </div>
                </section>    
                <section class="page-container">
                    <?php $this->load->view('user/sideBarLeft'); ?>
                    <section class="contentCol">
                        <h2 class="my_profile"> Generate Invoice </h2>
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

                        <div style="margin-bottom: 50px;">
                            <div class="field_name"><b>Search Household </b></div>
                            <div class="text_field_bg">
                                <?php echo form_dropdown('worksite_id', $worksites, $this->uri->segment(4), "class = 'textfield_input' id='worksite'"); ?>
                            </div>
                            <div class="text_field_bg" id="house_dropdown">
                                <select id="house" class="textfield_input" name="houses"><option>Select Contractor</option></select>
                            </div>
                           
                            <div id="examples" style="display: none"><img src="<?php echo HTTP_PATH ?>img/loader.gif"></div>
                        <div class="invoce_matter_bg">
                        <div class="company_struchers">
                        <div class="company_contents_left">
                        <div class="comp_add">TW Armada Group Pty Ltd<br />
Unit 5 No. 1 Station Road<br />
Auburn<br />
NSW 2144</div>
<div class="clr"></div>
                       <div class="comp_step_tow">A.B.N.: 48 136 568 486<br />A.C.N.:</div>
                        </div>
                        <div class="company_contents_right">
                       
                        <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                        </div>
                        
                        </div>
                        
                        <div class="invoce_matter_bg_first">
                        <div class="company_struchers">
                        <div class="company_contents_left">
                        <div class="comp_add">Hung-Shun Chong<br />
76 Darlington<br />
Mortlake VIC 3272<br />
</div>
<div class="clr"></div>
                       
                        </div>
                        <div class="company_contents_right">
                        <div class="comp_add_right">Recipient Created Tax Invoice<br />
Purchase #: 00000952<br /></div>
                        <div class="comp_add_right_ship">Ship To:<br />
TW Armada Group Pty Ltd<br />Unit 5 No. 1 Station Road<br />Auburn<br />NSW 2144</div>
                        <div class="clr"></div>
                        </div>
                        
                        <div class="clr"></div>
                        <div class="table">
                                            	<div class="table-row-heading">
                                                    <div class="th width20">SALESPERSON</div>
                                                    <div class="th width20">YOUR NO.</div>
                                                    <div class="th width20">SHIP VIA</div>
                                                    <div class="th width20">COL</div>
                                                    <div class="th width20">PPD</div>
                                                    <div class="th width20">SHIP DATE</div>
                                                    <div class="th width20">TERMS</div>
                                                    <div class="th width20">DATE</div>
                                                    <div class="th width20">PG</div>
                                           	 </div>
                                             <div class="table-row-heading">
                                                    <div class="th width20"></div>
                                                    <div class="th width20"></div>
                                                    <div class="th width20"></div>
                                                    <div class="th width20"></div>
                                                    <div class="th width20"></div>
                                                    <div class="th width20"></div>
                                                    <div class="th width20">Net 30th after EOM</div>
                                                    <div class="th width20">6/01/2012</div>
                                                    <div class="th width20">1</div>
                                           	 </div>
                       	  <div class="spacer"></div>
                       
                                               
                                                 
						  </div>
                          <div class="list_table">
                          <div class="table-row alt">
                                                    <div class="td width10 first"><div class="wd_inn1">QTY.</div></div>
                                                    <div class="td width10"><div class="wd_inn2">ITEM NO.</div></div>
                                                    <div class="td width30"><div class="wd_inn3">DESCRIPTION</div></div>
                                                    <div class="td width5"><div class="wd_inn4">PRICE</div></div>
                                                    <div class="td width10"><div class="wd_inn5">UNIT</div></div>
                                                    <div class="td width10"><div class="wd_inn6">DISC %</div></div>
                                                    <div class="td width10"><div class="wd_inn7">EXTENDED</div></div>
                                                    <div class="td width5"><div class="wd_inn8">CODE</div></div>
                                                
                                                 </div>
                        </div>
                        <div class="list_table">
                          <div class="table-row alt">
                                                    <div class="td width10 first"><div class="cwd_inn1">329.5 -8<br />  -1 <br />-1</div></div>
                                                    <div class="td width10"><div class="cwd_inn2"></div></div>
                                                    <div class="td width30"><div class="cwd_inn3">Labour Hire Probationary<br />Labour Hire Rent<br />Labour Hire Bond<br />Labour Hire Canteen Purchase <div class="input_box_bg"><input type="text" class="textfield_input" value="" name="des"></div><div class="input_box_bg"><input type="text" class="textfield_input" value="" name="des"></div><div class="input_box_bg"><input type="text" class="textfield_input" value="" name="des"></div></div></div>
                                                    <div class="td width5"><div class="cwd_inn4">$18.70<br />$65.00<br />$400.00<br />$30.00<div class="input_price_box"><input type="text" class="textfield_input" value="" name="des"></div><div class="input_price_box"><input type="text" class="textfield_input" value="" name="des"></div><div class="input_price_box"><input type="text" class="textfield_input" value="" name="des"></div></div></div>
                                                    <div class="td width10"><div class="cwd_inn5"><div class="input_unit_box"><input type="text" class="textfield_input" value="" name="des"></div><div class="input_unit_box"><input type="text" class="textfield_input" value="" name="des"></div><div class="input_unit_box"><input type="text" class="textfield_input" value="" name="des"></div></div></div>
                                                    <div class="td width10"><div class="cwd_inn6"></div></div>
                                                    <div class="td width10"><div class="cwd_inn7">$6,161.65<br />-$520.00<br />-$400.00<br />-$30.00</div></div>
                                                    <div class="td width5 last"><div class="cwd_inn8">N-T<br />N-T<br />GST<br />N-T</div></div>
                                                
                                                 </div>
                        </div>
                        <div class="list_table_2">
                          <div class="table-row alt_one">
                                                    <div class="td width10 first"><div class="lwd_inn1">COMMENT<br /> 2011.11.10<br />2012.01.04 </div></div>
                                                    
                                                    <div class="td width30"><div class="lwd_inn3">CODE<br />GST<br /><br />N-T</div></div>
                                                    <div class="td width5"><div class="lwd_inn4">RATE<br />10%<br />0%</div></div>
                                                    <div class="td width10"><div class="lwd_inn5">GST<br />-$36.36<br />$0.00</div></div>
                                                    <div class="td width10"><div class="lwd_inn6">SALE AMOUNT<br />-$363.64<br />$5,611.65</div></div>
                                                    <div class="td width10"><div class="lwd_inn7">SALE AMOUNT<br />FREIGHT<br />GST<br />TOTAL<br />PAID TODAY</div></div>
                                                    <div class="td width5"><div class="lwd_inn8">$5,211.65<br />$0.00 GST<br />GST
-$36.36<br />$5,211.65<br />$0.00</div></div>
                                                
                                                 </div>
                        </div>
                        <div class="list_table_3">
                          <div class="table-row alt_three">
                                                    <div class="td width10 first"><div class="bwd_inn1">Vendor ABN: 39 176 644 109</div></div>
                                                    
                                                    <div class="td width30"><div class="bwd_inn3">BALANCE DUE</div></div>
                                                    <div class="td width5"><div class="bwd_inn4">$5,211.65</div></div>
                                                    
                                                   <div class="login_button_3">
                            <input type="button" class="input_submit" onclick="window.history.back()" value="Add item" name="Button">
                            <input type="button" class="input_submit" onclick="window.history.back()" value="Remove" name="Button">
                        </div>
                                                
                                                 </div>
                        </div>
                        </div>
                        </div>
                        </div>
                    
                    </section>
                
                </section>
            </section>
            </article>
       