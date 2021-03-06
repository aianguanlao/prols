<?php

namespace CoreBundle\Model;

use CoreBundle\Model\om\BaseEmpProfilePeer;

use \Criteria;

class EmpProfilePeer extends BaseEmpProfilePeer{
	public static function getInformation($id, Criteria $c = null){
		if (is_null($c)) {
			$c = new Criteria();
		}	

		$c->add(self::EMP_ACC_ACC_ID, $id, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;

	}
}
