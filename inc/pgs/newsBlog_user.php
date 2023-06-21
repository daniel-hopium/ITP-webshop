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
        max-height: 80vh;
        /* This will set a max height to 80% of the view height of the device */
        overflow-y: auto;
        /* This will make the div scrollable vertically */
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

    .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 1.5rem;
        color: #fff;
        cursor: pointer;
        background: #000;
        height: 30px;
        width: 30px;
        text-align: center;
        line-height: 30px;
        border-radius: 50%;
        z-index: 1000;
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

	$db_obj = new mysqli($host, $user, $password, $database);

	$sql = "SELECT * FROM blog_news ORDER BY ID DESC";
	$result = $db_obj->query($sql);

	while ($row = $result->fetch_assoc()) {
		$id = $row["id"]; // Fetch the ID from the database
		$field1name = $row["created"];
		$field2name = $row["title"];
		$field3name = $row["content"];
		$imageData = base64_encode($row["image"]);
	?>
        <div class="blog-post">
            <h2><?php echo $field2name; ?></h2>
            <div class="blog-post-meta"><?php echo $field1name; ?></div>
            <img src="data:image/png;base64,<?php echo $imageData; ?>" alt="Image"
                style="max-width: 100%; height: auto;">
            <br>
            <br>
            <p><?php echo $field3name; ?></p>
            <a href="newsBlog_user.php#<?php echo $id; ?>" class="read-more">Read More</a>
            <!-- Add ID to the link -->
            <div class="full-post" id="<?php echo $id; ?>">
                <div class="full-post-inner">
                    <div class="close-btn">&times;</div>
                    <h2><?php echo $field2name; ?></h2>
                    <div class="blog-post-meta">
                        <?php echo $field1name; ?>
                    </div>
                    <img src="data:image/png;base64,<?php echo $imageData; ?>" alt="Image"
                        style="max-width: 100%; height: auto;">
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
    const closeButtons = document.querySelectorAll('.close-btn');

    readMoreLinks.forEach((link, index) => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            fullPostContainers[index].style.display = 'block';
            window.history.pushState({}, '', link.getAttribute('href'));
        });
    });


    backButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            button.parentElement.parentElement.style.display = 'none';
            window.history.pushState({}, '', 'newsBlog_user.php');
        });
    });

    closeButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            button.parentElement.parentElement.style.display = 'none';
            window.history.pushState({}, '', 'newsBlog_user.php');
        });
    });

    const urlFragment = window.location.hash;
    if (urlFragment) {
        const postToOpen = document.querySelector(`#full-post${urlFragment}`);
        if (postToOpen) {
            postToOpen.style.display = 'block';
        }
    }
    window.onload = function() {
        // Get the id parameter from URL
        var urlParams = new URLSearchParams(window.location.search);
        var id = urlParams.get('id');

        // If there's an id in the URL
        if (id) {
            // Get the element with the id same as the URL parameter
            var targetModal = document.getElementById(id);

            // If the element exists
            if (targetModal) {
                // Show the modal
                targetModal.style.display = 'block';
            }
        }
    }
    </script>
</body>

</html>