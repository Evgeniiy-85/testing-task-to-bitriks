<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php if (empty($arResult['ALL_ITEMS'])) die() ?>

<nav class="header-menu">
	<ul>
		<?php foreach ($arResult["ALL_ITEMS"] as $itemMenu) : ?>
			<li class="header-menu-item <?php print ($itemMenu['SELECTED'] ? 'bx-active' : '') ?>">
				<a href="<?php print $itemMenu['LINK'] ?>">
					<span><?php print $itemMenu['TEXT'] ?></span>
				</a>
			</li>
		<?php endforeach ?>
	</ul>
</nav>
