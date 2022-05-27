<?
include '../config.php';
include '../function.php';
$id = $_GET['id'];
removeGoods($connect, $id);
$sql = "SELECT * FROM goods";
$goods = mysqli_query($connect, $sql);
while ($product = mysqli_fetch_assoc($goods)) : ?>
    <script>saveGoods(<?=$product["id"]?>)</script>
    <div class="admin_goods_box">
        <img 
        class="admin_img_open_modal"  
        src="/img/<?=$product["photo1"]?>" 
        alt="<?=$product["id"]?>">
        <form class="save-goods-form" id="save-goods-form-<?=$product["id"]?>" method="post">
            <div>
                <h4>Заголовок:</h4>
                <textarea 
                name="title"
                cols="30" 
                rows="10"><?=$product["title"]?></textarea>
            </div>
            <div>
                <h4>Текст:</h4>
                <textarea 
                name="text"
                cols="30" 
                rows="10"><?=$product["text"]?></textarea>
            </div>
        </form>
        <button id="save-goods-<?=$product["id"]?>">Сохранить</button>
    </div>
<?endwhile; ?>