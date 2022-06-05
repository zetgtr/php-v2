<?php
$sql = "SELECT * FROM `reviews`";
$reviews = mysqli_query($connect, $sql);
?>

<main>
    <div class="conteiner">
        <div class="reviews_box">
            <? while ($data = mysqli_fetch_assoc($reviews)) : ?>
            <h4>Имя: <?= $data["name"] ?></h4>
            <div>
                <h4>Отзыв:</h4>
                <p><?=$data["text"] ?></p>
            </div>
            <hr />
            <?php endwhile; ?>
            <div class="reviews_icon" 
            onclick="reviewsClickOn()">
                <img src="uploads/chat.png" alt="">
            </div>
            <form action="reviews.php" method="POST" class="reviews">
                <input type="text" name="reviews-name" placeholder="Ваше имя">
                <textarea 
                placeholder="Ваш отзыв" 
                name="reviews-text" 
                id="reviews-text" cols="30" rows="10"></textarea>
                <input type="submit" value="Отправить">
            </form>
        </div>
    </div>
</main>