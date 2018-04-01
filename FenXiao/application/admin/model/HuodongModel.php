<?php
namespace app\admin\model;
use think\Model;
class HuodongModel extends Model{
	protected $table='huodong';
}
/*
外键表中 car belongsTo('主键表模型','外键表外键列名','主键表主键列名')
主键表中 level hasMany('外键表模型','外键表外键列名','主键表主键列名')
 */
?>