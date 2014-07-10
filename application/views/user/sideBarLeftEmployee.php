<?php
if ($this->uri->segment(3) == 'myProfile') {
    $class = array('class' => 'active');
} else {
    $class = NULL;
}

if ($this->uri->segment(3) == 'batchpayment' or $this->uri->segment(3) == 'viewPayment') {
    $class1 = array('class' => 'active');
} else {
    $class1 = NULL;
}
?>

<section class="sideCol">		   
    <div class="manag_acnt_tp_btm power_mode_sidebar">
        <div class="manag_acnt_tp"><h2>MANAGE  ACCOUNT</h2></div>
        <ul>
            <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/profile-detail.png"><?php echo anchor('/s/employees/myProfile', 'My Profile', $class); ?></li>
            <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/payment_manage.png"><?php echo anchor('/s/employees/batchpayment', 'List Batch Payment', $class1); ?> </li>
            <li><img alt="" src="<?php echo HTTP_PATH; ?>img/logout.png"><?php echo anchor('/s/employees/logout', 'Logout'); ?> </li>
        </ul>
    </div>
</section>