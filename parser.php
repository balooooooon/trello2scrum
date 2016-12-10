<?php
if(empty($_POST) && empty($_FILES)){
        return;
}

include './mpdf60/mpdf.php';

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
        $object = json_decode($file_content);
        $lists = array_to_assoc($object->lists);
        $cards = array_to_assoc($object->cards);
        $members = array_to_assoc($object->members);
        add_cards_to_lists($cards, $lists);
        add_users_to_cards($cards, $members);
        $longest_list = find_longes_list($lists);
        include($input.'.php');
}

$mpdf=new mPDF('utf-8', 'A3-L'); 
ob_start();
ob_clean();
include './view.php';
$mpdf->WriteHTML(ob_get_clean());
$mpdf->Output();

die;