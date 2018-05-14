<?php 
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Highloadblock as HL;
use \Bitrix\Main\Entity;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

Loc::loadMessages(__FILE__);

class LowPriceList extends CBitrixComponent
{
	
	function listResult($arParams)
	{
		$requiredModules = array('highloadblock');
		foreach ($requiredModules as $requiredModule)
		{
			if (!CModule::IncludeModule($requiredModule))
			{
				ShowError(Loc::getMessage("F_NO_MODULE"));
				return 0;
			}
		}

		// hlblock info
		$hlblock_id = $arParams['BLOCK_ID'];
		if (empty($hlblock_id))
		{
			ShowError(Loc::getMessage('HLBLOCK_LIST_NO_ID'));
			return 0;
		}
		$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
		if (empty($hlblock))
		{
			ShowError(Loc::getMessage('HLBLOCK_LIST_404'));
			return 0;
		}

		$entity = HL\HighloadBlockTable::compileEntity($hlblock);

		// uf info
		$fields = $GLOBALS['USER_FIELD_MANAGER']->GetUserFields('HLBLOCK_'.$hlblock['ID'], 0, LANGUAGE_ID);

		// sort
		$sortId = 'UF_DATE_BID';
		$sortType = 'DESC';
		
		// for compatibility
		if (isset($_GET['sort_type']) && in_array($_GET['sort_type'], array('ASC', 'DESC'), true))
		{
			$sortType = $_GET['sort_type'];
		} 

		// pagen
		if (isset($arParams['ROWS_PER_PAGE']) && $arParams['ROWS_PER_PAGE']>0)
		{
			$pagenId = isset($arParams['PAGEN_ID']) && trim($arParams['PAGEN_ID']) != '' ? trim($arParams['PAGEN_ID']) : 'page';
			$perPage = intval($arParams['ROWS_PER_PAGE']);
			$nav = new \Bitrix\Main\UI\PageNavigation($pagenId);
			$nav->allowAllRecords(true)
				->setPageSize($perPage)
				->initFromUri();
		}
		else
		{
			$arParams['ROWS_PER_PAGE'] = 0;
		}

		// start query
		$mainQuery = new Entity\Query($entity);
        $mainQuery->setSelect(array('*'));
		$mainQuery->setOrder(array($sortId => $sortType));
		
        
		
		// filter
		if (isset($arParams['FOR_ADMIN']) && $arParams['FOR_ADMIN'] == 'Y' ){
			if(isset($_GET['cond']) )
			{
				$cond = intval($_GET['cond']);
				$filter[] = array('UF_CONDITION' => $cond);
			}
			
			if(isset($_GET['vendor_code']) && !empty($_GET['vendor_code']))
			{
				$vendor_code = trim(htmlspecialcharsEx($_GET['vendor_code']));
				$filter[] = array('UF_VENDOR_CODE' => $vendor_code);
			}
			
			if(isset($_GET['date']) && !empty($_GET['date']))
			{
				$date = htmlspecialcharsEx($_GET['date'] );
				$filter[] = array('UF_DATE_BID' => $date);
			}
			
			if (is_array($filter)) {
				$mainQuery->setFilter($filter);
			}
			
		} 
		elseif (isset($_GET['ID']))
		{
			$element_id = intval($_GET['ID']);
			$mainQuery->setFilter(array('ID' => $element_id));
		}
		else {
			global $USER;
			$mainQuery->setFilter(array('UF_USER_ID' => $USER->GetID()));
		}
		
		// pagen
		if ($perPage > 0)
		{
			$mainQueryCnt = $mainQuery;
			$result = $mainQueryCnt->exec();
			$result = new CDBResult($result);
			$nav->setRecordCount($result->selectedRowsCount());
			$arResult['nav_object'] = $nav;
			unset($mainQueryCnt, $result);

			$mainQuery->setLimit($nav->getLimit());
			$mainQuery->setOffset($nav->getOffset());
		}

		// execute query
		//	->setGroup($group)
		//	->setOptions($options);
		$result = $mainQuery->exec();
		$result = new CDBResult($result);

		// build results
		$rows = array();
		$user_id = array();
		$goods_id = array();
		$arGoods = array();
		

		while ($row = $result->fetch())
		{
			$goodsId[] = $row['UF_GOODS_ID'];
			$rows[] = $row;
			$userId[] = $row['UF_USER_ID'];
		}
		$goodsId = array_unique($goodsId);
		$userId = array_unique($userId);
		$catalogDirPath = 'http://' . $_SERVER['HTTP_HOST'] . '/products/';
		$usersDirPath ='http://' . $_SERVER['HTTP_HOST'] . '/admin/users/';
		
		//data goods
		if(CModule::IncludeModule("iblock"))
		{
		   $dbItems = \Bitrix\Iblock\ElementTable::getList(array(
			'select' => array('ID', 'NAME', 'PREVIEW_PICTURE', 'IBLOCK_SECTION_ID'),
			'filter' => array('IBLOCK_ID' => 2, 'ID' => $goodsId)
			));
			 while ($arItem = $dbItems->fetch()){  
				$arGoods[$arItem["ID"]] = array(
					'GOODS_LINK' => $catalogDirPath . $arItem["IBLOCK_SECTION_ID"]
     					                            . '/' . $arItem["ID"] . '/',
					'GOODS_NAME' => $arItem['NAME'],
					'PREVIEW_PICTURE' => CFile::GetFileArray($arItem['PREVIEW_PICTURE'])
				);	
			} 	
		}
        
		//data users
		if (is_array($userId)){
			$rsUsers = \Bitrix\Main\UserTable::getList(array(
				'select'  => array('ID','LOGIN'),
				'filter'  => array('LID' => SITE_ID, 'ID' => $userId)	
			));

			while($arItem = $rsUsers->fetch())
			{
				$arUsers[$arItem['ID']] = array('USER_LINK' => $usersDirPath . $arItem['LOGIN'] . '/');		
			}
	    }
		foreach($rows as &$row)
		{   
		    if ($row['UF_GOODS_ID'] > 0) {
		        $row = array_merge($row, $arGoods[$row['UF_GOODS_ID']]);
			}
			if ($row['UF_USER_ID'] > 0) {
		      $row = array_merge($row, $arUsers[$row['UF_USER_ID']]);
			} 
		}
		unset($row);
		$arResult['fields'] = $fields;
		$arResult['rows'] = $rows;
		
		// export XML
        if (isset($arParams['FOR_ADMIN']) && $arParams['FOR_ADMIN'] == 'Y' )
		{
			if (isset($_GET['button'])){
				
				$xml = new DOMDocument("1.0", "windows-1251");
				$bids = $xml->appendChild($xml->createElement("Заявки"));
				foreach ($arResult['rows'] as $row) 
				{
					$bid = $xml->createElement("Заявка");
					$bids->appendChild($bid);
					foreach ($row as $key => $val) 
					{
						if (is_array($val)){
							$cid = $xml->createElement($key);
							$bid->appendChild($cid);
							foreach ($val as $i => $k) 
							{
								if($i[0] == '~' ) continue;
								$c = $xml->createElement($i, $k);
								$cid->appendChild($c);
							}	
						} else {
							$b = $xml->createElement($key, $val);
							$bid->appendChild($b);	
						}
					}
				}
				$xml->formatOutput = true;
				$xml->save("1.xml");
				
				if (file_exists("1.xml")) {
					if (ob_get_level()) {
					  ob_end_clean();
				}
				// заставляем браузер показать окно сохранения файла
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=' . basename("1.xml"));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize("1.xml"));
				// читаем файл и отправляем его пользователю
				readfile("1.xml");
				exit;
				}	
				
			}
		}

		// for compatibility
		$arResult['NAV_STRING'] = '';
		$arResult['NAV_PARAMS'] = '';
		$arResult['NAV_NUM'] = 0;
		return $arResult;
    }
	
	
		
	public function executeComponent()
		{ 
			$this->arResult = $this->listResult($this->arParams);

			$this->IncludeComponentTemplate();			
		}
}