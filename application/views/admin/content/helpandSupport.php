<script type="text/javascript" src="<?php echo HTTP_PATH.'js/ckeditor.js'; ?>"></script>
<script src="<?php echo HTTP_PATH.'js/sample.js'; ?>" type="text/javascript"></script>
<link href="<?php echo HTTP_PATH.'css/sample.css'; ?>" rel="stylesheet" type="text/css" />
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Content Management</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <div class="Block table">
                    	<div class="BlockContent">
		                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                      <tr>
                        <th>Update Content</th>
                      </tr>
			<tr><td colspan="2">
			
			<?php
			    if(validation_errors()  || $this->session->userdata('message')  || $this->session->flashdata('message')){ ?>
					  <div class='ActionMsgBox error' id='msgID'>
					  	<?php
					  		echo validation_errors();
					  		echo $this->session->flashdata('message');
					  	?>
					  </div>
			  <?php } ?>
			</td></tr>
                       	<tr>
                        <td>
                         <?php echo form_open('/admin/content/contentManagement/'.$this->uri->segment(4));?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="200">Title <span class="required">*</span>:</td>
                                <td><?php echo form_input(array('name'=>'title', 'id'=>'title', 'value'=>$content_detail[0]['title'])) ?></td>
                              </tr>
                              <tr>
                                <td width="20">Content <span class="required">*</span>:</td>
                                <td width="1000"><?php
								$data = array(
                                                                      'name'        => 'content',
                                                                     'id'	    => 'editor1',
                                                                     'class'	    => 'ckeditor',
                                                                     'cols'	    => '60',
                                                                     'rows'	    => '10',
                                                                     'value'        => $content_detail[0]['content']
                                                                );
								echo form_textarea($data);
								?>
                                
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input type="image" src="<?php echo HTTP_PATH.'img/submitBtn.png';?>">
</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>
						<?php echo form_close();?>
                        </td>
                      </tr>                      
                    </table>
                    	</div>
                    </div>
                    </td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
