<div class="middle_bottom_link">
<ul><li><span class="icon_btm1"><img src="<?php echo HTTP_PATH;?>img/post_icon.jpg" alt="" /></span><a href="<?php echo HTTP_PATH.'advertisement'; ?>">Post a Classified</a></li>
<?php 
if(isset($this->session->userdata['userId'])) {?>
<li><span class="icon_btm2"><img src="<?php echo HTTP_PATH;?>img/my_account_icon.jpg" alt="" /></span><?php echo anchor('welcome/myProfile', 'My Account'); ?></li>
<?php 
}
if(!isset($this->session->userdata['userId'])) {?>
<li><span class="icon_btm3"><img src="<?php echo HTTP_PATH;?>img/register_icon.jpg" alt="" /></span><?php echo anchor('/welcome/registration', 'Register'); ?></li>
<?php }?>
</ul>
<div class="small_text">
<?php echo anchor('/welcome/helpAndSupport', 'Help').'I'; ?>       <?php echo anchor('/welcome/termAndConditions', 'Terms and Conditions').' I'; ?>      <a href="#">Popular product </a>    I   <?php echo anchor('/welcome/payPalAccount', ' Obtain your PayPal  Account'); ?> 
</div>
    
</div>

