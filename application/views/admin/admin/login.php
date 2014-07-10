<?php
if(validation_errors()  || $this->session->userdata('message')){ ?>
    <div class='ActionMsgBox error fix' id='msgID'style="margin-left:30px;margin-top:0px;">
        <?php
                echo validation_errors();
                echo $this->session->userdata('message');
                $this->session->unset_userdata('message');
        ?>
    </div>
<?php } ?>
 <?php echo form_open('admin/admin/login',array('name'=>'adminLogin','id'=>'adminLogin')); ?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" height="40">
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="50" height="120"><img src="<?php echo HTTP_PATH; ?>img/login_user.png" /></td>
        <td width="200"><h1>Sign In</h1></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td valign="top"><table width="96%" border="0" align="center">
            	<tr>
                <td width="100" align="right">Username:</td>
                <td width="20">&nbsp;</td>
                <td><?php echo form_input(array('id'=>'username', 'class'=>'required', 'name'=>'username')); ?></td>
              </tr>
				<tr>
                <td width="100" align="right">Password:</td>
                <td width="20">&nbsp;</td>
                <td><?php echo form_password(array('id'=>'password', 'class'=>'password', 'name'=>'password')); ?></td>
              </tr>
                <tr>
                <td width="100" height="50">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td><input type="image" src="<?php echo HTTP_PATH; ?>img/submit.png" /></td>
              </tr>
                <tr>
                <td width="100" height="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td><?php echo anchor('admin/admin/forgotPassword',"Forgot Password..?");?></td>
                </tr>
                <tr>
                    <td align="center" width="100" height="20" colspan="3">
                        <div class="powered_by">
                            <a target="_blank" href="http://www.logicspice.com/">
                                <img src="<?php echo HTTP_PATH; ?>img/logicspice_logo.png" />
                            </a>
                        </div>
                    </td>
</tr>

    </table></td>
  </tr>
</table>

<?php echo form_close();?>