<div class="menu_box">
    <ul>
        <? foreach($menu as $item){?>
            <li><a href="<?=$link[$item]?>"><?=$item?></a></li>
        <?}?>
        <?if($auth["admin"]==="true"){?>
            <li><a href="<?=$link[$admin]?>"><?=$admin?></a></li>
        <?}?>
    </ul>
</div>