<link href="pdf_style.css" rel="stylesheet" type="text/css">
<div class="board">
<? foreach($lists as $i => $list){ ?>
        <div class="list<?if($i == $longest_list){echo ' list--variable_width';}?>">
                <div class="list__name"><?=$list->name?></div>
                <?if(isset($list->cards) && !empty($list->cards)){?>
                <div class="list__column">
                        <? $c = 0; foreach($list->cards as $card){ ?>
                        <div class="card">
                                <? foreach($card->labels as $label){?>
                                <div class="label" style="background-color:<?=$label->color?>"><?=$label->name?></div>
                                <? } ?>
                                <div class="card__users">
                                        <?foreach($card->users as $m){?>
                                        <?=$m?>
                                        <?}?>
                                </div>
                                <div class="card__name"><?=$card->name?></div>
                                <div class="card__desc"><?=$card->desc?></div>
                                <?//var_dump($card)?>
                        </div>
                        <?if(!((++$c)%5)){?>
                        </div>
                        <div class="list__column">
                        <? } ?>
                        <? } ?>
                </div>
                <? } ?>
        </div>
<? } ?>
</div>