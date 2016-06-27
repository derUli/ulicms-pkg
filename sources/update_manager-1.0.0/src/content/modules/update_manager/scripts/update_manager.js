$(function() {
	$("form#update-manager").submit(
			function() {
				event.preventDefault();
				var packages = $(
						'form#update-manager input[type=checkbox]:checked')
						.map(function(_, el) {
							return $(el).val();
						}).get();
				if (packages.length > 0) {
					var url = "index.php?action=install_modules&packages="
							+ packages.join(",");
					location.replace(url);
				} else {
					alert($("#translation_please_select_packages").data(
							"translation"));
				}

			});
});