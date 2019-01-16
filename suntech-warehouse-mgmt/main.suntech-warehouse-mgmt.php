<?php

class WarehouseUIExt implements iPageUIExtension
{
	
    
    protected $MODULE_PATH = '../env-production/suntech-warehouse-mgmt';
    
    
    
    /**
	 * Add content to the North pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetNorthPaneHtml(iTopWebPage $oPage)
    {
        
        
        //$oPage->add_linked_stylesheet($this->MODULE_PATH.'/css/kamadatepicker.css');

        $text = "";
        
        return $text;
    }
    
	/**
	 * Add content to the South pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetSouthPaneHtml(iTopWebPage $oPage)
    {
    	$appRoot = utils::GetAbsoluteUrlAppRoot();
    	$ReportTitle = Dict::S('Menu:Report');

    	$oPage->add_ready_script(
<<<EOF
        url = "$appRoot" + 'pages/UI.php?custom_page=warehouse-reporting';
        function addReport(){
			//
			if ($('#AccordionMenu_Report').length == 0){
				$('[aria-labelledby="AccordionMenu_WarehouseMgmt"] ul').eq(0).append('<li id="AccordionMenu_Report"><a href="'+ url +'">$ReportTitle</a></li>');   
				
			}
		}

		$(document).ready(function(){
			// adding report menu
			addReport();
			setTimeout(addReport, 50);
			setTimeout(addReport, 100);
			setTimeout(addReport, 200);
			setTimeout(addReport, 400);
			setTimeout(addReport, 800);
			setTimeout(addReport, 1600);
			setTimeout(addReport, 2000);
		});
EOF
    	);

    	$sClass = utils::ReadParam('class', '');
    	$operation = utils::ReadParam('operation', '');
    	$title = Dict::S('Class:WarehouseDocument/Attribute:physical_device_attributes');
    	if ($sClass=='WarehouseDocument'&& $operation=='new')
    	{
    		$oPage->add_ready_script(
<<<EOF
    $(document).ready(function(){
        $('.details').eq(3).append('<fieldset><legend>$title :</legend><div id="custom_form"></div></fieldset>');
		$('#field_2_product_id').change(function(){


			$.ajax({
				url:'../env-production/suntech-warehouse-mgmt/ajax.render.php',
				type:'get',
				data:'operation=ci_form_update&p_id=' + $('#2_product_id').val(),
				success: function(Res){
					$('#custom_form').html(Res);
				}
			});		
		});
		});
EOF
    	);
    	}

    	ApplicationMenu::LoadAdditionalMenus();
		

    	if (($sClass=='WarehouseDocument')OR(ApplicationMenu::GetActiveNodeId()=='WarehouseDocument'))
    	{
    		$modify = Dict::S('UI:Menu:Modify');
    		$oPage->add_ready_script(
<<<EOF
    $(document).ready(function(){
        
		$('#physical_device_list_btnAdd').css('display','none');
		$('#physical_device_list_btnRemove').css('display','none');
		$("div.actions_button:contains($modify)").remove();
		$("a:contains($modify)").remove();
	
	});
EOF
    	);
    	}


        $text = "";
        return $text;
        
    }
	
    /**
	 * Add content to the "admin banner"
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetBannerHtml(iTopWebPage $oPage)
    {
        $text = "";
        
        
        
        
        return $text;
    }
    
    
}