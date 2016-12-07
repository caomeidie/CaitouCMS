<?php
namespace Common\Model;
use Think\Model;
/**
 * ModelName
 */
class AdminModel extends Model{
    // 自动验证
    protected $_validate=array(
        array('admin_name','require','用户名必须填写',0,'',1), // 验证字段必填
        array('admin_name','','用户名已经存在！',0,'unique',1),
        array('password','require','密码必须填写',0,'',1), // 验证字段必填
        array('mobile','require','手机号必须填写',0,'',1) // 验证字段必填
    );

    // 自动完成
    protected $_auto=array(
        array('add_time','time',1,'function'), // 对add_time字段在新增的时候写入当前时间戳
    );
}
