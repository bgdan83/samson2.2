<?php 
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

class AddBasket extends CBitrixComponent
{
	
	function add()
	{
		
	    \Bitrix\Main\Loader::includeModule('sale');

		// текущего пользователя 
		$basketUserId = Bitrix\Sale\Fuser::getId();
		$basket = Bitrix\Sale\Basket::loadItemsForFUser($basketUserId,
			Bitrix\Main\Context::getCurrent()->getSite());
		$sumPrice = 0;
		$productId = 111;
		$quantity = 1;
		$day = intval(date(d));	
		$iblockId = 2;

		if (CModule::IncludeModule("iblock")) {
			$db_props = CIBlockElement::GetProperty($iblockId, $productId, Array("sort"=>"asc"), Array("CODE"=>"ARTNUMBER"));
			if($ar_props = $db_props->Fetch())
			  $code = $ar_props['VALUE'];
		} 
		$code = intval($code);
		$product = \Bitrix\Iblock\ElementTable::getById($productId)->fetch();
		$product['PRICE'] = \CPrice::GetList(false, ['PRODUCT_ID' => $productId, 'CODE' => 'BASE'])->fetch();
		if(($day % 2) == 0 && ($code % 2)== 0)
		{
			$product['PRICE']['PRICE'] -=  $product['PRICE']['PRICE'] * 0.1;
		}
		$sumPrice = $product['PRICE']['PRICE'];
		//echo $sumPrice;
		// если в корзине уже есть такой товар, увеличим его количество
		if ($item = $basket->getExistsItem('catalog', $productId)) {
			$item->setField('QUANTITY', $item->getQuantity() + $quantity);
		} else {
			// иначе добавим. Сначала создадим объект товара корзины, затем заполним его свойства данными о товаре.
			$item = $basket->createItem('catalog', $productId);
			$item->setFields(array(
				'QUANTITY' => $quantity,
				"PRICE" => $product['PRICE']['PRICE'],
				"NAME" => $product['NAME'],
				'CURRENCY' => $product['PRICE']['CURRENCY'],
				'LID' => Bitrix\Main\Context::getCurrent()->getSite(),
			));
		}
		$basket->save();	
	
	}	
	public function executeComponent()
		{ 
			$this->add();

			$this->IncludeComponentTemplate();			
		}
}