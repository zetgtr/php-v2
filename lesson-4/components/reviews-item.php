<div class="reviews_icon" onclick="reviewsClickOn()"><img src="img/chat.png" alt=""></div>
    <form action="reviews.php" method="POST" class="reviews">
        <div class="exit" onclick="reviewsClickOff()">&#10006;</div>
        <input type="text" name="reviews-name" placeholder="Ваше имя">
        <textarea placeholder="Ваш отзыв" name="reviews-text" id="reviews-text" cols="30" rows="10"></textarea>
        <button type="submit" value="Отправить" >Отправить</button>
    </form>
</div>