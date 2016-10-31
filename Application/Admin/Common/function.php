<?php
function getTree($data, $type="tree",$name='name',$child='id',$parent='pid'){
    // 获取树形或者结构数据
    if($type=='tree'){
        $data=\Org\Xman\Data::tree($data,$name,$child,$parent);
    }elseif($type="level"){
        $data=\Org\Xman\Data::channelLevel($data,0,'&nbsp;',$child);
    }
    return $data;
}