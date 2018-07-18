$(function()
{
	$("#dateFrom").datepicker(
	{
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: '-110:+10'
	});
	$("#dateTo").datepicker(
	{
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: '-110:+10'
	});

	$("#intervalDate").change(function()
	{
		// var tdy=new Date();
		// var tom=new Date(tdy.getFullYear(), tdy.getMonth(), tdy.getDate()+1, 0,
		// 0, 0);
		// $("#dateFrom").val(tdy.toLocaleDateString());
		$("#dateFrom").val("");
		$("#dateTo").val("");
	});

	$("input[id*='birthdate']").datepicker(
	{
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: '-110:+10'
	});
	$("input[id*='start_date']").datepicker(
	{
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: '-110:+10'
	});
	$("input[id*='end_date']").datepicker(
	{
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: '-110:+10'
	});

	$("input[id*='close_date']").datepicker(
	{
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: '-110:+10'
	});
	$("input[id*='remind_at']").datetimepicker(
	{
		format: "Y-m-d H:i:s",
		allowBlank: true,
		todayButton: true,
		timepickerScrollbar: false
	});

	// make textareas auto-expand on key up event
	$("textarea[id*='description']").keyup(function(e)
	{
		if (e.which == 8 || e.which == 46)
		{
			lineCount= $(this).val().split("\n").length;
			$(this).height(lineCount - 1 * parseInt(window.getComputedStyle(this).fontSize));
		}
		expandTextarea(this);
	});

	// make textareas auto-expand on load
	$("textarea[id*='description']").each(function()
	{
		expandTextarea(this);
	});

	// enable tooltip and popover
	$("[data-toggle='tooltip']").tooltip();
	$("[data-toggle='popover']").popover();

	$('#report-report_object').bind('change', function()
	{
		$('#report-report_type').empty();
		$('<option/>').val('').html('').appendTo('#report-report_type');

		var optionList= eval($(this).val());
		for (var i= 0, end= optionList.length; i < end; i++)
			$('<option/>').val(optionList[i]).html(optionList[++i]).appendTo('#report-report_type');
	});

	$('#toggleAllCheckboxes').change(function()
	{
		if ($(this).is(":checked"))
			$('.idListCBox').prop('checked', true);
		else
			$('.idListCBox').prop('checked', false);
	});
	
	$('input[name*=new_opportunity]').on('change', function() {
		showHideBlock('newOpportunityFields', $(this).val());
	});
});

// responsive graphs
var chart= $("#chart"), aspect= chart.width() / chart.height(), container= chart.parent();
$(window).on("resize", function()
{
	var targetWidth= container.width();
	chart.attr("width", targetWidth);
	chart.attr("height", Math.round(targetWidth / aspect));
}).trigger("resize");


function submitFormAction(form, action)
{
	var form= document.getElementById(form);

	form.action.value= action;
	form.submit();
}

function keywordSearchBoxSetError(pErrMessage)
{
	$(".keywordWrapper").addClass("has-error");
	$("#keywordHelpBlock").html(pErrMessage);
	$("#keywordWrapper input").focus();
}

function keywordSearchBoxClearError()
{
	$(".keywordWrapper").removeClass("has-error");
	$("#keywordHelpBlock").html("");
}

function submitKeywordSearchForm(pFieldId, pErrMessage)
{
	if ($('#' + pFieldId).val().trim() == "")
	{
		keywordSearchBoxSetError(pErrMessage);
		return false;
	}

	keywordSearchBoxClearError();

	// make sure hidden field value is not submitted during search if exists
	$('#opportunitycontact-contact_id').empty();

	// set hidden submit value if exists
	$("#formSubmit").val("search");

	return true;
}

function expandTextarea(el)
{
	while ($(el).outerHeight() < el.scrollHeight + parseFloat($(el).css("borderTopWidth")) + parseFloat($(el).css("borderBottomWidth")))$(el).height($(el).height() + 1);
}

function keywordSearchListItemChecked()
{
	$('#opportunitycontact-contact_id').empty();

	if ($('input.idListCBox:checkbox') && $('input.idListCBox:checkbox').length > 0)
	{
		$('input.idListCBox:checked').each(function() {
			$('#opportunitycontact-contact_id').append('<option value=' + this.value + '></option>');
		});

		return true;
	}

	return false;
}

function setOpportunityRelatedContact(pId, pName)
{
	$('#opportunitycontact-contact_id').empty().append('<option value=' + pId + '>' + pName + '</option>');
}

