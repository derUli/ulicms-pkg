/* Safari Kompatiblität zum HTML 5 required Attribut */
if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {

    $(document).ready(function(){
		$("form").submit(function(e) {

			var ref = $(this).find("[required]");

			$(ref).each(function(){
				if ( $(this).val() == '' )
				{
					var userLang = navigator.language || navigator.userLanguage;
					var message = "Required field should not be blank.";
					if(userLang == "de"){
					   message = "Bitte füllen Sie alle Pflichtfelder aus.";
					}

					alert(message);
					$(this).focus();

					e.preventDefault();
					return false;
				}
			});  return true;

});


});


};