<!DOCTYPE html>
<html lang="en">

<head>
	<title>News Blog</title>
	<?php include '../includes/head.php'; ?>
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: Arial, sans-serif;
			font-size: 16px;
			line-height: 1.5;
			background-color: #f9f9f9;
			height: 100%;
			display: flex;
			flex-direction: column;
		}

		header {
			background-color: #333;
			color: #fff;
			padding: 20px;
		}

		h1 {
			font-size: 2rem;
		}

		main {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}

		.blog-post {
			width: calc(33.33% - 20px);
			margin-bottom: 40px;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
			border-radius: 4px;
		}

		.blog-post h2 {
			font-size: 1.5rem;
			margin-bottom: 10px;
		}

		.blog-post .blog-post-meta {
			font-size: 0.8rem;
			color: #666;
			margin-bottom: 20px;
		}

		.blog-post p {
			margin-bottom: 20px;
			line-height: 1.5;
			overflow: hidden;
			text-overflow: ellipsis;
			height: 100px;
		}

		.blog-post .read-more {
			display: block;
			text-align: right;
			margin-top: 20px;
			text-decoration: none;
			color: #333;
			font-size: 1rem;
			transition: color 0.2s;
		}

		.blog-post .read-more:hover {
			color: #555;
		}

		.full-post {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: rgba(0, 0, 0, 0.5);
			z-index: 999;
		}

		.full-post-inner {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
			border-radius: 4px;
			position: relative;
			top: 50%;
			transform: translateY(-50%);
		}

		.full-post h2 {
			font-size: 2rem;
			margin-bottom: 20px;
		}

		.full-post .blog-post-meta {
			font-size: 1rem;
			color: #666;
			margin-bottom: 20px;
		}

		.full-post p {
			line-height: 1.5;
			margin-bottom: 20px;
			height: auto;
		}

		.back-button {
			background-color: #333;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 4px;
			font-size: 1rem;
			cursor: pointer;
			transition: background-color 0.2s;
		}

		.back-button:hover {
			background-color: #555;
		}
	</style>

</head>

<body>
	<header>
		<h1>News Blog</h1>
	</header>
	<main>
		<?php
		require_once('../../config/dbaccess.php');

		$userID = $currentUser['id'];
		$db_obj = new mysqli($host, $user, $password, $database);

		$sql = "SELECT * FROM blog_news ORDER BY ID DESC";
		$result = $db_obj->query($sql);

		while ($row = $result->fetch_assoc()) {
			$field1name = $row["created"];
			$field2name = $row["title"];
			$field3name = $row["content"];
			$imageData = base64_encode($row["image"]);
		?>
			<div class="blog-post">
				<h2><?php echo $field2name; ?></h2>
				<div class="blog-post-meta"><?php echo $field1name; ?></div>
				<img src="data:image/png;base64,<?php echo $imageData; ?>" alt="Image" style="max-width: 100%; height: auto;">
				<br>
				<br>
				<p><?php echo $field3name; ?></p>
				<a href="#" class="read-more">Read More</a>
				<div class="full-post">
					<div class="full-post-inner">
						<h2><?php echo $field2name; ?></h2>
						<div class="blog-post-meta"><?php echo $field1name; ?></div>
						<img src="data:image/png;base64,<?php echo $imageData; ?>" alt="Image" style="max-width: 100%; height: auto;">
						<br>
						<br>
						<p><?php echo $field3name; ?></p>
						<button class="back-button">Back</button>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</main>

	<?php include '../includes/footer.php'; ?>

	<script>
		const readMoreLinks = document.querySelectorAll('.read-more');
		const fullPostContainers = document.querySelectorAll('.full-post');
		const backButtons = document.querySelectorAll('.back-button');

		readMoreLinks.forEach((link, index) => {
			link.addEventListener('click', (e) => {
				e.preventDefault();
				fullPostContainers[index].style.display = 'block';
			});
		});

		backButtons.forEach((button) => {
			button.addEventListener('click', (e) => {
				e.preventDefault();
				button.parentElement.parentElement.style.display = 'none';
			});
		});
	</script>
</body>

</html>