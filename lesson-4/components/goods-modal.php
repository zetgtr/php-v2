<?php
include '../config.php';
include '../function.php';
if($_POST["id"]){
    $product = modalPhoto($connect, $_POST["id"]);
     ?>
    <?if($product["photo1"]){?>
        <label for="img_goods-photo1" class="modal_photo-1" id="<?=$product["id"]?>">
            <img 
            src="/img/<?=$product["photo1"]?>" 
            alt="<?=$product["photo1"]?>">
        </label>
    <?}else{?>
        <label for="img_goods-photo1" class="modal_photo-1" id="<?=$product["id"]?>">
            <div class="new-photo" >
                <svg 
                xmlns="http://www.w3.org/2000/svg" 
                width="26" height="26" viewBox="0 0 9 9">
                  <path id="add"
                      d="M4.5,9A4.5,4.5,0,1,1,9,4.5,4.505,4.505,0,0,1,4.5,9ZM2.531,4.125a.375.375,0,0,0,0,.751H4.125V6.468a.375.375,0,0,0,.751,0V4.875H6.468a.375.375,0,0,0,0-.751H4.875V2.531a.375.375,0,0,0-.751,0V4.125Z" />
                </svg>
            </div>
        </label>
    <?}if($product["photo2"]){?>
        <label for="img_goods-photo2" class="modal_photo-2" id="<?=$product["id"]?>">
            <img
            src="/img/<?=$product["photo2"]?>" 
            alt="<?=$product["photo2"]?>">
        </label>
    <?}else{?>
        <label for="img_goods-photo2" class="modal_photo-2" id="<?=$product["id"]?>">
            <div class="new-photo" >
                <svg 
                xmlns="http://www.w3.org/2000/svg"
                width="26" height="26" viewBox="0 0 9 9">
                  <path id="add"
                      d="M4.5,9A4.5,4.5,0,1,1,9,4.5,4.505,4.505,0,0,1,4.5,9ZM2.531,4.125a.375.375,0,0,0,0,.751H4.125V6.468a.375.375,0,0,0,.751,0V4.875H6.468a.375.375,0,0,0,0-.751H4.875V2.531a.375.375,0,0,0-.751,0V4.125Z" />
                </svg>
            </div>
        </label>
    <?}if($product["photo3"]){?>
        <label for="img_goods-photo3" class="modal_photo-3" id="<?=$product["id"]?>">
            <img 
            src="/img/<?=$product["photo3"]?>" 
            alt="<?=$product["photo3"]?>">
        </label>
    <?}else{?>
        <label for="img_goods-photo3" class="modal_photo-3" id="<?=$product["id"]?>">
            <div class="new-photo" >
                <svg 
                xmlns="http://www.w3.org/2000/svg"  
                width="26" height="26" viewBox="0 0 9 9">
                  <path id="add"
                      d="M4.5,9A4.5,4.5,0,1,1,9,4.5,4.505,4.505,0,0,1,4.5,9ZM2.531,4.125a.375.375,0,0,0,0,.751H4.125V6.468a.375.375,0,0,0,.751,0V4.875H6.468a.375.375,0,0,0,0-.751H4.875V2.531a.375.375,0,0,0-.751,0V4.125Z" />
                </svg>
            </div>
        </label>
    <?}?>
    <div class="none">
        <form id="img_goods-photo1-form" method="post">
            <input id="img_goods-photo1" type="file" name="file">
        </form>
        <form id="img_goods-photo2-form" method="post">
            <input id="img_goods-photo2" type="file" name="file">
        </form>
        <form id="img_goods-photo3-form" method="post">
            <input id="img_goods-photo3" type="file" name="file">
        </form>
    </div>
<?}?>
