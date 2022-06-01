<?while ($product = $goods->fetch()) : ?>
    <script>
        saveGoods(<?=$product["id"]?>)
        removeGoods(<?=$product["id"]?>)
    </script>
    <div class="admin_goods_box">
        <?if($product["photo1"]===null){?>
            <div class="admin_img_open_modal img-add"
                 onclick="adminModal(<?=$product["id"]?>)">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="26" height="26" viewBox="0 0 9 9">
                    <path id="add"
                          d="M4.5,9A4.5,4.5,0,1,1,9,4.5,4.505,4.505,0,0,1,4.5,9ZM2.531,4.125a.375.375,0,0,0,0,.751H4.125V6.468a.375.375,0,0,0,.751,0V4.875H6.468a.375.375,0,0,0,0-.751H4.875V2.531a.375.375,0,0,0-.751,0V4.125Z" />
                </svg>
            </div>
        <?}else{?>
            <img
                id="photo-<?=$product['id']?>"
                class="admin_img_open_modal"
                onclick="adminModal(<?=$product["id"]?>)"
                src="data/img/<?=$product["photo1"]?>"
                alt="<?=$product["id"]?>">
        <?}?>
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
        <button id="remove-goods-<?=$product["id"]?>">Удалить</button>
    </div>
<?endwhile; ?>