<?php

namespace CoreBundle\Model;

use CoreBundle\Model\om\BaseListIpPeer;

use \Criteria;

class ListIpPeer extends BaseListIpPeer{
	public static function getValidIP($ip, Criteria $c = null){
		if (is_null($c)) {
			$c = new Criteria();
		}	

		$c->add(self::ALLOWED_IP, $ip, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}	
}
