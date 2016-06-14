<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CoreBundle\Model\EmpProfilePeer;
use CoreBundle\Model\EmpContactPeer;
use CoreBundle\Model\EmpWorkPeer;
use CoreBundle\Model\ListContTypesPeer;
use CoreBundle\Model\ListDeptPeer;
use CoreBundle\Model\ListPosPeer;
use CoreBundle\Model\EmpTimePeer;
use CoreBundle\Model\ListIpPeer;

use CoreBundle\Model\EmpAcc;
use CoreBundle\Model\EmpAccQuery;

use CoreBundle\Model\EmpTimeQuery;
use CoreBundle\Model\EmpTime;


//-------------------------FOR ADMIN------------------------------------
class DefaultController extends Controller{
	// public $id;

    public function timeInOut($id){
		//time in/out information
		$datatime = EmpTimePeer::getTime($id);
		$timename = '';

		if(isset($datatime) && !empty($datatime)){
			$currenttime = sizeof($datatime) - 1;
			$timein_data = $datatime[$currenttime]->getTimeIn();
			$timeout_data = $datatime[$currenttime]->getTimeOut();
			if(!is_null($timein_data) && !is_null($timeout_data)){
				echo 'WORKING 1';
				$timename = true;
			}else if(!is_null($timein_data) && is_null($timeout_data)){
				echo 'WORKING 2';
				$timename = false;
			}				
		} else if(isset($datatime) && empty($datatime)){
			echo 'WORKING 3';
			$timename = true;
		}
		return $timename;    	
    }

    public function indexAction(){
    	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
		header("Pragma: no-cache"); // HTTP 1.0.
		header("Expires: 0"); // Proxies.

    	$user = $this->getUser();
		$page = 'Home';
    	$role = $user->getRole();
    	$id = $user->getId();-

		$timename = self::timeInOut($id);    	

        return $this->render('AdminBundle:Default:index.html.twig', array(
        	'page' => $page,
         	'role' => $role,
        	'user' => $user,
          	'timename' => $timename,
        ));
    }

    public function timeInAction($id){
    	$retval =[];

		//valid ip address
    	$ip_add = ListIpPeer::getValidIP($this->container->get('request')->getClientIp());


    	if(!is_null($ip_add)){
    		$matchedip = $ip_add->getAllowedIp();
    		date_default_timezone_set('Asia/Manila');
    		$current_date = date('Y-m-d H:i:s');
    		$retval[0] = $matchedip;
    		$retval[1] = 0;
    		$retval[2] = $current_date;
    	}else{
    		$retval[0] = '';
    	}


    	//set employee time
    	$empTimeSave = new EmpTime();

    	//var_dump($current_date);
    	//var_dump($matchedip);



    	//employee time in/out
    	$emp_time = EmpTimePeer::getTime($id);

		if(isset($emp_time) && !empty($emp_time)){
			$currenttime = sizeof($emp_time) - 1;
			$timein_data = $emp_time[$currenttime]->getTimeIn();
			$timeout_data = $emp_time[$currenttime]->getTimeOut();
			$id_data = $emp_time[$currenttime]->getId();
			if(!is_null($timein_data) && !is_null($timeout_data)){
				$stat = 'WORKING 1';
				$retval[1] = 1;
		    	$empTimeSave->setTimeIn($current_date);
		    	$empTimeSave->setIpAdd($matchedip);
		    	$empTimeSave->setDate($current_date);
		    	$empTimeSave->setEmpAccAccId($this->getUser()->getId());
		    	$empTimeSave->save();
			}else if(!is_null($timein_data) && is_null($timeout_data)){
				$time_out = EmpTimePeer::retrieveByPk($id_data);

				$stat = 'WORKING 2';
				$retval[1] = 2;
		    	$time_out->setTimeOut($current_date);
		    	$time_out->setIpAdd($matchedip);
		    	$time_out->setDate($current_date);
		    	$time_out->setEmpAccAccId($this->getUser()->getId());
		    	$time_out->save();
			}
		}else{
				$stat = 'WORKING 3';
			$retval[1] = 1;
	    	$empTimeSave->setTimeIn($current_date);
	    	$empTimeSave->setIpAdd($matchedip);
	    	$empTimeSave->setDate($current_date);
	    	$empTimeSave->setEmpAccAccId($this->getUser()->getId());
	    	$empTimeSave->save();
		}


		echo json_encode($retval);
    	exit;
    }

    public function profileAction(){
    	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
		header("Pragma: no-cache"); // HTTP 1.0.
		header("Expires: 0"); // Proxies.

    	$page = 'Profile';

    	//employee account information
    	$user = $this->getUser();
    	$name = $user->getUsername();
    	$role = $user->getRole();
    	$pw = $user->getPassword();
    	$id = $user->getId();

    	// redirect to login page of not admin
		if((strcasecmp($role, 'admin') != 0) && (strcasecmp($role, 'employee') != 0)){
			return $this->redirect($this->generateUrl('login'));
		}

		//employee profile information
		$data = EmpProfilePeer::getInformation($id);

		$fname = $data->getFname();
		$lname = $data->getLname();
		$mname = $data->getMname();
		$bday = $data->getBday();
		$bday = date_format($bday, 'd/m/y');
		$address = $data->getAddress();
		$img = $data->getImgPath();
		$datejoined = $data->getDateJoined();
		$datejoined = date_format($datejoined, 'd/m/y');
		$profileid = $data->getId();
		
		//employee contact information
		$datacontact = EmpContactPeer::getContact($profileid);		
		$contact = '';

		if(!is_null($datacontact)){
			for ($ct = 0; $ct < sizeof($datacontact); $ct++) {
    			// $contactArr[$ct] = $datacontact[$ct]->getContact(); 
				$contacttype =  ListContTypesPeer::getContactType($datacontact[$ct]->getListContTypesId())->getContactType();
				$contactvalue =  $datacontact[$ct]->getContact();
    			$contact .= '<p>Contact:'.$contactvalue.'</p><p>Concact Type:'.$contacttype.'</p>';
   			} 			
		}else{
			$contact = null;
			$contype = null;

			$contact2 = null;
			$contype2 = null;
		}

		//employee work information
		$datawork = EmpWorkPeer::getWork($id);

		if(!is_null($datawork)){
			$workdeptid = $datawork->getListDeptDeptId();
			$workposid = $datawork->getListPosPosId();

			$datadept = ListDeptPeer::getDept($workdeptid);
			$datapos = ListPosPeer::getPos($workposid);

			$deptnames = $datadept->getDeptNames();
			$posnames = $datapos->getPosNames();
		}else{
			$workdeptid = null;
			$workposid = null;

			$deptnames = null;
			$posnames = null;
		}

		$timename = self::timeInOut($id);    	


        return $this->render('AdminBundle:Default:profile.html.twig', array(
        	'page' => $page,
        	'name' => $name,
        	'fname' => $fname,
        	'lname' => $lname,
        	'mname' => $mname,        	
        	'bday' => $bday,
        	'address' => $address,
        	'img' => $img,
         	'datejoined' => $datejoined,
         	'deptnames' => $deptnames,
         	'posnames' => $posnames,
         	'user' => $user,
         	'contactArr' => $contact,
         	'timename' => $timename,
         	'role' => $role,
        ));
    }
}