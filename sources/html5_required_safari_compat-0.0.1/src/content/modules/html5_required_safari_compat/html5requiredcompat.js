var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
var is_safari = navigator.userAgent.indexOf("Safari") > -1;
	
if(is_safari && !is_chrome){
    $(document).ready(function(){
		$("form").submit(function(e) {

			var ref = $(this).find("[required]");

			$(ref).each(function(){
				if ( $(this).val() == '' )
				{
					var userLang = navigator.language || navigator.userLanguage;
					var_message = "Required field should not be blank.";
					if(userLang == "de"){
					   message = "Bitte füllen Sie alle Pflichtfelder aus.";
					}

						alert(var_message);
					$(this).focus();

					e.preventDefault();
					return false;
				}
			});  return true;
	});
};


});