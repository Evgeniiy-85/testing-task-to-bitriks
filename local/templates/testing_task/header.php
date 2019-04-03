<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php use Bitrix\Main\Page\Asset; ?>

<!DOCTYPE HTML>
<html>
    <head>
		<?php $APPLICATION->ShowHead(); ?>
		
        <title><?php $APPLICATION->showTitle(); ?></title>
        
		<?php Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/style/css/jquery-ui.css'); ?>
		<?php Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/style/css/fonts.css'); ?>
		<?php Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/style/css/style.css'); ?>
		
		<?php Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/libraries/jquery.js'); ?>
		<?php Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/libraries/jquery-ui.js'); ?>
		<?php Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/libraries/jquery-ui-ru.js'); ?>
		<?php Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/main.js'); ?>
    </head>
	
    <body>
		
		<div id="#panel"><?php $APPLICATION->ShowPanel(); ?></div>
		
		<header>
			<div class="top-header"></div>
			<div class="container">

				<div class="cta">
					<a href="#" class="social-icon vkontakte">В</a>
					<a href="#" class="social-icon facebook">f</a>
					<a href="/#registration" class="registration-toggle">Регистрация</a>
				</div>

                <div class="logo">
                    <a href="/">
                        <img src="<?php echo DEFAULT_TEMPLATE_PATH ?>/style/images/logo.png" alt="логотип">
                    </a>
                </div>

				<h1>
					<div class="top-head">DONGFENG MOTOR CORPORATION</div>
					<div class="bottom-head">DONGFENG MOTOR RUS</div>
				</h1>

				<nav class="header-menu">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "menu", Array(
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
							"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
							"DELAY" => "N",	// Откладывать выполнение шаблона меню
							"MAX_LEVEL" => "1",	// Уровень вложенности меню
							"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
							"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
							"MENU_CACHE_TYPE" => "N",	// Тип кеширования
							"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
							"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
							"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
							"COMPONENT_TEMPLATE" => "catalog_horizontal",
							"MENU_THEME" => "red",	// Тема меню
						),
						false
					);?>
				</nav>
			</div>
		</header>
