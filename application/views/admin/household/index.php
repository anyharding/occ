<script>
    checked = false;
    function checkedAll () {
            if (checked == false){checked = true}else{checked = false}
            for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
                document.getElementById('myform').elements[i].checked = checked;
            }
    }
    function submitform()
    {
            document.forms["myform"].submit();
    }
    function submitform1()
    {
            document.forms["myform"].action = "<?php  if($this->uri->segment(3) == 'advOwners') echo base_url().'admin/household/deactivateallhouse/advOwners'; else echo base_url().'admin/household/deactivateallhousehold'; ?>";
            document.forms["myform"].submit();
    }
    function submitform2()
    {
            document.forms["myform"].action = "<?php  echo base_url().'admin/household/deleteallhousehold'; ?>";
            document.forms["myform"].submit();
    }
    
</script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"> </script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery.tablesorter.js"> </script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/sort_style.css'; ?>" type="text/css" />
<script type="text/javascript">

//$(function() {
 //       $("table").tablesorter({debug: true});
//});
$(document).ready(function() 
    { 
        $("#ListTable").tablesorter();
    }   
); 

</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
            <td class="breadcrumb">Administrator > List Households</td>
            <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
          </tr>
        </table></td>
    </tr>
    <?php
    if(!empty($household)) {
                  ?>
    <tr>
      <td class="paging"><?php  echo $this->pagination->create_links(); ?></td>
    </tr>
    <tr>
      <td colspan="9"><?php
      
			    if(validation_errors()  || $this->session->userdata('message')|| $this->session->flashdata('message')){ ?>
        <div class='ActionMsgBox error' id='msgID' style='margin:10 10 0 0;margin-top: 10px;'>
          <?php
					  		echo validation_errors();
					  		echo $this->session->flashdata('message');
					  	?>
        </div>
        <?php }       
        ?>
      <?php
                            if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
                            <div class='ActionMsgBox success' id='msgID'>
                                <?php //
                                            echo $this->session->userdata('smessage');
                                            echo $this->session->flashdata('smessage');
                                            $this->session->unset_userdata('smessage');
                                    ?>
                            </div>
                            <?php } ?>
      </td>
    </tr>
    <tr>
      <td><?php echo form_open('/admin/household/activateallHousehold', array('id'=>'myform'));?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="ListTable">
                <thead>
                  <tr>
                    <th width="12%" class="bll"><?php echo anchor('', 'Select All', array('onclick'=>'checkedAll()'));?>
                      <?php //echo form_checkbox(array('name'=>'checkall', 'onclick'=>'checkedAll()')); ?></th>
                    <th width="15%" class="bl">Shop Name</th>
                    <th width="14%" class="bl">Site</th>
                    <th width="17%" class="bl">Purchase Time</th>
                    <th width="13%" class="bl">Contact No</th>
                    <th width="13%" class="bll last">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
			$i=0;
			foreach($household as $row){
				if($this->uri->segment(3) == 'advOwners') $link = "/advOwners";else $link = '';
                                ?>
                  <tr>
                    <td width="2%" class="bl"><?php echo form_checkbox(array('name'=>'check[]', 'value'=>''. $row->id)); ?></td>
                    <td width="15%" class="bl"><?php echo $row->shop_name;?></td>
                    <td width="14%" class="bl"><?php echo $row->site;?></td>
                    <td width="17%" class="bl"><?php echo $row->purchase_time;?></td>
                    <td width="13%" class="bl"><?php echo $row->contact_no;?></td>
                    <td width="13%" class="bl last"><?php if($row->status == 0)echo anchor('admin/household/activatehousehold/'.$row->id.$link, "<img src=".HTTP_PATH."img/accept.png"." width='16' height='16' border='0'>", 'title = Activate'); else echo anchor('admin/household/deactivatehousehold/'.$row->id.$link, "<img src=".HTTP_PATH."img/icon1.png"." width='16' height='16' border='0'>", 'title = Deactivate');?>
                      <?php echo anchor('/admin/household/edithousehold/'.$row->id, "<img src=".HTTP_PATH."img/edit1.gif"."  border='0'>",  'title = Edit'); ?> <?php echo anchor('/admin/household/deletehousehold/'.$row->id.$link, "<img src=".HTTP_PATH."img/icon2.png"." width='16' height='16' border='0'>",  array('title' => 'Delete','onclick'=>"return confirm('Are you sure you want to delete?')")); ?></td>
                  </tr>
                  <?php
			}?>
                </tbody>
              </table></td>
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="0" class="NoDataTable">
                <tr>
                  <td align="left"><a href="javascript: submitform()"><img src="<?php echo HTTP_PATH; ?>img/activeBtn.png" width="109" height="42"></a></td>
                  <td align="left"><a href="javascript: submitform1()"><img src="<?php echo HTTP_PATH; ?>img/deactiveBtn.png" width="107" height="41"></a></td>
                  <td><td align="left"><a href="javascript: submitform2()"><img src="<?php echo HTTP_PATH; ?>img/deleteBtn.png" width="109" height="42"></a></td></td>
                </tr>
              </table>
              <?php echo form_close(); ?></td>
          </tr>
          <?php
                  }else {
                  ?>
          <tr>
            <td colspan="9" align="center"><img style="margin-top: 20px;" src="<?php echo HTTP_PATH;?>img/no-record.jpg"></td>
          </tr>
          <?php
                  }
                  ?>
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