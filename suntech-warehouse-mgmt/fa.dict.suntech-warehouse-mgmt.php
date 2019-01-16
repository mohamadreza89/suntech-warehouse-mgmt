<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2013 XXXXX
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

Dict::Add('FA IR', 'Persian', 'Persian', array(
	// Dictionary entries go here

	'Menu:Warehouse:Overview'=>'بررسی اجمالی',

	'UI:WarehouseMgmtMenuOverview:Title' => 'بررسی اجمالی مدیریت انبار',
	'UI-WarehouseManagementOverview-OpenPhysicalByStatus' => 'تعداد کالاهای موجود در انبار',


	'Class:ProductCategory' => 'گروه کالا',
	'Class:Product' => 'کالا',
	'Class:Inventory' => 'انبار',
	'Class:InventoryDetail' => 'جزئیات انبار',
	'Class:WarehouseDocument' => 'سند انبار',
	'Class:CiAssignment' => 'تخصیص CI',

	'Class:Product/Filter:from'=>'از',
	'Class:Product/Filter:to'=>'تا',
	'Class:Product/Filter:show_criticals'=>'نمایش مواردی که به نقطه سفارش رسیده اند',


	'Menu:WarehouseMgmt' => 'مدیریت انبار',
	'Menu:ProductCategory' => 'گروه کالا',
	'Menu:NewProductCategory' => 'گروه کالا جدید',
	'Menu:SearchProductCategory' => 'جستجوی گروه کالا',
	'Menu:Product' => 'کالا',
	'Menu:NewProduct' => 'کالای جدید',
	'Menu:SearchProduct' => 'جستجوی کالا',
	'Menu:Inventory' => 'انبار',
	'Menu:InventoryDetail' => 'جزییات انبار',
	'Menu:WarehouseDocument' => 'سند انبار',
	'Menu:CiAssignment' => 'تخصیص CI',
	'Menu:ProductReport+'=>'گزارشات انبار',

	'Menu:WarehouseMgmt+' => 'مدیریت انبار',
	'Menu:ProductCategory+' => 'گروه کالا',
	'Menu:NewProductCategory+' => 'گروه کالا جدید',
	'Menu:SearchProductCategory+' => 'جستجوی گروه کالا',
	'Menu:Product+' => 'کالا',
	'Menu:NewProduct+' => 'کالای جدید',
	'Menu:SearchProduct+' => 'جستجوی کالا',
	'Menu:Inventory+' => 'انبار',
	'Menu:InventoryDetail+' => 'جزییات انبار',
	'Menu:WarehouseDocument+' => 'سند انبار',
	'Menu:CiAssignment+' => 'تخصیص CI',
	'Menu:ProductReport+'=>'گزارشات انبار',


	'Class:ProductCategory/Attribute:title' => 'عنوان',
	'Class:ProductCategory/Attribute:parent_id' => 'گروه کالای بالادستی',
	'Class:ProductCategory/Attribute:parent_title' => 'عنوان گروه کالای بالادستی',
	'Class:ProductCategory/Attribute:is_active' => 'وضعیت',
	'Class:ProductCategory/Attribute:is_active/Value:0' => 'غیرفعال',
	'Class:ProductCategory/Attribute:is_active/Value:1' => 'فعال',


	'Class:Product/Attribute:title' => 'عنوان',
	'Class:Product/Attribute:technical_title' => 'عنوان فنی',
	'Class:Product/Attribute:product_category_id' => 'گروه کالا',
	'Class:Product/Attribute:product_category_title' => 'عنوان گروه کالا',
	'Class:Product/Attribute:is_active' => 'وضعیت',
	'Class:Product/Attribute:is_active/Value:0' => 'غیرفعال',
	'Class:Product/Attribute:is_active/Value:1' => 'فعال',
	'Class:Product/Attribute:order_point' => 'نقطه سفارش',
	'Class:Product/Attribute:physical_device_type' => 'نوع تجهیز سخت فزاری',


	'Class:Inventory/Attribute:title' => 'عنوان',
	'Class:Inventory/Attribute:width' => 'عرض (cm)',
	'Class:Inventory/Attribute:height' => 'ارتفاع (cm)',
	'Class:Inventory/Attribute:depth' => 'طول (cm)',


	'Class:InventoryDetail/Attribute:inventory_id' => 'انبار',
	'Class:InventoryDetail/Attribute:inventory_title' => 'عنوان انبار',
	'Class:InventoryDetail/Attribute:title' => 'عنوان',
	'Class:InventoryDetail/Attribute:row' => 'ردیف',
	'Class:InventoryDetail/Attribute:shelf' => 'قفسه',


	'Class:WarehouseDocument/Attribute:title' => 'عنوان',
	'Class:WarehouseDocument/Attribute:org_id' => 'واحد گیرنده',
	'Class:WarehouseDocument/Attribute:org_name' => 'عنوان واحد گیرنده',
	'Class:WarehouseDocument/Attribute:caller_id' => 'مسئول انبار',
	'Class:WarehouseDocument/Attribute:caller_name' => 'نام مسئول انبار',
	'Class:WarehouseDocument/Attribute:entry_date' => 'تاریخ ثبت',
	'Class:WarehouseDocument/Attribute:product_category_id' => 'گروه کالا',
	'Class:WarehouseDocument/Attribute:product_category_title' => 'عنوان گروه کالا',
	'Class:WarehouseDocument/Attribute:product_id' => 'کالا',
	'Class:WarehouseDocument/Attribute:product_title' => 'عنوان کالا',
	'Class:WarehouseDocument/Attribute:product_technical_title' => 'عنوان فنی کالا',
	'Class:WarehouseDocument/Attribute:physical_device_type' => 'نوع تجهیز سخت افزاری',
	'Class:WarehouseDocument/Attribute:count' => 'تعداد',
	'Class:WarehouseDocument/Attribute:inventory_id' => 'انبار',
	'Class:WarehouseDocument/Attribute:inventory_title' => 'عنوان انبار',
	'Class:WarehouseDocument/Attribute:inventory_detail_id' => 'جزئیات انبار',
	'Class:WarehouseDocument/Attribute:inventory_detail_title' => 'عنوان جزئیات انبار',
	'Class:WarehouseDocument/Attribute:invoice_serial' => 'شماره فاکتور',
	'Class:WarehouseDocument/Attribute:invoice_date' => 'تاریخ فاکتور',
	'Class:WarehouseDocument/Attribute:physical_device_list' => 'لیست تجهیزات سخت افزاری',
    'Class:WarehouseDocument/Attribute:end_of_warranty' => 'تاریخ اتمام ضمانت',
    'Class:WarehouseDocument/Attribute:physical_device_id' => 'شناسه CI سخت افزاری',
    'Class:WarehouseDocument/Attribute:physical_device_attributes' => 'مشخصات مربوط به تجهیز سخت افزاری',
    'Class:WarehouseDocument/Attribute:vendor' => 'فروشنده',
	'Class:WarehouseDocument/Attribute:warranty' => 'نام ضمانت',

    'WD:ci_name'=>'نام CI',
    'WD:ci_brand_id'=>'برند CI',
	'WD:ci_model_id'=>'مدل CI',
	'WD:ci_effective_life'=>'عمر مفید CI',


	'Class:Warehouse/Error:NoProductSelected'=>'هیچ کالایی انتخاب نشده است',

	'Class:CiAssignment/Attribute:name' => 'نام',
	'Class:CiAssignment/Attribute:product_category_id' => 'گروه کالا',
	'Class:CiAssignment/Attribute:product_id' => 'کالا',
	'Class:CiAssignment/Attribute:technical_title' => 'عنوان فنی کالا',
	'Class:CiAssignment/Attribute:physical_device_type' => 'نوع تجهیز سخت افزاری',
	'Class:CiAssignment/Attribute:ticket_id' => 'تیکت',
	'Class:CiAssignment/Attribute:ci_id' => 'CI تحویلی',
	'Class:CiAssignment/Attribute:ci_2_id' => 'CI مرجوعی',
    'Class:CiAssignment/Attribute:date' => 'تاریخ سند',
    'Class:CiAssignment/Attribute:letter' => 'تصویر رسید CI',
    'Class:CiAssignment/Attribute:comment' => 'توضیحات',
    'Class:CiAssignment/Attribute:documents' => 'اسناد',

	'Class:Ticket/Attribute:ci_assignment_list' => 'اسناد تحویل CI',
	'Class:PhysicalDevice/Attribute:ci_assignment_list' => 'اسناد تحویل CI',
    'Class:PhysicalDevice/Attribute:warehouse_document_id' => 'شناسه سند انبار',
    'Class:PhysicalDevice/Attribute:product_id' => 'شناسه کالا',
    'Class:PhysicalDevice' => 'CI سخت افزاری',

    'WarehouseDocument:baseInfo' => 'اطلاعات عمومی',
	'WarehouseDocument:warehouseInfo' => 'اطلاعات انبار',


	'CiAssignment:baseInfo'=>'اطلاعات عمومی',
	'CiAssignment:returned_ci'=>'CI های مرجوعی',
	'CiAssignment:delivered_ci'=>'CI های تحویلی',


	'Report:Product'=>'موجودی کالا',
	'Report:Product+'=>'تعداد کالاهای موجود در انبار',
	'Report:Back'=>'بازگشت',
	'Report:Submit'=>'نمایش گزارش',

	'Report:Product:Amount'=>'تعداد',

	'Report:net'=>'بالانس',
	'Report:sum'=>'موجودی',
	'Report:date'=>'تاریخ',

	'Report:fromDate'=> 'از تاریخ',
	'Report:toDate'=> 'تا تاریخ',
    

	'Menu:ProductDetailedReport+' => 'گزارش تراکنش کالا',
	'Menu:ProductDetailedReport' => 'گزارش تراکنش کالا',
    'Menu:Report' => 'گزارشات انبار',
	
	
	
));
?>
