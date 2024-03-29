<?php 
class Utils{
	public static function readJson($file, $flag=true){
		$conf = file_get_contents('json/'.$file.'.json');
   		$json = json_decode($conf,true);
   		return $json;
	}
	public static function validateQuantity($total, $q){
		$setting = self::readJson('settings');

		$t = floatval($total);

		$var = 'percent_qp_'.$q;

		switch($q){
			case '1':
				return floatval($t);
				break;
			case '2':
			case '3':
			case '4':
				return floatval($t) - (floatval($t) * $setting[$var]);
				break;
			default: 
				return floatval($t) - (floatval($t) * $setting['percent_qp_more']);
				break;
		}
	}
	public static function calculatePercent($percent, $total){
		$finalTotal = $total;
		if(isset($percent) && !empty($percent) && $percent != "-" && $percent != "0"){
			$floatPercent = floatval($percent);
			// if($floatPercent<0){
				$finalTotal = $finalTotal + ($finalTotal * ($floatPercent / 100));
			// }
		}
		return self::format_price($finalTotal);
	}
	public static function format_date($date, $lng) {
		switch($lng){
			case 'es':
				return date("d/m/Y", strtotime(str_replace('-','/',$date)));
				break;
			case 'en':
				return date("Y-m-d", strtotime(str_replace('/','-',$date)));
				break;
			default:
				return $date;
				break;
		}
	}
	public static function quantityStudents($dataSchool){
		$sql = "SELECT COUNT(*) as total FROM students WHERE idschools = $dataSchool->idschools AND idyears = $dataSchool->idyears AND iddivision = $dataSchool->iddivision AND idshifts = $dataSchool->idshifts";
		$command = Yii::app()->db->createCommand($sql);
		$results = $command->queryAll();
		return $results[0]['total'];

		// return Students::model()->count('idschools=:idschools', array(':idschools'=>$idschool));
	}

	public static function unique_multidim_array($array, $key) {
	    $temp_array = array();
	    $i = 0;
	    $key_array = array();
	   
	    foreach($array as $val) {
	        if (!in_array($val[$key], $key_array)) {
	            $key_array[$i] = $val[$key];
	            $temp_array[$i] = $val;
	        }
	        $i++;
	    }
	    return $temp_array;
	}

	public static function calculatePercentTicket($total, $q) {
		$setting = self::readJson('settings');

		$t = floatval($total);

		$var = 'percent_f_'.$q;

		switch($q){
			case '4':
			case '5':
			case '6':
				return floatval($t) + (floatval($t) * $setting[$var]);
				break;
			default: 
				return floatval($t);
				break;
		}
	}

