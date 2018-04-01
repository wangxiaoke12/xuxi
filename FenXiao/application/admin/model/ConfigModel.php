<?php
namespace app\admin\model;
use think\Model;
class ConfigModel extends Model{
	protected $table='config';
	public function cars(){
		return $this->hasMany('CarModel','car_name','id');
	}
}
/*
外键表中 car belongsTo('主键表模型','外键表外键列名','主键表主键列名')
主键表中 level hasMany('外键表模型','外键表外键列名','主键表主键列名')
 */
?>