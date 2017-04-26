$(window).load(function(){
    $("select#countries-searchcountries").change(function(){
       var $val = $(this).children(":selected").attr('value');
       document.location.href="/tours?ToursSearch[country_to_id]="+$val;
    });
    $("select#tours-city, select#tours-country").change(function(){
        $('#tour-country-filter').submit();
    });
    $("select#tourfirms-city").change(function(){
        var $val = $(this).children(":selected").attr('value');
        document.location.href="/tourfirms?TourfirmsSearch[city_id]="+$val;
    });
});

$('.table-striped input[type="checkbox"]').attr('name', 'status[]').click(function(){
	var id = $(this).attr('value');
	var checkbox = $(this);
	checkbox.hide();
	checkbox.parent().append('<p id="status-preloader">загрузка...</p>');
	$.ajax({
	  type: 'POST',
	  url: '/profile/tourfirmreviews/statusupdate?id='+id,
	  data: id,
	  success: function(data){
	  	checkbox.show()
	  	$("#status-preloader").remove();
  	}
	});
})
//	};
//	if($("#tourfirma").prop("checked")){
//		alert('tourfirma');
//	};

function parseResponse(response)
{
    if(response.errorVotes){
    swal({
      type: 'warning',
      title: 'Вы голосовали!',
    })
    }

	if (response.error) {
		showError(response.error);
	}
    if (response.success) {
        showSuccess(response.success);
    }
    if (response.closeModal) {
        ModalClose(response.closeModal);
    }
    if (response.openm) {
            modalOpen(response.openm);
        }
	if (response.refresh) {
		window.location.reload(true);
	}
	if (response.redirect) {
		window.location.href = response.redirect;
	}
	if(response.replaces instanceof Array)
	{
		for(var i = 0, ilen = response.replaces.length; i < ilen; i++)
		{
			$(response.replaces[i].what).replaceWith(response.replaces[i].data);
		}
	}
	if(response.append instanceof Array)
	{
		for(i = 0, ilen = response.append.length; i < ilen; i++)
		{
			$(response.append[i].what).append(response.append[i].data);
		}
	}
	if(response.js)
	{
		$("body").append(response.js);
	}
	jsFunctionsAssign();
}
function jsFunctionsAssign()
{

}
function showSuccess(success)
{
    swal("Успешно",success,"success");
}
function modalOpen(openModal)
{
     $(openModal).easyModal({
                top: 100,
                autoOpen: true,
                overlayOpacity: 0.3,
                overlayColor: "#333",
                overlayClose: true,
                closeOnEscape: true
            });
}
function ModalClose(closeModal)
{
    $(closeModal).trigger('closeModal');
}
function showError(error)
{
	swal("Ошибка",error,"error");
}
// yii submit form
function submitForm (element, url, params) {
	var f = $(element).parents('form')[0];
	if (!f) {
		f = document.createElement('form');
		f.style.display = 'none';
		element.parentNode.appendChild(f);
		f.method = 'POST';
	}
	if (typeof url == 'string' && url != '') {
		f.action = url;
	}
	if (element.target != null) {
		f.target = element.target;
	}

	var inputs = [];
	$.each(params, function(name, value) {
		var input = document.createElement("input");
		input.setAttribute("type", "hidden");
		input.setAttribute("name", name);
		input.setAttribute("value", value);
		f.appendChild(input);
		inputs.push(input);
	});

	// remember who triggers the form submission
	// this is used by jquery.yiiactiveform.js
	$(f).data('submitObject', $(element));

	$(f).trigger('submit');

	$.each(inputs, function() {
		f.removeChild(this);
	});
}



$(function(){
	$(document).on('submit', 'form.ajax-form', function (event) {
		event.preventDefault();
		var that = this;
		jQuery.ajax({'cache': false, 'type': 'POST', 'dataType': 'json', 'data':$(that).serialize(), 'success': function (response) {
			parseResponse(response);
		}, 'error': function (response) {
			alert(response.responseText);
		}, 'beforeSend': function() {

		}, 'complete': function() {

		}, 'url': this.action});
		return false;
	});
	$(document).on('click', 'a.submit-form-link', function (event) {
		var that = this;
		if(!$(that).data('confirm') || confirm($(that).data('confirm'))) {
			submitForm(
				that,
				that.href,
				$(that).data('params')
			);
			return false;
		} else {
			return false;
		}
	});
	$(document).on('click', 'a.ajax-link', function (event) {
		event.preventDefault();
		var that = this;
		if($(that).data('confirm') && !confirm($(that).data('confirm'))) {
			return false;
		}
		jQuery.ajax({'cache': false, 'type': 'POST', 'dataType': 'json', 'data':$(that).data('params'), 'success': function (response) {
			parseResponse(response);
		}, 'error': function (response) {
			alert(response.responseText);
		}, 'beforeSend': function() {

		}, 'complete': function() {

		}, 'url': that.href});
		return false;
	});

});