	public static function statusPaid($data) {
		$setting = self::readJson('settings');

		$ticket = Tickets::model()->findAll("idorders=:idorders", array(":idorders"=>$data->idorders));
		$duepaid = 0;
		$firstDatedue = '';
		$duesCanceled = 0;
		// $firstDue = 0;

		foreach($ticket as $i => $t){
			// if($i == 0){
			// 	$firstDatedue = $t->date;
			// 	$firstDue = explode(",", $t->dues);
			// }
			$duepaid = explode(",", $t->dues);
			if($t->canceled){
				$duesCanceled = $duesCanceled + 1;
			}
		}
		$duepaid = $duepaid != 0 ? $duepaid[count($duepaid)-1] : 0;

		$duepaid = $duepaid - $duesCanceled; // le resto las canceladas

		$pills = "<div class='pills-estados'>";

		$date_contract = self::getDateContractOrder($data->idstudents);

		$validate = self::validatExpirationDate($firstDatedue, date("Y-m-d"), $date_contract, $duepaid);

		
		$date = date("d");
		$dateStatus =( intval($date) > $setting['expiration_day'] || intval($date) > date_format(new DateTime($date_contract), "d")) && $validate ? 'Atrasado ' : 'Al día ';

		$color =( intval($date) > $setting['expiration_day'] || intval($date) > date_format(new DateTime($date_contract), "d")) && $validate ? 'color--orange mdl-color-text--grey-900' : 'background-color--primary';

		switch(self::calculatePercentDue($duepaid, $data->dues)){
			case "-1";
					if(!$data->out_production){
						$pills .= '<span class="label label--mini color--red">Falta Financiación</span>';
					}
				break;
			case "0";
					if(!$data->out_production){
						$pills .= '<span class="label label--mini color--red">Impago</span>';
					}
				break;
			case "25":
					if(!$data->out_production){
						$pills .= '<span class="label label--mini '.$color.'">'.$dateStatus.$duepaid.'/'.$data->dues.'</span>';
					}
				break;
			case "75":
			case "50":
					if(!$data->out_production){
						$pills .= '<span class="label label--mini '.$color.'">'.$dateStatus.$duepaid.'/'.$data->dues.'</span>';
						$pills .= '<span class="label label--mini color--green">'.$data->status.'</span>';
					}
				break;
			case "100";
					$pills .= '<span class="label label--mini mdl-color--indigo-500">Pagado</span>';
					if($data->status != 'Pedido' && $data->status != "Terminado"){
						$pills .= '<span class="label label--mini color--green">'.$data->status.'</span>';
					}
				break;
			default:
					if(!$data->out_production){
						$pills .= '<span class="label label--mini '.$color.'">'.$dateStatus.$duepaid.'/'.$data->dues.'</span>';
					}
				break;
		}

		if($data->out_production){
			$pills .= '<span class="label label--mini color--red">Fuera de producción</span>';
		}

		$pills .= "</div>";
		return $pills;
	}

	public static function validatExpirationDate($firstDate, $actualDate, $date_contract, $lastDuesPaid){
		$date1 = date_create($firstDate);
		$date2 = date_create($actualDate);
		$date3 = date_create($date_contract);

		$diff = date_diff($date1, $date2);
		$diff2 = date_diff($date3, $date2);

		if($diff->format("%m") < $lastDuesPaid && $lastDuesPaid >= $diff2->format("%m")){
			return false;
		}
		return true;
	}

	public static function getDateContractOrder($idstudents){
		$students = Students::model()->findByPk($idstudents);
		$sql = "SELECT date_contract FROM promos WHERE promos.idschools = $students->idschools AND promos.idyears = $students->idyears AND promos.iddivision = $students->iddivision AND promos.idshifts = $students->idshifts AND promos.year_promo = $students->graduation_year";

		$command = Yii::app()->db->createCommand($sql);
		$results = $command->queryAll();

		return $results[0]['date_contract'];

	}

	public static function calculatePercentDue($duepaid, $duetotal) {
		$percent = "";
		
		if(intval($duepaid) == floatval(100 * intval($duetotal) / 100) && intval($duetotal) != 0){
			$percent = "100";
		}else if(intval($duepaid) >= floatval(75 * intval($duetotal) / 100) && intval($duetotal) != 0){
			$percent = "75";
		}else if(intval($duepaid) >= floatval(50 * intval($duetotal) / 100) && intval($duetotal) != 0){
			$percent = "50";
		}else if(intval($duepaid) >= floatval(25 * intval($duetotal) / 100) && intval($duetotal) != 0){
			$percent = "25";
		}else if(intval($duepaid) == 0 && intval($duetotal) != 0){
			$percent = "0";
		}else if(intval($duetotal) == 0){
			$percent = "-1";
		}

		return $percent;

	}

	public static function renderStatusPaid(){
		return '<span class="label label--mini color--green">Pagado</span>';;
	}

