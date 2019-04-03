<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>

<div class="container">
	<div class="banner">
		<img src="<?php echo DEFAULT_TEMPLATE_PATH ?>/images/banner.jpg" alt="баннер">
	</div>
	
	<div id="registration">
		<?php $APPLICATION->IncludeComponent(
			"bitrix:main.register", 
			"registration_form", 
			array(
				"AUTH" => "N",
				"REQUIRED_FIELDS" => array(
					0 => "NAME",
					1 => "LAST_NAME",
					2 => "PERSONAL_BIRTHDAY",
					3 => "EMAIL",
				),
				"SET_TITLE" => "N",
				"SHOW_FIELDS" => array(
					0 => "NAME",
					1 => "LAST_NAME",
					2 => "PERSONAL_BIRTHDAY",
					3 => "EMAIL",
				),
				"SUCCESS_PAGE" => "/registration_finish.php",
				"USER_PROPERTY" => array(
					0 => "UF_IM_SEARCH",
				),
				"USER_PROPERTY_NAME" => "",
				"USE_BACKURL" => "N",
				"COMPONENT_TEMPLATE" => "registration_form"
			),
			false
		);?>
	</div>
	<div class="registered-users">
		<div id="tcal"></div>
		
		<h2>Список зарегистрированных пользователей</h2>
		
		<div class="datepicker" id="dates_registered_users"></div>
		
		<div class="registered-users-list-box">
            <div class="message-unsuccessful">
                <span>Пользователей на этот период не найдено</span>
            </div>
			<table id="registered-users-list">
				<thead>
					<tr>
						<td width="211">
							Имя
						</td>
						<td width="221">
							Фамилия
						</td>
						<td width="262">
							Дата регистрации
						</td>
					</tr>
				</thead>
				
				<tbody></tbody>
			</table>
			
			<div id="users"></div>
			
			<a id="show_users" href="#registered-users-list">показать список зарегистрированных за месяц</a>
		</div>
	</div>
</div>
<br>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>