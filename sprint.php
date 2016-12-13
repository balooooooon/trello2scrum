<div class="board">
        <? foreach($lists as $i => $list){ ?> 
        <div class="list<?if($i == $longest_list){echo ' list--variable_width';}?>">
                <div class="list__border">
                        <div class="list__name"><?=$list->name?></div>
                        <?if(isset($list->cards) && !empty($list->cards)){?> 
                        <div class="list__column">
                                <? $c = 0; foreach($list->cards as $card){ ?> 
                                <div class="card">
                                        <? foreach($card->labels as $label){?> 
                                        <div class="card__label"<?if(!empty($label->color)){?> style="background-color:<?=$label->color?>"<?}?>><?=$label->name?></div>
                                        <? } ?> 
                                        <div class="card__users">
                                                <?=join(', ', $card->users)?> 
                                        </div>
                                        <div class="card__name"><?=$card->name?></div>
                                        <div class="card__desc"><?=$card->desc?></div>
                                </div>
                                <? } ?> 
                        </div>
                        <? } ?> 
                </div>
        </div>
        <? } ?>
</div>