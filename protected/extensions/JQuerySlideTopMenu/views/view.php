<?php
function JQuerySlideRenderMenu($items)
{
    foreach($items as $item){
        echo '<li>';
        echo CHtml::link($item['label'],$item['url'], $item['active'] ? array('class'=>'active') : array());
        if(is_array($item['subs'])){
            echo "\n".'<ul>';
            JQuerySlideRenderMenu($item['subs']);
            echo '</ul>';
        }
        echo '</li>'."\n";
    }
}
?>

<div id="<?php echo $id ?>" class="jqueryslidemenu">
<ul>
<?php JQuerySlideRenderMenu($items); ?>
</ul>
<br style="clear: left" />
</div>
