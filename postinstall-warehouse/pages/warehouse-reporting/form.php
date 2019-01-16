<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/light-grey.css">
        <link rel="stylesheet" type="text/css" href="css/kamadatepicker.css">
        <link rel="stylesheet" type="text/css" href="css/mystyle.css">
        <title><?php echo Dict::S('Menu:ProductReport+'); ?></title>
    </head>
    <body>
       <div id="wrapper" style=" overflow-y: scroll;" class="col-md-12" >
          <div class="ui-layout-content">
             <h1 style="text-align: center;" ><?php echo Dict::S('Menu:ProductReport+'); ?></h1>
             <div class="wizContainer col-md-12">
                <form class="col-md-12 " method="post" action="index.php">
                  <input type="hidden" name="language" value="<?php echo Dict::GetUserLanguage(); ?>">
                  <input type="hidden" name="type" value="first">
                   <div class="row">
                      <div class="form-group  col-md-6">
                         <label for="s-categories"><?php echo Dict::S('Class:ProductCategory'); ?></label>
                         <select id="s-categories" class="js-example-basic-multiple form-control" name="category_ids[]" multiple="multiple">
                            <?php foreach ($product_categories as $product_category) { ?>
                            <option value="<?php echo $product_category['id']; ?>"><?php echo $product_category['title']; ?></option>
                            <?php } ?>
                         </select>
                      </div>
                      <div class="form-group  col-md-6">
                         <label for="s-products"><?php echo Dict::S('Class:Product'); ?></label>
                         <select id="s-products" class="js-example-basic-multiple form-control" name="ids[]" multiple="multiple">
                            <?php foreach ($products as $product) { ?>
                            <option value="<?php echo $product['id']; ?>"><?php echo $product['title']; ?></option>
                            <?php } ?>
                         </select>
                      </div>
                   </div>
                   <div class="row">
                      <div class="form-group  col-md-6">
                         <label for="s-inventories"><?php echo Dict::S('Class:Inventory'); ?></label>
                         <select id="s-inventories" class="js-example-basic-multiple form-control" name="inventory_ids[]" multiple="multiple">
                            <?php foreach ($inventories as $inventory) { ?>
                            <option value="<?php echo $inventory['id']; ?>"><?php echo $inventory['title']; ?></option>
                            <?php } ?>
                         </select>
                      </div>
                      <div class="form-group col-md-3 ">
                         <label for="s-from"><?php echo Dict::S('Class:Product/Filter:from'); ?></label>
                         <input id="s-from" class="form-control" type="number" name="from" />
                      </div>
                      <div class="form-group col-md-3">
                         <label for="s-to"><?php echo Dict::S('Class:Product/Filter:to'); ?></label>
                         <input id="s-to" class="form-control" type="number" name="to" />
                      </div>
                   </div>
                   <div class="" style="margin-bottom: 20px ">
                      <div class="form-check col-md-12">
                         <input type="checkbox" class="form-check-input" id="s-exampleCheck1" name="show_criticals">
                         <label class="form-check-label" for="s-exampleCheck1"><?php echo Dict::S('Class:Product/Filter:show_criticals'); ?></label>
                      </div>
                   </div>
                   <div class="row">
                      <div class="form-group col-md-6">
                         <input type="submit" class="" name="" value="<?php echo Dict::S('Report:Submit'); ?>" />
                      </div>
                   </div>
                </form>
             </div>
       </div>
       <div class="ui-layout-content" style="top: 10px; position: relative;">
             <h1 style="text-align: center;"><?php echo Dict::S('Menu:ProductDetailedReport+'); ?></h1>
             <div class="wizContainer col-md-12">
                <form class="col-md-12 " method="post" action="index.php">
                  <input type="hidden" name="language" value="<?php echo Dict::GetUserLanguage(); ?>">
                  <input type="hidden" name="type" value="second">
                   <div class="row">
                      <div class="form-group  col-md-6">
                         <label for="products"><?php echo Dict::S('Class:Product'); ?></label>
                         <select id="products" class="js-example-basic-multiple form-control" name="id">
                            <?php foreach ($products as $product) { ?>
                            <option value="<?php echo $product['id']; ?>"><?php echo $product['title']; ?></option>
                            <?php } ?>
                         </select>
                      </div>
                      <div class="form-group  col-md-3">
                         <label for="q-from"><?php echo Dict::S('Report:fromDate'); ?></label>
                         <input id="q-from" class="form-control hasDatepicker" type="text" name="from" />
                      </div>
                      <div class="form-group  col-md-3">
                         <label for="q-to"><?php echo Dict::S('Report:toDate'); ?></label>
                         <input id="q-to" class="form-control hasDatepicker" type="text" name="to" />
                      </div>
                   </div>
                   <div class="row">
                      <div class="form-group col-md-6">
                         <input type="submit" class="" name="" value="<?php echo Dict::S('Report:Submit'); ?>" />
                      </div>
                   </div>
                </form>
             </div>
           </div>
       <!-- Optional JavaScript -->
       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
       <script src="js/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
       <script src="js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
       <script src="js/select2.min.js"></script>
       <script src="js/kamadatepicker.js"></script>
       <script src="js/script.js"></script>
       <script>
          $(document).ready(function() {
             $('.js-example-basic-multiple').select2();
          });
       </script>
    </body>


</html>