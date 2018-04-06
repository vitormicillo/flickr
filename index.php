<?php
	require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en-US">

	<head>
		<meta name="viewport" content="width=device-width" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?= $flickr->title; ?></title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>

		<div id="all">

			<?php

				$a = 1;
				for ($i = 0; $i < $display; $i++):

					$photo = $flickr->items[$i];
					if($photo->media->m != ''):
						if ($a == 1) { echo '<div class="row">'; }
						
						//echo '<pre>';
						//print_r($photo);
						
						echo '<div class="item">';
							echo '<a href="' . $photo->link . '" style="background-image: url(\'' . $photo->media->m  . '\');" target="_blank">';
							echo '<div>&nbsp;</div>';
							echo '</a>';
						echo '</div>';
						
						if($a == 4) { echo '</div>'; $a = 0; }
						$a++;

					endif;

				endfor;
				if($a <= 3) { echo '</div>'; }

			?>

		</div>

	</body>

</html>