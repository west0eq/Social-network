<?php
include_once '../application/db.php';

$sql = "select id, title, content, image_url from posts order by created_at desc";

$result = $connection->query($sql);

if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo '<div class="post">';
        echo '<div class="post-img-container">';
        if(!empty($row["image-url"])){
            echo '<img src="' . htmlspecialchars($row["image_url"]) . '"alt="Post Image">';
        }

        echo '</div>';
        echo '<div class="post-content">';
        echo '<h2><a href="post.php?id=' . $row['id'] . '"style="color:#FFC000; text-decoration:none;">'. htmlspecialchars($row["title"]).
        '</a></h2>';

        echo '<p>' . nl2br(htmlspecialchars(substr($row["content"], 0, 200))) . '...</p>';

        echo    '</div>';
        echo    '</div>';

    }
}else{
    echo "Постов пока нет";
}
$connection->close();