	public static function renderSwitch($data){
		$ticket = Tickets::model()->findAll("idorders=:idorders", array(":idorders"=>$data->idorders));
		$duepaid = 0;
		$duesCanceled = 0;

		foreach($ticket as $t){
			$duepaid = explode(",", $t->dues);
			if($t->canceled){
				$duesCanceled = $duesCanceled + 1;
			}
		}

		$duepaid = $duepaid != 0 ? $duepaid[count($duepaid)-1] : 0;

		$duepaid = $duepaid - $duesCanceled;

		$disaled = self::calculatePercentDue($duepaid, $data->dues) == "100";

		$checked = $data->out_production ? 'checked' : '';

		$html = !$disaled ? '<div style="display:flex; justify-content:center;">
					<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect switch--colored-red" for="out_production_'.$data->idorders.'">
                    	<input type="checkbox" id="out_production_'.$data->idorders.'" data-id="'.$data->idorders.'" class="mdl-switch__input" '.$checked.' onClick="outProduction(this, '.$data->idorders.')">
                	</label>
                </div>' : "";
		return $html;
	}
	public static function renderStudent($data, $withCI=false){
		$ciHtml = $withCI ? "<small style='display:none;'>".$data->idstudents0->ci."</small>" : "";
		$html = "<a href='#' class='color-text--orange' id='".$data->idstudents0->idstudents."'>".$data->idstudents0->name." ".$data->idstudents0->surname." ".$ciHtml."</a>
				<div class='mdl-tooltip mib-tooltip' for='".$data->idstudents0->idstudents."'>
					<strong>Teléfono: </strong>".$data->idstudents0->phone."<br>
					<strong>Email: </strong>".$data->idstudents0->email."<br>
				</div>";
		return $html;
	}
	public static function renderSchool($data){
		$school = Schools::model()->findByPk($data->idstudents0->idschools);
		$year = Years::model()->findByPk($data->idstudents0->idyears);
		$division = Divisions::model()->findByPk($data->idstudents0->iddivision);
		$shift = Shifts::model()->findByPk($data->idstudents0->idshifts);

		return $school->name.' - '.$year->year.' - '.$division->division.' - '.$shift->shift. ' - '.$data->idstudents0->graduation_year;
	}
	public static function formatPercent($data, $encode=true){
		if($encode){
			if(strlen($data) > 1){
				$newData = $data;
			}else{
				$newData = '0'.$data;
			}
			// $newData = (strlen($data) > 1) ? $data : '0'.$data;
			return floatval('0.'.$newData);
		}else{
			$newData = str_replace('0.', '', sprintf("%.2f", $data));
			return preg_replace('/^0/', '', $newData); 
		}
	}
	public static function format_price($price, $float=false){
		$newPrice = '';
		if($float){
			$newPrice = number_format($price, 2, '.', '');
		}else{
			$newPrice = number_format($price, 0, '.', '');
		}
		return self::roundUpToAny($newPrice);
	}

	public static function roundUpToAny($n, $x=50) {
		//redondea a multiplos de 50
		return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x; 
	}

	public static function displayStatusExcel($duepaid, $dues){
		if(strrpos($duepaid, ",") === false){
			$lastDuePaid = $duepaid;
		}else{
			$lastDuePaid = preg_split("/,/", $duepaid);
			$lastDuePaid = $lastDuePaid[count($lastDuePaid)-1];
		}

		switch(self::calculatePercentDue($lastDuePaid, $dues)){
			case "-1":
					return "Falta Financiacion";
				break;
			case "0";
					return "Impago";
				break;
			case "25":
					return $lastDuePaid."/".$dues." Pago parcial";
				break;
			case "75":
			case "50":
					return "Produccion";
				break;
			case "100";
					return "Produccion";
				break;
		}
	}
	public static function getTickets($idstudents){
		$html = "";
		$orders = Orders::model()->find('idstudents=:idstudents', array(':idstudents'=>$idstudents));
		if($orders){
			$tickets = Tickets::model()->findAll('idorders=:idorders', array(':idorders'=>$orders->idorders));
			if(count($tickets)>0){
				foreach($tickets as $t => $ticket){
					if($ticket->canceled == "1"){
						$color = "color:#f44336";
					}else{
						$color = "color:#00d45a";
					}
					$html .= "<a class='view ticket-view' style='".$color."' title='Factura N° ".$ticket->idtickets."' onClick='renderTicket(".$ticket->idtickets.")'><span>FN° ".$ticket->idtickets."</span></a>";
				}
			}	
		}
		return $html;

	}
}
