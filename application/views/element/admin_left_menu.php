<div class="Block leftmenu">
    <div class="BlockContent">
        <h2><img src ="<?php echo HTTP_PATH ?>img/dashboard.png" width="15" height="15">  Dashboard</h2>
        <ul>
            <li><?php echo anchor('admin', 'Dashboard'); ?></li>
            <li><?php echo anchor('welcome', 'Visit the website', 'target = "_blank"'); ?></li>
        </ul>
        <h2><img src ="<?php echo HTTP_PATH ?>img/powerusers.png" width="15" height="15"> Manage Power users</h2>
        <ul>
            <li><?php echo anchor('admin/powerusers/index', 'List Power users'); ?></li>
            <li><?php echo anchor('admin/powerusers/addPoweruser', 'Add Power user'); ?></li>
        </ul>
        <h2><img src ="<?php echo HTTP_PATH ?>img/user.png" width="15" height="15"> Manage Recruitment HR</h2>
        <ul>
            <li><?php echo anchor('admin/recruitments/index', 'List Recruitment HR'); ?></li>
            <li><?php echo anchor('admin/recruitments/addRecruitment', 'Add Recruitment HR'); ?></li>
        </ul>
        <h2><img src ="<?php echo HTTP_PATH ?>img/worksite.png" width="15" height="15"> Manage Worksite</h2>
        <ul>
            <li><?php echo anchor('admin/worksite/index', 'List Worksites'); ?></li>
            <li><?php echo anchor('admin/worksite/addWorksite', 'Add Worksite'); ?></li>
        </ul> 

        <h2><img src ="<?php echo HTTP_PATH ?>img/car.png" width="15" height="15"> Manage Car Details</h2>
        <ul>
            <li><?php echo anchor('admin/carManage/index', 'List Cars Details'); ?></li>
            <li><?php echo anchor('admin/carManage/addCar', 'Add Car Detail'); ?></li>
        </ul> 

        <h2><img src ="<?php echo HTTP_PATH ?>img/seeker.png" width="15" height="15"> Manage Applicants</h2>
        <ul>
            <li><?php echo anchor('admin/applicant/index', 'List Applicants'); ?></li>
            <li><?php echo anchor('admin/applicant/addApplicant', 'Add Applicant'); ?></li>
        </ul> 

        <h2><img src ="<?php echo HTTP_PATH ?>img/money.png" width="15" height="15"> Manage Payment</h2>
        <ul>
            <li><?php echo anchor('admin/payment/index', 'List Payments'); ?></li>
            <!--li><?php echo anchor('admin/payment/addPayment', 'Add Payment'); ?></li-->
        </ul> 

        <h2><img src ="<?php echo HTTP_PATH ?>img/money.png" width="15" height="15"> Visa Expiry Check</h2>
        <ul>
            <li><?php echo anchor('admin/payment/visaExpiryCheck', 'Visa Expiry Check Management'); ?></li>
        </ul> 

        <h2><img src ="<?php echo HTTP_PATH ?>img/content.png" width="15" height="15"> Content Manage</h2>
        <ul>
            <li><?php echo anchor('admin/content', 'Manage Content'); ?></li>
        </ul>

        <h2><img src ="<?php echo HTTP_PATH ?>img/configuration.png" width="15" height="15"> Configurations</h2>
        <ul>
            <li><?php echo anchor('admin/admin/changeEmail', 'Change Email'); ?></li>
            <li><?php echo anchor('admin/admin/changePassword', 'Change Password'); ?></li>      
        </ul>

        <h2><img src ="<?php echo HTTP_PATH ?>img/flush.png" width="15" height="15"> Flush Old Employees</h2>
        <ul>
            <li><?php echo anchor('admin/users', 'Flush'); ?></li>
        </ul>


        <h2><img src ="<?php echo HTTP_PATH ?>img/logs.png" width="15" height="15"> Contractors Login Log</h2>
        <ul>
            <li><?php echo anchor('admin/logs', 'List Log'); ?></li>
            <li><?php echo anchor('admin/logs/lastsixMonths', 'List Logs for last six months'); ?></li>
        </ul>


        <h2 class="last"><img src ="<?php echo HTTP_PATH ?>img/logout.png" width="15" height="15"> Logout</h2>
        <ul>
            <li><?php echo anchor('admin/admin/logout', 'Logout'); ?></li>
        </ul>
    </div>
</div>
</td>
</tr>
</table>
</td>
