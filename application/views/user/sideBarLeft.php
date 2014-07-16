
<?php
if ($this->uri->segment(2) == 'myProfile') {
    $class = array('class' => 'active');
} else {
    $class = NULL;
}

if ($this->uri->segment(2) == 'editProfile') {
    $class1 = array('class' => 'active');

} else {
    $class1 = NULL;
}

if ($this->uri->segment(2) == 'changePassword') {
    $class2 = array('class' => 'active');
} else {
    $class2 = NULL;
}

if ($this->uri->segment(1) == 'houses' and $this->uri->segment(2) <> 'addHouse') {
    $class3 = array('class' => 'active');
} else {
    $class3 = NULL;
}

if ($this->uri->segment(1) == 'houses' and $this->uri->segment(2) == 'addHouse') {
    $class11 = array('class' => 'active');
} else {
    $class11 = NULL;
}

if ($this->uri->segment(1) == 'household' and $this->uri->segment(2) <> 'addHousehold') {
    $class4 = array('class' => 'active');
} else {
    $class4 = NULL;
}

if ($this->uri->segment(1) == 'household' and $this->uri->segment(2) == 'addHousehold') {
    $class13 = array('class' => 'active');
} else {
    $class13 = NULL;
}

if ($this->uri->segment(1) == 'worksite' and $this->uri->segment(2) <> 'addWorksite') {
    $class5 = array('class' => 'active');
} else {
    $class5 = NULL;
}

if ($this->uri->segment(1) == 'worksite' and $this->uri->segment(2) == 'addWorksite') {
    $class12 = array('class' => 'active');
} else {
    $class12 = NULL;
}

if ($this->uri->segment(2) == 'listHR' and $this->uri->segment(1) == 'users') {
    $class6 = array('class' => 'active');
} else {
    $class6 = NULL;
}
if ($this->uri->segment(1) == 'houses' and $this->uri->segment(2) == 'addHouse') {
    $class10 = array('class' => 'active');
} else {
    $class10 = NULL;
}

if ($this->uri->segment(2) == 'addHRRecr') {
    $class7 = array('class' => 'active');
} else {
    $class7 = NULL;
}

if ($this->uri->segment(1) == 'users' and ($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '')) {
    $class8 = array('class' => 'active');
} else {
    $class8 = NULL;
}

if ($this->uri->segment(2) == 'addUser') {
    $class9 = array('class' => 'active');
} else {
    $class9 = NULL;
}

if ($this->uri->segment(2) == 'empResigList') {
    $class99 = array('class' => 'active');
} else {
    $class99 = NULL;
}
if ($this->uri->segment(1) == 'rent' and $this->uri->segment(2) <> 'addRent' and $this->uri->segment(2) <> 'batchPayments') {
    $class16 = array('class' => 'active');
} else {
    $class16 = NULL;
}

if ($this->uri->segment(2) == 'batchPayments') {
    $batchPayments = array('class' => 'active');
} else {
    $batchPayments = NULL;
}
if ($this->uri->segment(2) == 'addRent') {
    $class15 = array('class' => 'active');
} else {
    $class15 = NULL;
}
if ($this->uri->segment(1) == 'carManage' and ($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '' )) {
    $class17 = array('class' => 'active');
} else {
    $class17 = NULL;
}
if ($this->uri->segment(2) == 'addCar') {
    $class18 = array('class' => 'active');
    
   
} else {
    $class18 = NULL;
}


if ($this->uri->segment(1) == 'applicant' and ($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '' )) {
    $class119 = array('class' => 'active');
} else {
    $class119 = NULL;
}
if ($this->uri->segment(2) == 'addApplicant') {
    $class120 = array('class' => 'active');
} else {
    $class120 = NULL;
}

if ($this->uri->segment(1) == 'payment' and ($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '' )) {
    $class19 = array('class' => 'active');
} else {
    $class19 = NULL;
}
if ($this->uri->segment(2) == 'batchPayment') {
    $class20 = array('class' => 'active');
} else {
    $class20 = NULL;
}
if ($this->uri->segment(2) == 'visaExpiryCheck') {
    $class_visaexpiry = array('class' => 'active');
} else {
    $class_visaexpiry = NULL;
}
if ($this->uri->segment(2) == 'sixmonthcheck') {
    $sixmonthcheck = array('class' => 'active');
} else {
    $sixmonthcheck = NULL;
}
if ($this->uri->segment(1) == 'probation') {
    $class_probation = array('class' => 'active');
} else {
    $class_probation = NULL;
}
if ($this->uri->segment(2) == 'changeAddressCheck') {
    $changeAddressCheck = array('class' => 'active');
} else {
    $changeAddressCheck = NULL;
}
if ($this->uri->segment(2) == 'listinvoices') {
    $list = array('class' => 'active');
} else {
    $list = NULL;
}
if ($this->uri->segment(2) == 'generateInvoice') {
    $generateInvoice = array('class' => 'active');
} else {
    $generateInvoice = NULL;
}
if ($this->uri->segment(1) == 'company' and ($this->uri->segment(2) == 'index' OR $this->uri->segment(2) == '' )) {
    $company = array('class' => 'active');
} else {
    $company = NULL;
}
if ($this->uri->segment(1) == 'company' and $this->uri->segment(2) == 'addCompany') {
    $add_company = array('class' => 'active');
} else {
    $add_company = NULL;
}


