<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/css/style.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <h1>Index</h1>
        <?php
            foreach($posts as $post) {
                echo '<h2>' . $post['title'] . '</h2>';
            }
        ?>
    </div>
</body>
</html>
