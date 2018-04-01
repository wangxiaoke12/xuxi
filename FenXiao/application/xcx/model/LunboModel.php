<?php
namespace app\xcx\model;
use think\Model;
class LunboModel extends Model{
	protected $table='lunbo';
}
/*
外键表中 car belongsTo('主键表模型','外键表外键列名','主键表主键列名')
主键表中 level hasMany('外键表模型','外键表外键列名','主键表主键列名')
 */
?>