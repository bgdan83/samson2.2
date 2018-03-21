<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$FIELD_SID = "comment"; // символьный идентификатор вопроса или поля веб-формы
$rsField = CFormField::GetBySID($FIELD_SID);
$arField = $rsField->Fetch();
$arResult['STATUS_COMMENT'] = $arField;

?>