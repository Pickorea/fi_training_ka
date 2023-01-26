<?php
use \koolreport\widgets\koolphp\Table;
?>
<html>
    <head>
    <title>My Report</title>
    </head>
    <body>
        <h1>Training Attendance Records </h1>
        <?php
        Table::create(
            [
                "paging"=>array(
                    "pageSize"=>15,
                    "pageIndex"=>0,
                ),
            "dataSource"=>$this->dataStore("")
        ]);
        ?>
    </body>
</html>
