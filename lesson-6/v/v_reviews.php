<main>
    <div class="conteiner">
        <div class="reviews_box">
            <? while ($data = $reviews->fetch()) : ?>
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
        </div>
    </div>
</main>