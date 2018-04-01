<?php
namespace app\xcx\model;
use think\Model;
class CarModel extends Model{
	protected $table='car';

	public function brand(){
	 	return $this->belongsTo('BrandModel','car_brand','id');
	}

	public function level(){
		return $this->belongsTo('LevelModel','car_level','id');
	}

	public function config(){
	 	return $this->belongsTo('ConfigModel','car_config','id');
	}
}
/*
外键表中 car belongsTo('主键表模型','外键表外键列名','主键表主键列名')
主键表中 level hasMany('外键表模型','外键表外键列名','主键表主键列名')
 */
?>