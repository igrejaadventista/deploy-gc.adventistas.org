<?php wp_footer(); ?>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", () => {
		var userLang = navigator.language || navigator.userLanguage;

		if (userLang.length > 2) {
			userLang = userLang.substring(0, 2)
			
		} else {
			
		}



		switch (userLang) {
			case 'pt':
				window.location.href = "/pt/";
				break;
			case 'es':
				window.location.href = "/es/";
				break;
			default:
				window.location.href = "/es/"
				break;
		}
	});
</script>



</body>

</html>