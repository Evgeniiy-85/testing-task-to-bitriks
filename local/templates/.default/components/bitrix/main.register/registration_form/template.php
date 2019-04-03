<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>

<div class="bx-auth-reg">
	<h2><?=GetMessage("AUTH_REGISTER")?></h2>
	
	<?php if($USER->IsAuthorized()):?>
		<span class="bx-auth-reg-successful"><b><?=GetMessage("MAIN_REGISTER_AUTH")?></b></span>
	<?php else:?>
		
		<?php if (count($arResult["ERRORS"]) > 0):
			foreach ($arResult["ERRORS"] as $key => $error)
				if (intval($key) == 0 && $key !== 0) {
					$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;"
					.GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
				}

				ShowError(implode("<br />", $arResult["ERRORS"]));

		elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
			<p><?php echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
		<?php endif?>
			
		<form class="bx-auth-reg-form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">

			<?php if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?php endif;?>
			
			<?php foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
				<?php if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
					<div>
						<?= GetMessage("main_profile_time_zones_auto")?>
						<?php if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>
							<span class="starrequired">*</span>
						<?php endif?>

						<select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
							<option value=""><?php echo GetMessage("main_profile_time_zones_auto_def")?></option>
							<option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?php echo GetMessage("main_profile_time_zones_auto_yes")?></option>
							<option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?php echo GetMessage("main_profile_time_zones_auto_no")?></option>
						</select>
					</div>

					<div>
						<?= GetMessage("main_profile_time_zones_zones")?>

						<select name="REGISTER[TIME_ZONE]"<?php if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"'?>>
							<?php foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
										<option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
							<?php endforeach?>
						</select>
					</div>
				<?php else:?>
					<div class="bx-auth-reg-item">
						<label for="REGISTER[<?=$FIELD?>]">
							<?=GetMessage("REGISTER_FIELD_".$FIELD)?>:
							<?php if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>
								<span class="starrequired">*</span>
							<?php endif?>
						</label>
						
						<?php switch ($FIELD):
							case "PASSWORD":?>
								<input size="30" type="password" name="REGISTER[<?=$FIELD?>]"
									value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off"
									class="bx-auth-input" 
								/>

								<?php if($arResult["SECURE_AUTH"]):?>
									<span class="bx-auth-secure" id="bx_auth_secure" title="<?php echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
										<div class="bx-auth-secure-icon"></div>
									</span>

									<noscript>
										<span class="bx-auth-secure" title="<?php echo GetMessage("AUTH_NONSECURE_NOTE")?>">
											<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
										</span>
									</noscript>

									<script type="text/javascript">
									document.getElementById('bx_auth_secure').style.display = 'inline-block';
									</script>
								<?php endif?>
							<?php break;

							case "CONFIRM_PASSWORD":?>
								<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" 
									value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" 
								/>

							<?php break;

							case "PERSONAL_GENDER":?>
								<select name="REGISTER[<?=$FIELD?>]">
									<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
									<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
									<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
								</select>
							<?php break;

							case "PERSONAL_COUNTRY":
							case "WORK_COUNTRY":?>
								<select name="REGISTER[<?=$FIELD?>]">
									<?php foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value):?>
										<option value="<?=$value?>"<?php if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?php endif?>>
											<?=$arResult["COUNTRIES"]["reference"][$key]?>
										</option>
									<?php endforeach	?>
								</select>
							<?php break;

							case "PERSONAL_PHOTO":
							case "WORK_LOGO":?>
								<input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" />
							<?php break;

							case "PERSONAL_NOTES":
							case "WORK_NOTES":?>
								<textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]">
									<?=$arResult["VALUES"][$FIELD]?>
								</textarea>
							<?php break;

							default:
								$add_class = "";
								if ($FIELD == "PERSONAL_BIRTHDAY"):?>
									<small><?=$arResult["DATE_FORMAT"]?></small>
									<?php $add_class = "datepicker"; ?>
								<?php endif;?>

								<input class="<?=$add_class?>" size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" />

								<?php if ($FIELD == "PERSONAL_BIRTHDAY") {
//									$APPLICATION->IncludeComponent(
//										'bitrix:main.calendar',
//										'',
//										array(
//											'SHOW_INPUT' => 'N',
//											'FORM_NAME' => 'regform',
//											'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
//											'SHOW_TIME' => 'N'
//										),
//										null,
//										array("HIDE_ICONS"=>"Y")
//									);
								}?>
							<?php endswitch?>
						</div>
				<?php endif?>
			<?php endforeach?>

			<?php // ********************* User properties ***************************************************?>
		
			<?php if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
				<div>
					<?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?>
				</div>

				<?php foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
					<div>
						<?=$arUserField["EDIT_FORM_LABEL"]?>:
							<?php if ($arUserField["MANDATORY"]=="Y"):?>
								<span class="starrequired">*</span>
							<?php endif;?>

							<?php $APPLICATION->IncludeComponent(
								"bitrix:system.field.edit",
								$arUserField["USER_TYPE"]["USER_TYPE_ID"],
								array(
										"bVarsFromForm" => $arResult["bVarsFromForm"],
										"arUserField" => $arUserField,
										"form_name" => "regform"
								), null, array("HIDE_ICONS"=>"Y")
							);?>
					</div>
				<?php endforeach;?>
			<?php endif;?>

			<?php // ******************** /User properties ***************************************************?>
		
			<?php /* CAPTCHA */ if ($arResult["USE_CAPTCHA"] == "Y"):?>
				<div>
					<b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b>
				</div>

				<div>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				</div>

				<div>
					<?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span>
					<input type="text" name="captcha_word" maxlength="50" value="" />
				</div>
			<?php endif /* !CAPTCHA */?>

			<div>
				<input class="submit" type="submit" name="register_submit_button" value="Зарегистрироваться" />
			</div>

			<div class="warning">
				<p><?php echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
				<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>
			</div>
		</form>
	<?php endif?>
</div>