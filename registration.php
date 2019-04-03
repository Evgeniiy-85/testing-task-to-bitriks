<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница регистрации");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"registration_form",
	Array(
		"AUTH" => "N",
		"COMPONENT_TEMPLATE" => "registration_form",
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"LAST_NAME",2=>"PERSONAL_BIRTHDAY",3=>"EMAIL",),
		"SET_TITLE" => "N",
		"SHOW_FIELDS" => array(0=>"NAME",1=>"LAST_NAME",2=>"PERSONAL_BIRTHDAY",3=>"EMAIL",),
		"SUCCESS_PAGE" => "/registration_finish.php",
		"USER_PROPERTY" => array(0=>"UF_IM_SEARCH",),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "N"
	)
);?> ?&gt; <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_CODE" => $_REQUEST["code"],
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "list_users",
		"MAX_VOTE" => "5",
		"MESSAGE_404" => "",
		"SET_STATUS_404" => "N",
		"VOTE_NAMES" => array("1","2","3","4","5","")
	)
);?><br><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>