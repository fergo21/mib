<?php 
class Utils{
	public static function readJson($file, $flag=true){
		$conf = file_get_contents('json/'.$file.'.json');
   		$json = json_decode($conf,true);
   		return $json;
	}
	public static function validateQuantity($total, $q){
		$t = floatval($total);
		switch($q){
			case '1':
				return floatval($t);
				break;
			case '2':
				return floatval($t) - (floatval($t) * 0.03);
				break;
			case '3':
				return floatval($t) - (floatval($t) * 0.06);
				break;
			case '4':
				return floatval($t) - (floatval($t) * 0.09);
				break;
			default: 
				return floatval($t) - (floatval($t) * 0.12);
				break;
		}
	}
	public static function calculatePercent($percent, $total){
		$finalTotal = number_format($total, 2, ".", "");
		if(isset($percent) && !empty($percent) && $percent != "-" && $percent != "0"){
			$floatPercent = floatval(number_format($percent, 2, ".", ""));
			// if($floatPercent<0){
				$finalTotal = $finalTotal + ($finalTotal * ($floatPercent / 100));
			// }
		}
		return number_format($finalTotal, 2, ".", "");
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
		$t = floatval($total);
		switch($q){
			case '4':
				return floatval($t) + (floatval($t) * 0.05);
				break;
			case '5':
				return floatval($t) + (floatval($t) * 0.10);
				break;
			case '6':
				return floatval($t) + (floatval($t) * 0.15);
				break;
			default: 
				return floatval($t);
				break;
		}
	}

	public static function statusPaid($data) {
		$setting = Utils::readJson('settings');

		$ticket = Tickets::model()->findAll("idorders=:idorders", array(":idorders"=>$data->idorders));
		$duepaid = 0;
		$firstDatedue = '';
		$firstDue = 0;

		foreach($ticket as $i => $t){
			if($i == 0){
				$firstDatedue = $t->date;
				$firstDue = explode(",", $t->dues);
			}
			$duepaid = explode(",", $t->dues);
		}
		$duepaid = $duepaid != 0 ? $duepaid[count($duepaid)-1] : 0;

		$pills = "<div class='pills-estados'>";

		$validate = Utils::validatExpirationDate($firstDatedue, date("Y-m-d"), $firstDue, $duepaid);

		$date = date("d");
		$dateStatus = (intval($date) > $setting['expiration_day']) && $validate ? 'Atrasado ' : 'Al día ';

		$color = (intval($date) > $setting['expiration_day']) && $validate ? 'color--orange mdl-color-text--grey-900' : 'background-color--primary';

		switch(Utils::calculatePercentDue($duepaid, $data->dues)){
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
			case "100";
					$pills .= '<span class="label label--mini mdl-color--indigo-500">Pagado</span>';
					if($data->status != 'Pedido' && $data->status != "Terminado"){
						$pills .= '<span class="label label--mini color--green">'.$data->status.'</span>';
					}
				break;
			default:
					if(!$data->out_production){
						$pills .= '<span class="label label--mini '.$color.'">'.$dateStatus.$duepaid.'/'.$data->dues.'</span>';
						$pills .= '<span class="label label--mini color--green">'.$data->status.'</span>';
					}
				break;
		}

		if($data->out_production){
			$pills .= '<span class="label label--mini color--red">Fuera de producción</span>';
		}

		$pills .= "</div>";
		return $pills;
	}

	public static function validatExpirationDate($firstDate, $actualDate, $firstDuePaid, $lastDuesPaid){
		$date1 = date_create($firstDate);
		$date2 = date_create($actualDate);

		$diff = date_diff($date1, $date2);

		if($diff->format("%m") < $lastDuesPaid){
			return false;
		}
		return true;
	}

	public static function calculatePercentDue($duepaid, $duetotal) {
		$percent = "";
		
		if($duepaid == floatval(100 * intval($duetotal) / 100)){
			$percent = "100";
		}else if($duepaid >= floatval(75 * intval($duetotal) / 100)){
			$percent = "75";
		}else if($duepaid >= floatval(50 * intval($duetotal) / 100)){
			$percent = "50";
		}else if($duepaid >= floatval(25 * intval($duetotal) / 100)){
			$percent = "25";
		}else{
			$percent = "0";
		}

		return $percent;

	}

	public static function renderStatusPaid(){
		return '<span class="label label--mini color--green">Pagado</span>';;
	}

	public static function renderSwitch($data){
		$ticket = Tickets::model()->findAll("idorders=:idorders", array(":idorders"=>$data->idorders));
		$duepaid = 0;

		foreach($ticket as $t){
			$duepaid = explode(",", $t->dues);
		}

		$duepaid = $duepaid != 0 ? $duepaid[count($duepaid)-1] : 0;

		$disaled = Utils::calculatePercentDue($duepaid, $data->dues) == "100";

		$checked = $data->out_production ? 'checked' : '';

		$html = !$disaled ? '<div style="display:flex; justify-content:center;">
					<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect switch--colored-red" for="out_production_'.$data->idorders.'">
                    	<input type="checkbox" id="out_production_'.$data->idorders.'" data-id="'.$data->idorders.'" class="mdl-switch__input" '.$checked.'>
                	</label>
                </div>' : "";
		return $html;
	}
	public static function renderStudent($data){
		$html = "<a href='#' class='color-text--orange' id='".$data->idstudents0->idstudents."'>".$data->idstudents0->name." ".$data->idstudents0->surname."</a>
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
			return floatval('0.'.$data);
		}else{
			return str_replace('0.', '', sprintf("%.2f", $data)); 
		}
	}
}