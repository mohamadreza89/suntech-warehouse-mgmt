<?php
// Copyright (C) 2010-2016 Combodo SARL
//
//   This file is part of iTop.
//
//   iTop is free software; you can redistribute it and/or modify	
//   it under the terms of the GNU Affero General Public License as published by
//   the Free Software Foundation, either version 3 of the License, or
//   (at your option) any later version.
//
//   iTop is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU Affero General Public License for more details.
//
//   You should have received a copy of the GNU Affero General Public License
//   along with iTop. If not, see <http://www.gnu.org/licenses/>


/**
 * Handles various ajax requests
 *
 * @copyright   Copyright (C) 2010-2016 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

require_once('../../approot.inc.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/application/webpage.class.inc.php');
require_once(APPROOT.'/application/ajaxwebpage.class.inc.php');
require_once(APPROOT.'/application/wizardhelper.class.inc.php');
require_once(APPROOT.'/application/ui.linkswidget.class.inc.php');
require_once(APPROOT.'/application/ui.extkeywidget.class.inc.php');
require_once(APPROOT.'/application/datatable.class.inc.php');


function getDeps ($sClass , $aAttlist , $sAttcode)
{
	$deps = $aAttlist[$sAttcode]->Get('depends_on');
	$final = array();
	foreach ($deps as $dep) {
		$final[] = $dep;
		$t = getDeps($sClass , $aAttlist, $dep);
		foreach ($t as $key) {
			$final[] = $key;
		}
	}
	return $final;
}

try
{
	require_once(APPROOT.'/application/startup.inc.php');

	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	LoginWebPage::DoLoginEx(null /* any portal */, false);
	
	$oPage = new ajax_page("");
	$oPage->no_cache();

	
	$operation = utils::ReadParam('operation', '');

	switch($operation)
	{
		case 'ci_form_update':
			$oPage->SetContentType('text/html');
			$pId = utils::ReadParam('p_id', null);
			if ($pId ==null) {
				throw new Exception(Dict::S('Class:Warehouse/Error:NoProductSelected'), 1);
			}

			
			

			$product = Metamodel::GetObject('Product' , $pId);
			$ci = $product->Get('physical_device_type');

			$ciAtts = Metamodel::ListAttributeDefs($ci);


			//$obj = Metamodel::NewObject($ci);

			
			$tt = MetaModel::GetZListItems($ci, 'details');

			$fff = fopen("test_tt.php","w");
			fwrite($fff,json_encode($tt));
			fclose($fff);

$ggg=[];
			foreach ($tt as $t => $v) {

				if (is_array($v))
				{
					foreach ($v as $key => $value) {
						foreach ($value as $subV) {
							if (isset($ciAtts[$subV]))
							{
								if (!$ciAtts[$subV]->IsNullAllowed())
								{
									$finalAtts[$subV] = MetaModel::GetPrerequisiteAttributes($ci, $subV);
									$ggg[]=$subV;
								}
							}
							
						}
						
					}
					continue;
				}
				if (!is_array($v)){
					if (isset($ciAtts[$v]))
					{

						

						if (!$ciAtts[$v]->IsNullAllowed())
						{
							$finalAtts[$v] = MetaModel::GetPrerequisiteAttributes($ci, $v);
							
							$deps = getDeps($ci , $ciAtts , $v);
							
							foreach ($deps as $dep) {
								$finalAtts[$dep] = MetaModel::GetPrerequisiteAttributes($ci, $dep);
								$g = $ciAtts[$dep]->GetEditClass();

							}	
						}	
					}
				}	
			}
			
			$aList = cmdbAbstractObject::OrderDependentFields($finalAtts);
			$html ='';
			$fff = fopen("test_alist.php","w");
			fwrite($fff,json_encode($aList));
			fclose($fff);

			foreach ($aList as $item) 
			{
				if($item=='org_id'){
					continue;
				}

				if($item=='warehouse_document_id'){
					continue;
				}
				if($item=='product_id'){
					continue;
				}
				
				$type = $ciAtts[$item]->GetEditClass();
				$att_name = 'ci_'.($item);

				$html .='<div class="field_container field_small">';
				
				
				switch ($type) {
					case 'String':
						$html .= '<div class="field_label label"><span>'. Dict::S('WD:ci_'.$item).'</span></div>';
						$html .= '<div class="field_data"><input style="width:70%" type="text" name="'.$att_name.'" /></div>';
						
						break;

					case 'ExtKey':
						$html .= '<div class="field_label label"><span>'.Dict::S('WD:ci_'.$item).'</span></div>';
						$html .= '<select style="width:70%" name="'.$att_name.'">';
						$TargetClass = $ciAtts[$item]->GetTargetClass();

						$sOQL = "SELECT ". $TargetClass;
						$oFilter = DBObjectSearch::FromOQL($sOQL);
						$oSet = new CMDBObjectSet($oFilter, array());

						$hh = Metamodel::GetNameSpec($TargetClass);
						//$oPage->add(($hh[1][0]));

						while ($tt = $oSet->FetchAssoc())
						{
							//if ($TargetClass=='Location'){


							$html .='<option value='.$tt[$TargetClass]->Get('id').'>' ;
							$html .=$tt[$TargetClass]->Get('name');
							$html .= '</option>';
							//}
						}
						$html .= '</select>';
						
						
						
						break;
					
					default:
						//
						break;
				}
				$html .='</div>';
			}

			
			$oPage->add($html);

			

			


			

			

			//$tt = new CMDBObjectSet($oSet);
			//$oPage->add(var_dump($oSet->FetchAssoc()));


			
			break;

		default:
		$oPage->p("Invalid query.");
	}

	$oPage->output();
}
catch (Exception $e)
{
	// note: transform to cope with XSS attacks
	echo htmlentities($e->GetMessage(), ENT_QUOTES, 'utf-8');
	IssueLog::Error($e->getMessage()."\nDebug trace:\n".$e->getTraceAsString());
}
