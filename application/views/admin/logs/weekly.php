<?php
$past_weeks = 12;
$relative_time = time();
$weeks = array();

for ($week_count = 0; $week_count < $past_weeks; $week_count++) {
    $monday = strtotime("last Monday", $relative_time);
    $sunday = strtotime("Sunday", $monday);
    $weeks[] = array(
        date("Y-m-d", $monday),
        date("Y-m-d", $sunday),
    );
    $relative_time = $monday;
}

//echo "<pre>";
//print_r($weeks);
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    google.setOnLoadCallback(drawSecondChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Months', 'No of unique contractor logins'],
<?php
$i = 0;
foreach ($weeks as $key => $value) {
    $i += 1;
    $title = date("M d, Y", strtotime($value[0])) . " to " . date("M d, Y", strtotime($value[1]));
    $counter = $this->user_model->getLogsBetweenWeek($value[0], $value[1]);
    ?>
                    ['<?php echo $title; ?>',  <?php echo $counter; ?>]<?php if (count($weeks) <> $i) { ?>,<?php } ?>
    <?php
}
?>
        ]);

        var options = {
            title: 'Unique contractor logins per week',
            hAxis: {title: 'Months', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    
    function drawSecondChart() {
        var data = google.visualization.arrayToDataTable([
            ['Months', 'No of unique contractor logins', 'Total number of contractors'],
<?php
$i = 0;
foreach ($weeks as $key => $value) {
    $i += 1;
    $title = date("M d, Y", strtotime($value[0])) . " to " . date("M d, Y", strtotime($value[1]));
    $counter = $this->user_model->getLogsBetweenWeek($value[0], $value[1]);
    $counter_total = $this->user_model->getContractorsBetweenWEmployed($value[1]);
    ?>
                    ['<?php echo $title; ?>',  <?php echo $counter; ?>,  <?php echo $counter_total; ?>]<?php if (count($weeks) <> $i) { ?>,<?php } ?>
    <?php
}
?>
        ]);

        var options = {
            title: 'Unique contractor and total contractors logins per week',
            hAxis: {title: 'Months', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
    }
    
    
    $(document).ready(function(){
        $(".option").click(function(){
            if(this.value == 'monthly') {
                window.location = "<?php echo HTTP_PATH ?>admin/logs";
            }
        })
    })
</script>


<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="32">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Contractors Login Log Weekly</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="9" height="70" valign="middle">
                <div class="Block table">
                    <div class="BlockContent">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                            <tr>
                                <th>Please select option</th>
                            </tr>
                            <tr>
                                <td  height="80">
                                    <?php
                                    echo form_radio('select', 'monthly', FALSE, 'class="option" id="monthly"') . "&nbsp;<label for='monthly'>Monthly</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    echo form_radio('select', 'weekly', TRUE, 'class="option" id="weekly"') . "<label for='weekly'>Weekly</label>";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="load_cond">

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="chart_div" style="width: 1200px; height: 500px;"></div>
                <div id="chart_div1" style="width: 1200px; height: 500px;"></div>
            </td>
        </tr>
    </table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr> 