if ($this->uri->segment(1) == 'paycompany' and ($this->uri->segment(2) == 'index' OR $this->uri->segment(2) == '' )) {
    $paycompany = array('class' => 'active');
} else {
    $paycompany = NULL;
}
if ($this->uri->segment(1) == 'paycompany' and $this->uri->segment(2) == 'addCompany') {
    $add_paycompany = array('class' => 'active');
} else {
    $add_paycompany = NULL;
}
?>
<?php
$this->load->library('session');
session_start();
$id = $this->session->userdata('userId');
$user_detail = $this->Welcome->fullUserDetail($id);
if ($user_detail['role'] == 4) {
    ?>
    <section class="sideCol">		   
        <div class="manag_acnt_tp_btm power_mode_sidebar">
            <div class="manag_acnt_tp"><h2>MANAGE  ACCOUNT</h2></div>
            <ul>
                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/profile-detail.png"><?php echo anchor('/applicant', 'Applicant List', $class119); ?></li>
                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/edit_profile.png"><?php echo anchor('/applicant/addApplicant', 'Add Applicant', $class120); ?> </li>
                <li> <img  alt="" src="<?php echo HTTP_PATH; ?>img/list_emp.png"><?php echo anchor('users', 'List Contractors', $class8) ?> </li>
                <li> <img width="16" height="16" alt="" src="<?php echo HTTP_PATH; ?>img/my_account_icon.png"><?php echo anchor('users/empResigList', 'Contractor Resignation List', $class99) ?></li>
                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/list_house.png"><?php echo anchor('houses', 'List Houses', $class3) ?> </li>
                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/list_households.png"><?php echo anchor('household', 'List Household Items', $class4) ?> </li>
                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/change_password.png"><?php echo anchor('/welcome/changePassword', 'Change Password', $class2); ?> </li>
                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/logout.png"><?php echo anchor('/welcome/logout', 'Logout'); ?> </li>
            </ul>
        </div>
    </section>
    <?php
}
if ($user_detail['role'] == 2) {
    ?>
    
	<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
    <div class="sideCol">
        <div class="manag_acnt_tp_btm power_mode_sidebar" id="left_nav">
            <div class="manag_acnt_tp"><h2>MANAGE  MENU</h2></div>
            <ul>
                <!--<li> <img alt="" src="<?php echo HTTP_PATH; ?>img/profile-detail.png"><?php echo anchor('/welcome', 'Profile Detail', $class); ?></li>-->
                <li >
                	<a id="contractor_menu" href="#contractor" class="nav-header collapsed menu-first" data-toggle="collapse">Contractor</a>
	                <ul id="contractor" class="nav collapse">
		                <li> <img  alt="" src="<?php echo HTTP_PATH; ?>img/list_emp.png"><?php echo anchor('users', 'List Contractors', $class8) ?> </li>
		                <li> <img width="16" height="16" alt="" src="<?php echo HTTP_PATH; ?>img/my_account_icon.png"><?php echo anchor('users/addUser', 'Add Contractors', $class9) ?></li>
		                <li>
		                    <img alt="" src="<?php echo HTTP_PATH; ?>img/address.png" height="16"><?php echo anchor('users/changeAddressCheck', 'Change address check', $changeAddressCheck) ?>
		                </li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/visa_expiry.png" height="16"><?php echo anchor('payment/visaExpiryCheck', 'Visa Expiry Check', $class_visaexpiry) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/month.png" height="16"><?php echo anchor('users/sixmonthcheck', '6 month check', $sixmonthcheck) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/my_account_icon.png" height="16" width="16"><?php echo anchor('probation', 'Contractors In Probation', $class_probation) ?></li>
		                <li> <img width="16" height="16" alt="" src="<?php echo HTTP_PATH; ?>img/my_account_icon.png"><?php echo anchor('users/empResigList', 'Contractor Resignation List', $class99) ?></li>
	              	</ul>
              	</li>
              	
              	<li>
              		<a id="house_and_rent_menu" href="#house_and_rent" class="menu-first nav-header collapsed" data-toggle="collapse">House and Rent</a>
	              	<ul id="house_and_rent" class="nav collapse">
		                <!--li> <img width="16" height="16" alt="" src="<?php echo HTTP_PATH; ?>img/add_hr.png"><?php echo anchor('users/addHRRecr', 'Add HR Staff', $class7) ?></li-->
		                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/list_house.png"><?php echo anchor('houses', 'List Houses', $class3) ?> </li>
		                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/house.png"><?php echo anchor('houses/addHouse', 'Add House', $class11) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/rent.png" height="16" width="16"><?php echo anchor('rent', 'List Rent Payment', $class16) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/add_rent.png" height="16"><?php echo anchor('rent/addRent', 'Add Rent Payment', $class15) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/rent.png" height="16" width="16"><?php echo anchor('rent/batchPayments', 'Rent batch payments', $batchPayments) ?></li>
	                </ul>
                </li>
                
                <li>
                	<a href="#car_and_house_hold" id="car_and_house_hold_menu" class="menu-first nav-header collapsed" data-toggle="collapse">Car and House hold</a>
	                <ul id="car_and_house_hold" class="nav collapse">
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/car.png" height="16" width="16"><?php echo anchor('carManage', 'Car Management', $class17) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/add_car.png" height="16"><?php echo anchor('carManage/addCar', 'Add Car', $class18) ?></li>
                                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/list_households.png"><?php echo anchor('household', 'List Household Items', $class4) ?> </li>
		                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/add_household.png"><?php echo anchor('household/addHousehold', 'Add Household', $class13) ?></li>
	                </ul>
	           </li>
                
                <li>
                	<a id="finance_menu" href="#finance" data-toggle="collapse" class="menu-first nav-header collapsed">Payment and Invoice</a>
					<ul id="finance" class="nav collapse">
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/payment_manage.png" height="16"><?php echo anchor('payment', 'List Batch Payments', $class19) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/money.png" height="16" width="16"><?php echo anchor('payment/batchPayment', 'New Batch Payments', $class20) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/invoice.png" height="16"><?php echo anchor('invoice/generateInvoice', 'Generate Invoice', $generateInvoice) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/invoice.png" height="16"><?php echo anchor('invoice/listinvoices', 'List Invoices', $list) ?></li>
	                </ul>
                </li>
                
                <li>
                	<a id="admin_menu" href="#admin" data-toggle="collapse" class="menu-first nav-header collapsed">Administration</a>
	                <ul id="admin" class="nav collapse">
                            	<li><img alt="" src="<?php echo HTTP_PATH; ?>img/powerusers.png"><?php echo anchor('users/listHR', 'List HR Staff', $class6) ?> </li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/comp.png" height="16"><?php echo anchor('company', 'List Companies', $company) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/add_comp.png" height="16"><?php echo anchor('company/addCompany', 'Add Company', $add_company) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/listpay.png" height="16"><?php echo anchor('paycompany', 'List Pay Companies', $paycompany) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/addpay.png" height="16"><?php echo anchor('paycompany/addCompany', 'Add Pay Company', $add_paycompany) ?></li>
                                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/worksite.png" height="16" width="16"><?php echo anchor('worksite', 'List Worksites', $class5) ?></li>
		                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/add_worksite.png" height="16"><?php echo anchor('worksite/addWorksite', 'Add Worksites', $class12) ?></li>
	                </ul>
                </li>
                
                <li> <img alt="" src="<?php echo HTTP_PATH; ?>img/edit_profile.png"><?php echo anchor('/welcome/editProfile', 'Edit Profile', $class1); ?> </li>
                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/change_password.png"><?php echo anchor('/welcome/changePassword', 'Change Password', $class2); ?> </li>
                <li><img alt="" src="<?php echo HTTP_PATH; ?>img/logout.png"><?php echo anchor('/welcome/logout', 'Logout'); ?> </li>
                
            </ul>
        </div>
    </div>
    <?php
}
?>
        

<?php

if (($this->uri->segment(1) == 'users' || $this->uri->segment(2) == 'visaExpiryCheck' ||$this->uri->segment(1) == 'probation') && $this->uri->segment(2) != 'listHR'  ) {
  $openMenu = '#contractor_menu';
}
else if($this->uri->segment(1) == 'houses'|| $this->uri->segment(1) == 'rent' )
{
  $openMenu = '#house_and_rent_menu';   
}
else if($this->uri->segment(1) == 'household' || $this->uri->segment(1) == 'carManage'  )
{
  $openMenu = '#car_and_house_hold_menu';   
}
else if($this->uri->segment(1) == 'payment' || $this->uri->segment(1) == 'invoice')
{
 $openMenu = '#finance_menu'; 
}
else if($this->uri->segment(2) == 'listHR' || $this->uri->segment(1) == 'company' ||$this->uri->segment(1) == 'paycompany'  || $this->uri->segment(1) == 'worksite'  )
{
 $openMenu = '#admin_menu'; 
}


echo"<script language='javascript'>
  $('$openMenu').click();
</script>
";




?>