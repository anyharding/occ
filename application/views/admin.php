<?php
if(!$this->session->userdata('adminId')){
            redirect('admin/admin/login');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo FRONT_TITLE;?>::Admin-<?php echo $title;?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo HTTP_PATH;?>img/favicon.ico">
<script  src="<?php echo HTTP_PATH.'js/jquery-1.3.2.js'; ?>" type="text/javascript"></script>
<script  src="<?php echo HTTP_PATH.'js/jquery.jclock-1.2.0.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function($) {
    var options = {
    timeNotation: '12h',
    displayDate: true,
    am_pm: true,utc: true,
    utc_offset:-5,
    fontFamily: 'Verdana, Times New Roman',
    fontSize: '12px',
    foreground: 'black'
    //background: 'red'
    };
    $('.jclock').jclock(options);
    });
    $(function($) {
    var options = {
    timeNotation: '12h',
    displayDate: true,
    utc_offset:-7,
    am_pm: true,utc: true,
    fontFamily: 'Verdana, Times New Roman',
    fontSize: '12px',
    foreground: 'black'
    //background: 'red'
    };
    $('.jclock1').jclock(options);
    });
    $(function($) {
    var options = {
    timeNotation: '12h',
    displayDate: true,
    utc_offset:-8,
    am_pm: true,utc: true,
    fontFamily: 'Verdana, Times New Roman',
    fontSize: '12px',
    foreground: 'black'
    //background: 'red'
    };
    $('.jclock2').jclock(options);
    });
    $(function($) {
    var options = {
    timeNotation: '12h',
    utc_offset:-6,
    displayDate: true,
    am_pm: true,utc: true,
    fontFamily: 'Verdana, Times New Roman',
    fontSize: '12px',
    foreground: 'black'
    //background: 'red'
    };
    $('.jclock3').jclock(options);
    });
</script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/admin.css'; ?>" type="text/css" />
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="header">
        <!-- Header table -->
        <tr>
          <td>
                                   
          		<div class="topLoggedin">
                	<span class="login_as">Logged in as admin</span>&nbsp;|&nbsp;
                    <span class="logout"><?php echo anchor('admin/admin/logout', 'Logout'); ?></span>
                </div>
        </td>
        </tr>
      </table></td>
    <!-- Header table --> 
  </tr>
  <tr>
    <td valign="top"><table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td align="left">
          <div class="Admin prefix_1"> 
            <table width="560" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="9"><img src="<?php echo HTTP_PATH; ?>img/admin_left.png" width="9" height="53"></td>
                        <td background="<?php echo HTTP_PATH; ?>img/admin_mid.png" class="site_title"><img src="<?php echo HTTP_PATH; ?>img/administrator.png" align="absmiddle"> - <span class="site_name"><?php echo FRONT_TITLE;?></span></td>
                        <td width="9"><img src="<?php echo HTTP_PATH; ?>img/admin_right.png" width="9" height="53"></td>
                      </tr>
                    </table>
          </div>
          </td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="220" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="220"><img src="<?php echo HTTP_PATH; ?>img/admin_menu.png" width="189" height="38"></td>
                    </tr>
                    <tr>
                      <td><?php $this->load->view('element/admin_left_menu');?>
                        <?php echo $contents ?>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="footer">
                          <!-- Footer table -->
                          <tr>
                            <td><p> &copy; <?php echo date("Y"); ?> All Rights Reserved &nbsp;I&nbsp;<a href="#">Legal</a>&nbsp;I&nbsp; <a href="#">Advertising</a></p>
                              <p><a href="http://www.logicspice.com/" target="_blank">Web Development Company</a> LogicSpice</p></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>