function keywordSearchResultChecked(pErrMessage)
{
	if (keywordSearchListItemChecked())
	{
		keywordSearchBoxClearError();
		return true;
	}

	keywordSearchBoxSetError(pErrMessage);
	return false;
}

function showHideBlock(pId, pShowHide)
{
	if (pShowHide==1)
		$('#' + pId).show(250);
	else
		$('#' + pId).hide(250)
}

function windowOpen(pUrl, pName, pWidth, pHeight)
{
	left= (screen.width - pWidth) / 2;
	top= (screen.height - pHeight) / 2;

	newWindow= window.open(pUrl, pName, 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=' + pWidth + ', height=' + pHeight
			+ ',screenX=0,screenY=0,top=' + top + ',left=' + left);
	newWindow.focus();

	return newWindow;
}

function showChangeAccountWindow(pId, pAccIdx)
{
	_changeAccountWindow= null;

	var url= '/account/showchangeaccount/' + pId + '?accIdx=' + pAccIdx + '&excludeIds=' + $('#contact-account_id').val() + '-' + $('#contact-account2_id').val() + '-'
			+ $('#contact-account3_id').val();

	if (_changeAccountWindow && !_changeAccountWindow.closed)
	{
		_changeAccountWindow.location.href= url;
		_changeAccountWindow.focus();
	}
	else
		_changeAccountWindow= windowOpen(url, '_changeAccountWindow', 450, 400);
}

function updateAccountParentWindow(pId, pName, pAccIdx)
{
	var accElId= '#contact-account_id';
	var accElName= '#account_name';

	if (parseInt(pAccIdx) > 1)
	{
		accElId= '#contact-account' + pAccIdx + '_id';
		accElName= '#account' + pAccIdx + '_name';
	}

	$(accElId, window.opener.document).val(pId);
	$(accElName, window.opener.document).text(pName);
	window.close();
}

function resetLookupFormFields()
{
	$('#form-lookup-value').trigger('reset');
	$('#lookupform-id').focus();
}

function setLookupFormFields(id, val, idx, desc)
{
	resetLookupFormFields();

	$('#lookupform-id').val(id);
	$('#lookupform-value').val(val);
	$('#lookupform-idxpos').val(idx);
	$('#lookupform-description').val(desc);
	$('#lookupform-action').val('save');
}

function submitDeleteLookupField(id, tableName)
{
	if (confirm("<?= Yii::t('main', 'CONFIRM_DELETION') ?>"))
	{
		$('#lookupform-id').val(id);
		$('#lookupform-value').val('...');
		$('#lookupform-tableName').val(tableName);
		$('#lookupform-action').val('delete');

		$('#form-lookup-value').submit();
	}
}

function handleGroupDropdownChange(pEl)
{
	var elGroup= $(pEl).attr('id').replace(/[0-9]?_id$/, '');

	var elId= $(pEl).attr('id');

	var el1= '#' + elGroup + '_id';
	var el2= '#' + elGroup + '2_id';
	var el3= '#' + elGroup + '3_id';

	if (elId != $(el1).attr('id') && $(pEl).val() == $(el1).val())
		$(el1).prop('selectedIndex', 0);

	if (elId != $(el2).attr('id') && $(pEl).val() == $(el2).val())
		$(el2).prop('selectedIndex', 0);

	if (elId != $(el3).attr('id') && $(pEl).val() == $(el3).val())
		$(el3).prop('selectedIndex', 0);
}

function isValidURL(pUrl)
{
	return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i
			.test(pUrl);
}

function validateAddSocialMediaUrlForm(pMesgInvalidUrl, pMesgSelectOne)
{
	if (!isValidURL($('#social_media_url').val().trim()))
	{
		alert(pMesgInvalidUrl);
		$('#social_media_url').focus();
		return false;
	}

	if ($('#social_media_id').prop('selectedIndex') == 0)
	{
		alert(pMesgSelectOne);
		$('#social_media_id').focus();
		return false;
	}

	return true;
}

function handleSocialMediaUrlChange()
{
	var idx= 0;
	$('#social_media_id').prop('selectedIndex', 0);

	$('#social_media_id option').each(function()
	{
		if ($('#social_media_url').val().indexOf($(this).prop('text')) > 0)
			$('#social_media_id').prop('selectedIndex', idx);
		idx++;
	});
}
