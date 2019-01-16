<?php 
// SalesByCustomer.view.php - Handle the report view
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\BarChart;
?>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/light-grey.css">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<div id="wrapper">
    <div class="ui-layout-content">
<div class="text-center">
    <h1><?php echo Dict::S('Menu:ProductDetailedReport'); ?></h1>
    <h2><?php echo Dict::S('Menu:ProductDetailedReport+'); ?></h2>
</div>
<hr/>


<div style="height: 82vh; overflow: scroll;">
<?php
Table::create(array(
    "dataStore"=>$this->dataStore('test'),
    "columns"=>array(

        "ref"=>array(
            "label"=>Dict::S('Report:Ref'),
        ),
        "category"=>array(
            "label"=>Dict::S('Class:ProductCategory'),
        ),
        "title"=>array(
            "label"=>Dict::S('Class:Product'),
        ),
        "created_at"=>array(
            "label"=>Dict::S('Report:date'),
        ),

        "balance"=>array(
            "label"=>Dict::S('Report:balance'),
        ),
        "cSum"=>array(
            "label"=>Dict::S('Report:sum'),
        ),
        "contact"=>array(
            "label"=>Dict::S('Class:Contact'),
        ),

    ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered col-md-10 offset-1"
    )
));
?>
</div>

<div class="col-md-3">
    <form action="index.php" method="get"><input type="hidden" name="language" value="<?php echo Dict::GetUserLanguage(); ?>"><input type="hidden" name="p" value="1eda23758be9e36e5e0d2a6a87de584aaca0193f" /><button class="btn btn-outline-primary" style="padding: 0px 10px"><?php echo Dict::S('Report:Back'); ?></button></form>
</div>
</div>
</div>