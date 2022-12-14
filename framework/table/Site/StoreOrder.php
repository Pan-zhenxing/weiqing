<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Site;

class StoreOrder extends \We7Table {
	protected $tableName = 'site_store_order';
	protected $primaryKey = 'id';
	protected $field = array(
		'orderid',
		'goodsid',
		'duration',
		'buyer',
		'buyerid',
		'amount',
		'type',
		'changeprice',
		'createtime',
		'uniacid',
		'endtime',
		'wxapp',
		'is_wish'
	);
	protected $default = array(
		'orderid' => '',
		'goodsid' => '',
		'duration' => '',
		'buyer' => '',
		'buyerid' => '',
		'amount' => '',
		'type' => '',
		'changeprice' => 0,
		'createtime' => '',
		'uniacid' => '',
		'endtime' => 0,
		'wxapp' => 0,
		'is_wish' => 0
	);
	
	public function getAllByGoodsId($goodsid) {
		return $this->query->where('goodsid', $goodsid)->getall();
	}
	
	public function getStatisticsInfoByDate($starttime, $endtime) {
		$total_orders = $this->query->select('COUNT(id)')->where(array('createtime >=' => $starttime, 'createtime <=' => $endtime,))->getcolumn();
		$total_amounts = $this->query->select('SUM(amount)')->where(array('createtime >=' => $starttime, 'createtime <=' => $endtime, 'type' => STORE_ORDER_FINISH))->getcolumn();
		return array('total_orders' => $total_orders, 'total_amounts' => $total_amounts);
	}

	public function getQueryJoinGoodsTable($order_type = 0, $goods_type = 0) {
		$query = $this->query
			->from($this->tableName, 'a')
			->leftjoin('site_store_goods', 'b')
			->on('a.goodsid', 'b.id');
		if ($order_type > 0) {
			$query->where('a.type', $order_type);
		}
		if ($goods_type > 0) {
			$query->where('b.type', $goods_type);
		}
		return $query;
	}

	public function getUserBuyNumByType($uid, $type) {
		$account_all_type = uni_account_type();
		$account_all_type_sign = uni_account_type_sign();
		foreach($account_all_type as $account_type) {
			if ($account_type['type_sign'] == $type) {
				$store_type_number = $account_type['store_type_number'];
				break;
			}
		}
		$count = $this->getQueryJoinGoodsTable(STORE_ORDER_FINISH, array($store_type_number, STORE_TYPE_ACCOUNT_PACKAGE))
			->select("b.{$type}_num")
			->where('a.buyerid', intval($uid))
			->getall();
		if (empty($count)) {
			return 0;
		} else {
			$count = array_sum(array_column($count, "{$type}_num"));
			$deleted_account = table('site_store_create_account')->getUserDeleteNum($uid, $account_all_type_sign[$type]['contain_type']);
			return max(0, $count - $deleted_account);
		}
	}

	public function getApiOrderByUniacid($uniacid) {
		return $this->getQueryJoinGoodsTable(STORE_ORDER_FINISH, STORE_TYPE_API)
			->select('a.duration, b.api_num, b.price')
			->where('a.uniacid', intval($uniacid))
			->getall();
	}

	public function getUserBuyPackage($uniacid) {
		return $this->getQueryJoinGoodsTable(STORE_ORDER_FINISH, STORE_TYPE_PACKAGE)
			->where(function ($query) use ($uniacid) {
				$query->where('a.uniacid', $uniacid)->whereor('a.wxapp', $uniacid);
			})->getall('module_group');
	}

	
	public function searchAccountBuyGoods($uniacid, $type) {
		$this->query->from('site_store_goods', 'g')
			->leftjoin('site_store_order', 'r')
			->on(array('g.id' => 'r.goodsid'))
			->where('g.type', $type)
			->where('r.type', STORE_ORDER_FINISH);

		if ($type == STORE_TYPE_API) {
			$number_list = $this->query->where('r.uniacid', $uniacid)->select('(g.api_num * r.duration) as number')->getall('number');
			return array_sum(array_keys($number_list));

		} else{
			$this->query->where(function ($query) use ($uniacid) {
				$query->where('r.uniacid', $uniacid)->whereor('r.wxapp', $uniacid);
			});

			load()->model('store');
			$all_type = store_goods_type_info();
			if ($all_type[$type]['group'] == 'module') {
				$keyfield = 'module';
			} else {
				$type_name = array(
					STORE_TYPE_PACKAGE => 'module_group',
				);
				$keyfield = empty($type_name[$type]) ? '' : $type_name[$type];
			}
			return $this->query->getall($keyfield);
		}
	}

	public function searchWithEndtime() {
		$this->query->where('r.endtime >=', time());
		return $this;
	}
}