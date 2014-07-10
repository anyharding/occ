<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
<?php
for ($i = 11; $i >= 0; $i--) {
    $title = date("F, Y", strtotime(date('Y-m-01') . " -$i months"));
    $month = date("m", strtotime(date('Y-m-01') . " -$i months"));
    $year = date("Y", strtotime(date('Y-m-01') . " -$i months"));
    if ($this->user_model->getLogsBetweenMonth($month, $year) and $this->user_model->getContractorsBetweenMonth($month, $year)) {
        ?>
                    google.setOnLoadCallback(drawChart<?php echo $i ?>);
                    function drawChart<?php echo $i ?>() {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Total no of unique login',     <?php echo $this->user_model->getLogsBetweenMonth($month, $year) ?>],
                            ['Total no of contractors',      <?php echo $this->user_model->getContractorsBetweenMonth($month, $year) ?>]
                        ]);
                        var options = {
                            title: '<?php echo $title; ?>',
                            is3D: true
                        };
                        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d<?php echo $i ?>'));
                        chart.draw(data, options);
                    }
        <?php
    }
}
?>
</script>

<td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="32">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Contractors Login Log</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                for ($i = 11; $i >= 0; $i--) {
                    $title = date("M, Y", strtotime(date('Y-m-01') . " -$i months"));
                    $month = date("m", strtotime(date('Y-m-01') . " -$i months"));
                    $year = date("Y", strtotime(date('Y-m-01') . " -$i months"));
//                    echo $month . " " . $this->user_model->getLogsBetweenMonth($month, $year) . "<br>";
//                    $counter = $this->user_model->getLogsBetweenMonth($month);
                    if ($this->user_model->getLogsBetweenMonth($month, $year) and $this->user_model->getContractorsBetweenMonth($month, $year)) {
                        ?>
                        <div id="piechart_3d<?php echo $i ?>" style="width: 900px; height: 500px;"></div>
                        <?php
                    }
                }
                ?>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr> 