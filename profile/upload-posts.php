<?php
include("../application/db.php");

$user_id = $_SESSION['id'];

$sql_posts = "select posts.id, posts.title, posts.content, posts.image_url, count(comments.id) as comments_count
from posts left join comments on posts.id =comments.post_id where posts.user_id = '$user_id'
group by posts.id order by posts.created_at desc";

$result_posts = $connection->query($sql_posts);
if($result_posts->num_rows>0){
    while($row = $result_posts->fetch_assoc()){
        echo "<div class='post-block'>";
        if(!empty($row['image_url'])){
            echo "<div class= 'post-image'><img src='../posts/" . htmlspecialchars($row['image_url'])."' alt='Post Image'></div>";
            
        }
        echo "<div class='post-content'>";
        echo "<h3><a href ='http://localhost/SocialS/posts/post.php?id=" . $row['id'] . "'>" . 
        htmlspecialchars($row['title']). "</a></h3>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "<p>Количество комментариев: ". $row['comments_count'] . "</p>";
        echo "</div>";
        echo "</div>";
    }

}else{
    echo "<p>У вас нет постов.</p>";
}