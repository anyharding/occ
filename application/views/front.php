<!doctype html>
<html lang="en">
    <head>
        <meta charset=utf-8 />
        <title><?php if ($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '') echo "Welcome to"; ?> <?php echo FRONT_TITLE; ?>::<?php echo $title; ?></title>

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo HTTP_PATH; ?>img/favicon.ico"/>
        <link href="<?php echo HTTP_PATH; ?>css/style.css" rel="stylesheet" type="text/css" />
        <!-- stylesheets -->
        <!--[if IE 8]>
          <link rel="stylesheet" type="text/css" media="all" href="<?php echo HTTP_PATH; ?>css/ie8.css" />
        <![endif]-->
        <!-- javascript -->
        <script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/scrolltopcontrol.js"></script>
        <!--conditional comments -->
        <!--[if lt IE 9]><script src="<?php echo HTTP_PATH; ?>js/html5.js"></script><![endif]-->
        <script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/DD_roundies_0.0.2a-min.js"></script>
        <!-- /* Round Corners Script by sanjay */ -->
        <script type="text/javascript">
            /* IE only */
            DD_roundies.addRule('.user_name_box', '4px 4px 4px 4px;');

            /* varying radius, IE only */
            DD_roundies.addRule('.user_name_box', '4px 4px 4px 4px');


            /* varying radius, "all" browsers */
            DD_roundies.addRule('.user_name_box', '4px 4px 4px 4px');

            function MM_swapImgRestore() { //v3.0
                var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
            }
            function MM_preloadImages() { //v3.0
                var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
                    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
                        if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
                }

                function MM_findObj(n, d) { //v4.01
                    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
                        d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
                    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
                    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
                    if(!x && d.getElementById) x=d.getElementById(n); return x;
                }

                function MM_swapImage() { //v3.0
                    var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
                    if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
                }
        </script>
        <!-- /* End Round Corners Script */ -->
    </head>

    <body>
        <div class="all_bg" style="display:none">
            <div class="all_bg_ldr"><img width="128" height="128" src="<?php echo HTTP_PATH; ?>img/gif.gif" alt=""></div>
        </div>
        <div class="wrapper"
        <?php
//        if ($this->uri->segment(2) == 'batchPayment' or $this->uri->segment(2) == 'viewPayment') {
//            echo "style='width:1532px'";
//        }
        ?> >
            <header>
                <div class="logo_area">
                    <a href="<?php echo HTTP_PATH; ?>"><img src="<?php echo HTTP_PATH; ?>img/logo.jpg" alt="" /></a>
                    <?php if ($this->session->userdata('userId') and $this->session->userdata('role') == 'poweruser' and $this->uri->segment(1) <> 's') { ?>
                        <div class="search-area">
                            <?php echo form_open('search'); ?>
                            SEARCH <span class="required1">*</span>
                            <?php
                            $data = array(
                                'name' => 'keyword',
                                'class' => 'textfield_input1',
                                'value' => $this->input->post('keyword')
                            );
                            echo form_input($data);
                            echo form_close();
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="logo_areanext">
                    <?php //if(isset($this->session->userdata['userId'])){ ?>
                    <span class="login_txt_inner"><!--Welcome--> 
                        <?php
                        //$this->load->model('user_model', 'User',true);
                        //$user = $this->User->userDetail($this->session->userdata('userId'));
                        //echo anchor('/welcome/logout', 'Logout').'&nbsp;'; 
                        //echo anchor('/welcome/myProfile', $user[0]['firstname']); 
                        ?>
                    </span>
                    <?php
                    // }
                    ?>
                </div>    
            </header>
            <?php echo $contents; ?>
            <footer class="footer">
                <div class="left_footer">
                    <p >
                        Copyright © <?php echo date('Y'); ?> LHG employee management system<br />
                        <a href="http://www.logicspice.com/" target="_blank">Web Development Company</a> LogicSpice</p></div>
                <div class="left_footer">
                    <p ><a href="http://validator.w3.org/check?uri=<?php echo HTTP_PATH; ?>" target="_blank"><img src="<?php echo HTTP_PATH; ?>img/w3cvalidhtml5.jpg" alt="" /></a></p></div>
            </footer>
        </div>
    </body>
</html>
