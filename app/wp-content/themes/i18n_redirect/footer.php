<?php wp_footer(); ?>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", setInterval(function() {
		var userLang = navigator.language || navigator.userLanguage;

		console.log(userLang.length);

		if (userLang.length > 2) {
			userLang = userLang.substring(0, 2)
			console.log('maior');
		} else {
			console.log('menor');
		}

		console.log(userLang);

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
	}, 3000));
</script>



</body>

</html>