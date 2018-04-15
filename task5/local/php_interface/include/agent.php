<?

function agentNewUserDay()
{	
	
	$rsUsers = \Bitrix\Main\UserTable::getList(array(
							'select'  => array( 'EMAIL',
												'DATE_REGISTER'),
							'filter' => array('>=' . 'DATE_REGISTER'=>ConvertTimeStamp(time()-86400),
							                         'LID' => "s1"),		
							'order'   => array('DATE_REGISTER' => 'DESC'),	
	));

	while($arItem = $rsUsers->fetch())
	{
		$arResult[] = array(
							'EMAIL' => $arItem['EMAIL'],
							'DATE_REGISTER' => $arItem['DATE_REGISTER'],
		);		
	}
	
	if(count($arResult) > 0)
	{
		$rsUsers = \Bitrix\Main\UserGroupTable::getList(array(
								'filter' => array('GROUP_ID'=>1),
								'select' => array('EMAIL'=>'USER.EMAIL'),
	    ));
		$arEmail = array();
		while($arUser = $rsUsers->fetch())
		{
			$arEmail[] = $arUser['EMAIL'];	
		}
		
		if(count($arEmail) > 0)
		{
			foreach($arResult as $arItem){
				
				$arEventFields["EMAIL_ADMIN"] = implode(",", $arEmail);
				$arEventFields['DATA'] .= $arItem['EMAIL'] . " - " . $arItem['DATE_REGISTER'] . "\n\t";
			}
			
			CEvent::Send("NEW_USER_DAY", "s1", $arEventFields);	
		}
	}
	return "agentNewUserDay();";
}
?>