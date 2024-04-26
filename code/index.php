<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width-device-width, user-scalable-no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bazaar of knifes</title>
</head>
<body>
    <div id = form>
        <form action="save.php" method="post">
            <lable for="email">Email</lable>
            <input type="email" name="email" required>

            <label for="category">Category</label>

            <?php
            $categories = scandir('categories');
            echo '<select name="category" required>';

            foreach ($categories as $category) {
                if (is_dir("categories/$category") && $category != '.' && $category != '..') {
                    echo "<option value='$category'>$category</option>";
                }
            }

            echo '</select>';
            ?>

            <lable for="title">Title</lable>
            <input type="text" name="title" required>

            <lable for="description">Description</lable>
            <textarea rows="3" name="description" required></textarea>

            <input type="submit" value="Save"
        </form>
    </div>
    <div id="table">
        <table>
            <?php
            $categ = opendir('categories');

            while ($file = readdir($categ))
                if (is_dir('categories/'.$file) && $file != '.' && $file != '..') {
                    $subdir = opendir('categories/'.$file);
                    while ($ad = readdir($subdir))
                        if ($ad != '.' && $ad != '..') {
                            $fp = fopen('categories/'.$file.'/'.$ad, 'r');
                            $descrb = "";
                            while ($line = fgets($fp))
                                $descrb .= $line;

                            fclose($fp);
                            echo '<tr>';
                            echo "<td>$file</td>";
                            echo "<td>".substr($ad, 0, strlen($ad) - 4)."</td>";
                            echo "<td>$descrb</td>";
                            echo '</tr>';
                        }
                }
            ?>
        </table>
    </div>
</body>
</html>