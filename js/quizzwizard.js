var bAnswerModified = false;
var bInSubmit = false;
function IsModified()
{
	return ($('#_modified').val() != '');
}

function MarkAsModified()
{
	$('#_modified').val('true');
}

function ClearModified()
{
	$('#_modified').val('');
}

function WizardAsyncAction(sActionCode, oParams, OnErrorFunction)
{
	var sStepClass = $('#_class').val();
	var sStepState = $('#_state').val();
	
	var oMap = { operation: 'async_action', quizz_id: iQuizz, token: sToken, step_class: sStepClass, step_state: sStepState, code: sActionCode, params: oParams };
	
	var ErrorFn = OnErrorFunction;
	$(document).ajaxError(function(event, request, settings) {
		$('#async_action').html('<pre>'+request.responseText+'</pre>').show();
		if (ErrorFn)
		{
			ErrorFn();
		}
	});
	
	$.post(GetAbsoluteUrlModulesRoot()+'customer-survey/run_survey.php', oMap, function(data) {
		$('#async_action').html(data);
	});
}

function WizardUpdateButtons()
{
	if (CanMoveForward())
	{
		$("#btn_next").removeAttr("disabled");
	}
	else
	{
		$("#btn_next").attr("disabled", "disabled");		
	}

	if (CanMoveBackward())
	{
		$("#btn_back").removeAttr("disabled");
	}
	else
	{
		$("#btn_back").attr("disabled", "disabled");		
	}
}

function CheckMandatoryAnswers()
{
	bReturn = true;
	
	$('div[data-mandatory=true]').each(function() {
		
		var oRadios = $(this).find('input[type=radio]');
		
		if (oRadios.length > 0)
		{
			if ($(this).find('input[type=radio]:checked').length == 0)
			{
				bReturn = false;
			}
		}
		else
		{
			oText = $(this).find('textarea');
			
			if (oText.val() == '')
			{
				bReturn = false;
			}
		}
	});
	
	return bReturn;
}

function Suspend()
{
	var oParams = {};
	$('#suspend_indicator').html('<img src="../images/indicator.gif"/>');
	$('#btn_suspend').attr('disabled', 'disabled');
	oParams.other_answers = $('#_params_answer').val(); // values from other pages
	$('div.question').each(function() {
		
		var oRadios = $(this).find('input[type=radio]');
		
		if (oRadios.length > 0)
		{
			$(this).find('input[type=radio]:checked').each(function () {
				oParams[this.name] = $(this).val();
			});
		}
		else
		{
			oText = $(this).find('textarea');
			
			oParams[oText.attr('name')] = oText.val();
		}
	});
	
	WizardAsyncAction('suspend', oParams);
}