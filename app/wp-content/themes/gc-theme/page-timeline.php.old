<?php

/* Template name: Page - Timeline */

wp_head();
?>
<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php the_title(); ?></title>
</head>

<body ng-controller="liveStreaming">


	<?php
	// Armazena as informações do post em variáveis p/ a chamada da API

	$post_id = get_the_ID();
	$title = get_field('live_title');
	$live_youtube_id = get_field('live_youtube_id');

	?>


	<section class="player_container" ng-show="is_live">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div>
						<h2 class="video-title" ng-bind-html="titulo"></h2>
					</div>
					<div class="player">
						<iframe frameborder="0" allowTransparency="true" ng-src="{{player}}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.14/angular.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.4.14/angular-sanitize.min.js"></script>

	<script type="text/javascript">
		"use strict";

		var app = angular.module('app', ['ngSanitize']);
		app.controller('liveStreaming', ['$scope', '$http', '$sce', function liveStreaming($scope, $http, $sce) {
			setInterval(function() {
				$http.get('https://gc.adventistas.org/pt/wp-json/wp/v2/pages/<?php echo $post_id; ?>').then(function(res) {
					var $d = res.data;
					if ($d.acf.live_enable) {
						$scope.is_live = true;
						$scope.titulo = $d.acf.live_title;
						$scope.player = $sce.trustAsResourceUrl("https://www.youtube.com/embed/" + $d.acf.live_youtube_id + "?autoplay=1");
					} else {
						$scope.is_live = false;
						$scope.player = $sce.trustAsResourceUrl("https://www.youtube.com/embed/?autoplay=1");
					}

					console.log($d.acf);
					console.log("Enable: " + JSON.stringify($d.acf.live_enable));
					console.log("Title: " + JSON.stringify($d.acf.live_title));
					console.log("YoutubeID: " + JSON.stringify($d.acf.live_youtube_id));
					console.log("");
				});
			}, 3000);
		}]);
	</script>


</body>

</html>