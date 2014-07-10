<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
            <td class="breadcrumb">Administrator > Content List</td>
            <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="9"><?php
			    if(validation_errors()  || $this->session->userdata('message')|| $this->session->flashdata('message')){ ?>
        <div class='ActionMsgBox error' id='msgID'>
          <?php
					  		echo validation_errors();
					  		echo $this->session->flashdata('message');
					  	?>
        </div>
        <?php } ?><?php
                            if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
                            <div class='ActionMsgBox success' id='msgID'>
                                <?php
                                            echo $this->session->userdata('smessage');
                                            echo $this->session->flashdata('smessage');
                                            $this->session->unset_userdata('smessage');
                                    ?>
                            </div>
                            <?php } ?></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="ListTable">
                <tr>
                  <th width="15%" class="bl">Category Id</th>
                  <th width="14%" class="bl">Content Title</th>
                  <th width="13%" class="bl last">Action</th>
                </tr>
                <?php
			$i=0;
			foreach($content_list as $row){
				if($i%2 == 1) $bgColor = "#ffffff"; else $bgColor = "#F4F8FE";

				?>
                <tr >
                  <td width="15%" class="bl"><?php echo $row->id;?></td>
                  <td width="14%" class="bl"><?php echo $row->title;?></td>
                  <td width="13%" class="bl last"><?php echo anchor('/admin/content/contentManagement/'.$row->id, "<img src=".HTTP_PATH."img/edit1.gif"." border='0'>", 'title = Edit'); ?></td>
                </tr>
                <?php
			}?>
              </table></td>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="NoDataTable">
                <tr>
                  <td width="20%" align="left"></td>
                  <td width="20%" align="left"></td>
                  <td></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr> 