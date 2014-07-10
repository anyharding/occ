 <?php
    if(validation_errors()  || $this->session->userdata('message')){ ?>
    <div class='ActionMsgBox error fix' id='msgID'style="margin-left:30px;margin-top:3px;">
        <?php
                echo validation_errors();
                echo $this->session->userdata('message');
                $this->session->unset_userdata('message');
        ?>
    </div>
<?php } ?>
  <?php
if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
  <div class='ActionMsgBox success fix' id='msgID'style="margin-left:30px;margin-top:3px;">
    <?php
                echo $this->session->userdata('smessage');
                echo $this->session->flashdata('smessage');
                $this->session->unset_userdata('smessage');
        ?>
  </div>
  <?php } ?>

 <?php echo form_open('admin/admin/forgotPassword',array('name'=>'adminLogin','id'=>'adminLogin')); ?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" height="40">
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="50" height="120"><img src="<?php echo HTTP_PATH; ?>img/forgotpass.png" /></td>
        <td width="200"><h1>Forgot Password</h1></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td valign="top">
       <table width="96%" border="0" align="center">
            	<tr>
                <td width="100" align="right">Enter Email:</td>
                <td width="20">&nbsp;</td>
                <td><?php echo form_input(array('id'=>'email', 'class'=>'required', 'name'=>'email')); ?></td>
              </tr>
				
                <tr>
                <td width="100" height="50">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td><input type="image" src="<?php echo HTTP_PATH; ?>img/submit.png" /></td>
              </tr>
               
                <tr>
                <td width="100" height="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td><?php echo anchor('admin/admin/login',"Go To Login.....");?></td>
                </tr>
               

    </table>
    </td>
  </tr>
</table>

 <?php echo form_close();?>