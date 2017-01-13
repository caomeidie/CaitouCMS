<?php
function getTree($data, $type="tree",$name='name',$child='id',$parent='pid',$sort='sort'){
    // 获取树形或者结构数据
    if($type=='tree'){
        $data=\Org\Xman\Data::tree($data,$name,$child,$parent);
    }elseif($type="level"){
        $data=\Org\Xman\Data::channelLevel($data,0,'&nbsp;',$child);
    }elseif($type="sort_level"){
        $data=\Org\Xman\Data::sort_channelLevel($data,0,'&nbsp;',$child, $parent, 1, $sort);
    }
    return $data;
}