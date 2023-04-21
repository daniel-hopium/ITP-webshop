<!DOCTYPE html>
<html lang="en">

<head>
    <title>Startseite</title>

    <?php
    include '../includes/head.php';
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZEJpH3Xkkj5f3W8XvOIX3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<header class="bg-light py-3">
		<div class="container">
			<h1>News Blog</h1>
		</div>
	</header>

	<main class="container my-4">
		<form id="add-article-form" method="post" action="submitNews.php">
			<div class="mb-3">
				<label for="title" class="form-label">Title:</label>
				<input type="text" id="title" name="title" class="form-control">
			</div>

			<div class="mb-3">
				<label for="content" class="form-label">Content:</label>
				<textarea id="content" name="content" class="form-control"></textarea>
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		 <div id="articles-container"></div>
	</main>
    <?php
    include '../includes/footer.php';
    ?>

    <script src="main.js"></script>
</body>

</html>