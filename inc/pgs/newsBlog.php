<!DOCTYPE html>
<html lang="en">

<head>
	<title>News Blog</title>

	<?php
	include '../includes/head.php';
	?>

	<style>
		body {
			display: flex;
			flex-direction: column;
			min-height: 100vh;
		}
		main {
			flex: 1;
		}
	</style>
</head>

<body>
	<header class="bg-light py-3">
		<div class="container">
			<h1>News Blog</h1>
		</div>
	</header>

	<main class="container my-4">
		<form id="add-article-form" method="post" action="newsBlog.php" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="title" class="form-label">Title:</label>
				<input type="text" id="title" name="title" class="form-control">
			</div>

			<div class="mb-3">
				<label for="content" class="form-label">Content:</label>
				<textarea id="content" name="content" class="form-control"></textarea>
			</div>

			<div>
				<label for="image">Product Image:</label>
				<input type="file" name="image" accept="image/*" required>
			</div>
			<br>
			<br>

			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		</form>

		<div id="articles-container"></div>
	</main>

	<?php

if (isset($_POST['submit'])) {

    $db_obj = new mysqli($host, $user, $password, $database);

    $sql = "INSERT INTO `blog_news` (`title`, `content`, `image`) VALUES (?, ?, ?)";

    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param('sss', $title, $content, $image_data);

    $title = $_POST['title'];
    $content = $_POST['content'];

    // Resize image to 300x300px
    $max_size = 300;
    $image_data = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $info = getimagesize($tmp_name);
        $width = $info[0];
        $height = $info[1];
        $mime_type = $info['mime'];

        $image = null;
        switch ($mime_type) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/png':
                $image = imagecreatefrompng($tmp_name);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($tmp_name);
                break;
        }

        if ($image) {
            $new_width = $width;
            $new_height = $height;

            if ($width > $height) {
                if ($width > $max_size) {
                    $new_width = $max_size;
                    $new_height = $height * ($max_size / $width);
                }
            } else {
                if ($height > $max_size) {
                    $new_height = $max_size;
                    $new_width = $width * ($max_size / $height);
                }
            }

            $resized_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            ob_start();
            switch ($mime_type) {
                case 'image/jpeg':
                    imagejpeg($resized_image);
                    break;
                case 'image/png':
                    imagepng($resized_image);
                    break;
                case 'image/gif':
                    imagegif($resized_image);
                    break;
            }
            $image_data = ob_get_clean();
        }
    }

    if ($stmt->execute()) {
        echo "<script>location.href='redirect_page.php?type=blogNews'</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $db_obj->close();
}

?>


</body>

</html>
