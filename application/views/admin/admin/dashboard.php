<table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
    <!-- Header table -->
    <tr>
        <td align="left">
            <div class="Admin"> 
                <table width="560" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="9"><img src="<?php echo HTTP_PATH; ?>img/admin_left.png" width="9" height="53"></td>
                        <td background="<?php echo HTTP_PATH; ?>img/admin_mid.png" class="site_title">
                            <img src="<?php echo HTTP_PATH; ?>img/administrator.png" align="absmiddle"> - <span class="site_name"><?php echo SITE_TITLE; ?></span></td>
                        <td width="9"><img src="<?php echo HTTP_PATH; ?>img/admin_right.png" width="9" height="53"></td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <?php /*                                 * ********** First Colom ************************ */ ?>
                                <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                            <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                            <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                                        </tr>
                                        <tr>
                                            <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                            <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                                <tr>
                                                                    <td width="15%"><?php echo img('img/worsite.png', array('width' => "31", 'height' => "31")); ?></td>
                                                                    <td width="85%" class="title">Manage Worksite</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('admin/worksite/index', 'List Worksites'); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('admin/worksite/addWorksite', 'Add Worksite'); ?></td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                                        <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                                        <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                    <?php /*                     * ********** End First Colom ************************ */ ?>
                    <?php /*                     * ********** Start Configurations ************************ */ ?>
                    <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                            </tr>
                            <tr>
                                <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                                <tr>
                                                                    <td width="15%"><?php echo img('img/user.png', array('width' => "31", 'height' => "31")); ?></td>
                                                                    <td width="85%" class="title">Manage Power users</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('/admin/powerusers', 'List Power users'); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('/admin/powerusers/addPoweruser', 'Add Power user'); ?></td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table></td>
                                <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                            <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
        <?php /*         * ********** End Configurations ************************ */ ?>
        <?php /*         * ********** Start Logout ************************ */ ?>
        <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                    <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                    <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                </tr>
                <tr>
                    <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                    <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr>
                                <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                        <tr>
                                            <td width="15%"><?php echo img('img/user.png', array('width' => "31", 'height' => "31")); ?></td>
                                            <td width="85%" class="title">Manage Recruitment HR</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                        <td width="92%" align="left"><?php echo anchor('/admin/recruitments', 'List Recruitment HR'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                        <td width="92%" align="left"><?php echo anchor('/admin/recruitments/addRecruitment', 'Add Recruitment HR'); ?></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table>
                    </td>
                    <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                <tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <?php /*                                 * ********** First Colom ************************ */ ?>
                                <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                            <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                            <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                                        </tr>
                                        <tr>
                                            <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                            <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                                <tr>
                                                                    <td width="15%"><?php echo img('img/car.png', array('width' => "31", 'height' => "31")); ?></td>
                                                                    <td width="85%" class="title">Manage Cars Details</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('admin/carManage/index', 'List Cars'); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('admin/carManage/addCar', 'Add Car'); ?></td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                                        <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                                        <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                    <?php /*                     * ********** End First Colom ************************ */ ?>
                    <?php /*                     * ********** Start Configurations ************************ */ ?>
                    <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                            </tr>
                            <tr>
                                <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                                <tr>
                                                                    <td width="15%"><?php echo img('img/seeker.png', array('width' => "31", 'height' => "31")); ?></td>
                                                                    <td width="85%" class="title">Manage Applicants</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('admin/applicant/index', 'List Applicants'); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('admin/applicant/addApplicant', 'Add Applicant'); ?></td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table></td>
                                <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                            <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
        <?php /*         * ********** End Configurations ************************ */ ?>
        <?php /*         * ********** Start Logout ************************ */ ?>
        <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                    <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                    <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                </tr>
                <tr>
                    <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                    <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr>
                                <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                        <tr>
                                            <td width="15%"><?php echo img('img/money.png', array('width' => "31", 'height' => "31")); ?></td>
                                            <td width="85%" class="title">Manage Payment</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                        <td width="92%" align="left"><?php echo anchor('admin/payment/index', 'List Payments'); ?></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table>
                    </td>
                    <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
    </tr>

    <?php ///************************************//?>

    <tr>
        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                <tr>
                    <?php /*                     * ********** Start Logout ************************ */ ?>
                    <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                            </tr>
                            <tr>
                                <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                    <tr>
                                                        <td width="15%"><?php echo img('img/content.png', array('width' => "31", 'height' => "31")); ?></td>
                                                        <td width="85%" class="title">Manage Content</td>   
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                                <tr>
                                                                    <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                    <td width="92%" align="left"><?php echo anchor('admin/content', 'List Content'); ?></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                                <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                            <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                    <?php /*                     * ********** Start Configurations ************************ */ ?>
                    <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                            </tr>
                            <tr>
                                <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                                <tr>
                                                                    <td width="15%"><?php echo img('img/configuration.png', array('width' => "31", 'height' => "31")); ?></td>
                                                                    <td width="85%" class="title">Configurations</td> 
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('/admin/admin/changeEmail', 'Change Email'); ?></td>
                                                                            </tr>                                
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('admin/admin/changePassword', 'Change Password'); ?></td>
                                                                            </tr>    

                                                                        </table></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table></td>
                                <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                            <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
        <?php /*         * ********** End Logout ************************ */ ?>
        <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                    <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                    <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                </tr>
                <tr>
                    <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                    <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr>
                                <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                        <tr>
                                            <td width="15%"><?php echo img('img/flush.png'); ?></td>
                                            <td width="85%" class="title">Flush Old Employees</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                        <td width="92%" align="left"><?php echo anchor('/admin/users', 'Flush'); ?></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table>
                    </td>
                    <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                <tr>
                    <?php /*                     * ********** Start Logout ************************ */ ?>
                    <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                            </tr>
                            <tr>
                                <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                    <tr>
                                                        <td width="15%"><?php echo img('img/logs.png', array('width' => "31", 'height' => "31")); ?></td>
                                                        <td width="85%" class="title">Contractors Login Log</td>   
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                                <tr>
                                                                    <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                    <td width="92%" align="left"><?php echo anchor('admin/logs', 'List Logs'); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                    <td width="92%" align="left"><?php echo anchor('admin/logs/lastsixMonths', 'List Logs for last six months'); ?></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                                <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                            <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                    <?php /*                     * ********** Start Configurations ************************ */ ?>
                    <td align="left"><table width="270" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="19"><?php echo img('img/tl.png', array('width' => "19", 'height' => "19")); ?></td>
                                <td width="100%" background="<?php echo HTTP_PATH; ?>img/midt.png"><img src="<?php echo HTTP_PATH; ?>img/spacer.gif" width="1" height="19"></td>
                                <td width="19" align="right"><?php echo img('img/tr.png', array('width' => "19", 'height' => "19")); ?></td>
                            </tr>
                            <tr>
                                <td background="<?php echo HTTP_PATH; ?>img/center-left.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                                <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td height="100" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
                                                                <tr>
                                                                    <td width="15%"><?php echo img('img/logout.png', array('width' => "31", 'height' => "31")); ?></td>
                                                                    <td width="85%" class="title">Logout</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left"><?php echo img('img/arrow.png', array('width' => "6", 'height' => "7")); ?></td>
                                                                                <td width="92%" align="left"><?php echo anchor('/admin/admin/logout', 'Logout'); ?></td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table></td>
                                <td background="<?php echo HTTP_PATH; ?>img/center-right.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "1")); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="19" height="27"><?php echo img('img/br.png'); ?></td>
                                            <td background="<?php echo HTTP_PATH; ?>img/midb.png"><?php echo img('img/spacer.gif', array('width' => "1", 'height' => "27")); ?></td>
                                            <td width="19" height="27"><?php echo img('img/bl.png', array('width' => "19", 'height' => "27")); ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
    </tr>

    <?php //*************************************//?>
</table>
</td>
</tr>
</table>