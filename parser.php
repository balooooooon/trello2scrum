<?php
if(empty($_POST) && empty($_FILES)){
        return;
}

include './mpdf60/mpdf.php';
$label_colors = [
    'sky' => '#3BCDE4'
];

function replace_labels_colors($card){
        global $label_colors;
        foreach($card->labels as $l){
                $l->color = str_replace(array_keys($label_colors), array_values($label_colors), $l->color);
        }
        return $card;
}
function array_to_assoc($arr){
        $ret = [];
        foreach($arr as $i){
                $ret[$i->id] = $i;
        }
        return $ret;
}
function add_cards_to_lists($cards, $lists){
        foreach($cards as $c){
                $list = $c->idList;
                if(!isset($lists[$list]->cards)){
                        $lists[$list]->cards = [];
                }
                $lists[$list]->cards[$c->id] = $c;
                replace_labels_colors($c);
        }
}
function find_longes_list($lists){
        $longest_list = 0;
        $longest_list_cards = 0;
        foreach($lists as $i => $l){
                if(!isset($l->cards)){
                        continue;
                }
                if($longest_list_cards < count($l->cards)){
                        $longest_list_cards = count($l->cards);
                        $longest_list = $i;
                }
        }
        return $longest_list;
}
function add_users_to_cards($cards, $members){
        foreach($cards as $c){
                $c->users = [];
                foreach($c->idMembers as $id){
                        foreach($members as $m){
                                if($m->id == $id){
                                        $c->users[] = $members[$id]->fullName;
                                        break;
                                }
                        }
                }
        }
}

function parse_file($input){
        $file_content = file_get_contents($_FILES[$input]['tmp_name']);
        //$file_content = file_get_contents('files/'.$input.'.json');
        $object = json_decode($file_content);
        $lists = array_to_assoc($object->lists);
        $cards = array_to_assoc($object->cards);
        $members = array_to_assoc($object->members);
        add_cards_to_lists($cards, $lists);
        add_users_to_cards($cards, $members);
        $longest_list = find_longes_list($lists);
        include($input.'.php');
}

$mpdf=new mPDF('utf-8', 'A2-L'); 
ob_start();
ob_clean();
include './view.php';
//echo ob_get_clean();
$mpdf->WriteHTML(ob_get_clean());
$mpdf->Output();

die;