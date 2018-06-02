<?
use \Bitrix\Main\UserTable;
use \Bitrix\Main\UserGroupTable;
AddEventHandler("main", "OnBeforeUserAdd", Array("MyClass", "OnBeforeUserAddHandler"));
AddEventHandler('main', 'OnBeforeEventSend', Array("MyClass", "my_OnBeforeEventSend"));

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('', 'LowPriceOnAfterUpdate', Array("MyClass",'afterUpdate'));

class MyClass
{
	const CACHE_PATH_LAST_USER_REG = '/s1/mycomponent/user_last_registration';
    // создаем обработчик события "OnBeforeUserAdd"
    function OnBeforeUserAddHandler(&$arFields)
    { 
	    
		$domen = substr($arFields["EMAIL"], strrpos($arFields["EMAIL"], '@') + 1);
        $rsUsers = UserTable::getList(array(
		    'select' => array('ID'),
			'filter' => array(
			                  'LID' => SITE_ID,
			                  '=EMAIL' => $arFields["EMAIL"]
							  ),
		));
		$user = $rsUsers->fetch();
		if($user['ID'] != 0)
        {			
            global $APPLICATION;
            $APPLICATION->throwException("Пользователь с таким емейл уже существует!");
            return false;
        } 
        else if( (strcasecmp($domen,"rambler.ru") == 0) || (strcasecmp($domen, "list.ru") == 0))
        {	
            global $APPLICATION;
            $APPLICATION->throwException("Извините, не работаем с доменом - " . $domen);
            return false;
        } 
		else{
			$rsUsers = UserTable::getList(array(
									'select' => array('EMAIL'),
									'filter' => array(
													  "UserGroupTable:USER.GROUP_ID"=>1,
									),
            ));
			$arEmail = array();
			while($arUser = $rsUsers->fetch())
			{
				$arEmail[] = $arUser['EMAIL'];	
			}
			
			if(count($arEmail) > 0)
			{
				

				$arEventFields = array(
				        "EMAIL_ADMIN" => implode(",", $arEmail),
				        "LOGIN" => $arFields["LOGIN"],
						"EMAIL" => $arFields["EMAIL"],
						"REFERER" => __GetFullReferer(),
						"DATE" => date('d.m.Y'),
				);
				CEvent::Send("NEW_USER_DATA", SITE_ID, $arEventFields);
			}
			BXClearCache(true, self::CACHE_PATH_LAST_USER_REG);
		}
    }
	
	function my_OnBeforeEventSend(&$arFields, $arTemplate)
    {
        $domen = substr($arFields["EMAIL"], strrpos($arFields["EMAIL"], '@') + 1);
        if($domen == "yandex.ru")
		{
			unset($arFields['EMAIL']);
		}
         
    }

    function afterUpdate(\Bitrix\Main\Entity\Event $event)
    {
        $id = $event->getParameter("id");
		test_dump($id);
		$entity = $event->getEntity();
        $entityDataClass = $entity->GetDataClass();
		
		$rsData = $entityDataClass::getList(
			array(
				"select" => array(
				                'UF_VENDOR_CODE',
				                'UF_DATE_BID',
								'UF_COMMENT',
								'UF_DATE_TIME_COMMENT',
								'UF_USER_ID'
				),
				"filter" => array('ID' => $id['ID'])
			)
		);
			 
		if ($arData = $rsData -> Fetch()){
			$rsUsers = UserTable::getList(array(
									'select' => array('EMAIL'),
									'filter' => array(
													  "ID"=>$arData['UF_USER_ID'],
									),
            ));
			
			if($arUser = $rsUsers->fetch())
			{
				$email = $arUser['EMAIL'];	
				$arEventFields = array(
				        "EMAIL" => $email,
				        "VENDOR_CODE" => $arData["UF_VENDOR_CODE"],
						"DATE_BID" => $arData["UF_DATE_BID"],
						"COMMENT" => $arData["UF_COMMENT"],
						"DATE_TIME_COMMENT" => $arData["UF_DATE_TIME_COMMENT"],
						
				);
				CEvent::Send("LOW_PRICE_BID", SITE_ID, $arEventFields);
			}
		}
    }	
}


?>