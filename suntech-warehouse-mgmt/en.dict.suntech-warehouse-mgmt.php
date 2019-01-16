<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2013 XXXXX
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

Dict::Add('EN US', 'English', 'English', array(
	// Dictionary entries go here

	'Menu:Warehouse:Overview'=>'Warehouse Overview',

	'UI:WarehouseMgmtMenuOverview:Title' => 'Warehouse Overview',
	'UI-WarehouseManagementOverview-OpenPhysicalByStatus' => 'Products Quantity',

	'Class:ProductCategory' => 'Product Category',
	'Class:Product' => 'Product',
	'Class:Inventory' => 'Inventory',
	'Class:InventoryDetail' => 'Inventory Detail',
	'Class:WarehouseDocument' => 'Warehouse Document',
	'Class:CiAssignment' => 'CI Assignment',

	'Class:Product/Filter:from'=>'From',
	'Class:Product/Filter:to'=>'To',
	'Class:Product/Filter:show_criticals'=>'Show Only Critical Products (which their order point is bigger than their amount)',


	'Menu:WarehouseMgmt' => 'Warehouse Management',
	'Menu:ProductCategory' => 'Product Category',
	'Menu:NewProductCategory' => 'New Product Category',
	'Menu:SearchProductCategory' => 'Search Product Category',
	'Menu:Product' => 'Product',
	'Menu:NewProduct' => 'New Product',
	'Menu:SearchProduct' => 'Search Product',
	'Menu:Inventory' => 'Inventory',
	'Menu:InventoryDetail' => 'Inventory Detail',
	'Menu:WarehouseDocument' => 'Warehouse Document',
	'Menu:CiAssignment' => 'CI Assignment',
	'Menu:ProductReport+'=>'Product Report',

	'Menu:WarehouseMgmt+' => 'Warehouse Management',
	'Menu:ProductCategory+' => 'Product Category',
	'Menu:NewProductCategory+' => 'New Product Category',
	'Menu:SearchProductCategory+' => 'Search Product Category',
	'Menu:Product+' => 'Product',
	'Menu:NewProduct+' => 'New Product',
	'Menu:SearchProduct+' => 'Search Product',
	'Menu:Inventory+' => 'Inventory',
	'Menu:InventoryDetail+' => 'Inventory Detail',
	'Menu:WarehouseDocument+' => 'Warehouse Document',
	'Menu:CiAssignment+' => 'CI Assignment',
	'Menu:ProductReport+'=>'Product Report',


	'Class:ProductCategory/Attribute:title' => 'Title',
	'Class:ProductCategory/Attribute:parent_id' => 'Parent ID',
	'Class:ProductCategory/Attribute:parent_title' => 'Parent Title',
	'Class:ProductCategory/Attribute:is_active' => 'Is Active',
	'Class:ProductCategory/Attribute:is_active/Value:0' => 'Deactive',
	'Class:ProductCategory/Attribute:is_active/Value:1' => 'Active',


	'Class:Product/Attribute:title' => 'Title',
	'Class:Product/Attribute:technical_title' => 'Technical Title',
	'Class:Product/Attribute:product_category_id' => 'Category ID',
	'Class:Product/Attribute:product_category_title' => 'Category Title',
	'Class:Product/Attribute:is_active' => 'Is Active',
	'Class:Product/Attribute:is_active/Value:0' => 'Deactive',
	'Class:Product/Attribute:is_active/Value:1' => 'Active',
	'Class:Product/Attribute:order_point' => 'Order Point',
	'Class:Product/Attribute:physical_device_type' => 'Physical Device Type',


	'Class:Inventory/Attribute:title' => 'Title',
	'Class:Inventory/Attribute:width' => 'Width (cm)',
	'Class:Inventory/Attribute:height' => 'Height (cm)',
	'Class:Inventory/Attribute:depth' => 'Length (cm)',


	'Class:InventoryDetail/Attribute:inventory_id' => 'Inventory ID',
	'Class:InventoryDetail/Attribute:inventory_title' => 'Inventory Title',
	'Class:InventoryDetail/Attribute:title' => 'Title',
	'Class:InventoryDetail/Attribute:row' => 'Row',
	'Class:InventoryDetail/Attribute:shelf' => 'Shelf',

	'Class:WarehouseDocument/Attribute:vendor' => 'Vendor',
	'Class:WarehouseDocument/Attribute:title' => 'Title',
	'Class:WarehouseDocument/Attribute:warranty' => 'Warranty',
	'Class:WarehouseDocument/Attribute:end_of_warranty' => 'End of Warranty',
	'Class:WarehouseDocument/Attribute:org_id' => 'Organization',
	'Class:WarehouseDocument/Attribute:org_name' => 'Organization Name',
	'Class:WarehouseDocument/Attribute:caller_id' => 'Caller',
	'Class:WarehouseDocument/Attribute:caller_name' => 'Caller Name',
	'Class:WarehouseDocument/Attribute:entry_date' => 'Entry Date',
	'Class:WarehouseDocument/Attribute:product_category_id' => 'Product Category',
	'Class:WarehouseDocument/Attribute:product_category_title' => 'Product Category Title',
	'Class:WarehouseDocument/Attribute:product_id' => 'Product',
	'Class:WarehouseDocument/Attribute:product_title' => 'Product Title',
	'Class:WarehouseDocument/Attribute:product_technical_title' => 'Product Technical Title',
	'Class:WarehouseDocument/Attribute:physical_device_type' => 'Physical Device Type',
	'Class:WarehouseDocument/Attribute:count' => 'Count',
	'Class:WarehouseDocument/Attribute:inventory_id' => 'Inventory ID',
	'Class:WarehouseDocument/Attribute:inventory_title' => 'Inventory Title',
	'Class:WarehouseDocument/Attribute:inventory_detail_id' => 'Inventory Detail',
	'Class:WarehouseDocument/Attribute:inventory_detail_title' => 'Inventory Detail Title',
	'Class:WarehouseDocument/Attribute:invoice_serial' => 'Invoice Serial',
	'Class:WarehouseDocument/Attribute:invoice_date' => 'Invoice Date',
	'Class:WarehouseDocument/Attribute:physical_device_list' => 'Physical Device List',
	'Class:WarehouseDocument/Attribute:physical_device_attributes'=> 'Physical Device Attributes',
	'WD:ci_name'=>'CI Name',
	'WD:ci_brand_id'=>'CI Brand',
	'WD:ci_model_id'=>'CI Model',
	'WD:ci_effective_life'=>'CI Effective Life',


	'Class:Warehouse/Error:NoProductSelected'=>'No product has been selected',

	'Class:CiAssignment/Attribute:name' => 'Name',
	'Class:CiAssignment/Attribute:product_category_id' => 'Product Category',
	'Class:CiAssignment/Attribute:product_id' => 'Product',
	'Class:CiAssignment/Attribute:technical_title' => 'Technical Title',
	'Class:CiAssignment/Attribute:physical_device_type' => 'Physical Device Type',
	'Class:CiAssignment/Attribute:ticket_id' => 'Ticket',
	'Class:CiAssignment/Attribute:ci_id' => 'Assigned CI',
	'Class:CiAssignment/Attribute:ci_2_id' => 'Returned CI',
	'Class:CiAssignment/Attribute:documents' => 'Documents',

	'Class:Ticket/Attribute:ci_assignment_list' => 'CI Assignment List',
	'Class:PhysicalDevice/Attribute:ci_assignment_list' => 'CI Assignment List',

	'WarehouseDocument:baseInfo' => 'General Information',
	'WarehouseDocument:warehouseInfo' => 'Warehouse Information',

	'CiAssignment:baseInfo'=>'General Information',
	'CiAssignment:returned_ci'=>'Returned CIs',
	'CiAssignment:delivered_ci'=>'Delivered CIs',


	'Report:Product'=>'Product Quantity',
	'Report:Product+'=>'Number of products in the stock',
	'Report:Back'=>'Back',
	'Report:Submit'=>'Show Report',

	'Report:Product:Amount'=>'Amount',

	'Report:balance'=>'Balance',
	'Report:sum'=>'Sum',
	'Report:date'=>'Date',

	'Report:fromDate'=> 'From Date',
	'Report:toDate'=> 'To Date',

	'Menu:ProductDetailedReport' => 'Product Detail Report',
	'Menu:ProductDetailedReport+' => 'Product Detail Report',
	'Menu:Report' => 'Reports',
	
));
?>
