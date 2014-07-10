<?php
if($this->session->userdata('adminId')){
            redirect('admin/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo FRONT_TITLE;?>::Admin-<?php echo $title;?></title>
<link href="<?php echo HTTP_PATH.'css/admin.css'; ?>" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo HTTP_PATH;?>img/favicon.ico">

<script  src="<?php echo HTTP_PATH.'js/jquery.validate.js'; ?>" type="text/javascript"></script>
</head>
<body class="signin">
<div class="DivMain">
	<div class="front-card">
    	<table width="414" border="0" background="<?php echo HTTP_PATH; ?>img/login_box.png" align="center" height="362">
          <tr>
            <td valign="top">
               <?php echo $contents ?>
            </td>
          </tr>
        </table>
    </div>
</div>
</body>
