<?php
namespace Common\Model;
use Think\Model;
/**
 * ModelName
 */
class AdminModel extends Model{
    // 自动验证
    protected $_validate=array(
        array('admin_name','require','网站必须填写',0,'',1), // 验证字段必填
        array('links_url','require','链接必须填写',0,'',1), // 验证字段必填
        //array('goods_code','','商品编号已经存在！',0,'unique',1),
    );

    // 自动完成
    protected $_auto=array(
        array('add_time','time',1,'function'), // 对add_time字段在新增的时候写入当前时间戳
    );

    /**
     * 添加商品
     */
    public function addData($data){
        // 对data数据进行验证
        if(!$data=$this->create($data)){
            // 验证不通过返回错误
            return false;
        }else{
            // 验证通过
            $result=$this->add($data);
            return $result;
        }
    }

    /**
     * 修改商品
     */
    public function editData($map,$data){
        // 对data数据进行验证

        if(!$data=$this->create($data)){
            // 验证不通过返回错误

            return false;
        }else{
            // 验证通过
            $result=$this
                ->where($map)
                ->save($data);
            return $result;
        }
    }

    /**
     * 删除数据
     * @param   array   $map    where语句数组形式
     * @return  boolean         操作是否成功
     */
    public function deleteData($map){
        $result=$this
            ->where(array($map))
            ->delete();
        return $result;
    }
}
