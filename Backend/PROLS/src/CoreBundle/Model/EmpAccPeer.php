<?php

namespace CoreBundle\Model;

use CoreBundle\Model\om\BaseEmpAccPeer;

use \Criteria;

class EmpAccPeer extends BaseEmpAccPeer{
	public static function getInformation($id, Criteria $c = null){
		if (is_null($c)) {
			$c = new Criteria();
		}

	}
}
