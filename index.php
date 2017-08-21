<?php
$redis = new Redis();
$redis->connect('192.168.13.233',6379) or die('redis connect error');

if($_GET['act'] == 'qiang'){
	$uid = $_GET['uid'];
	$je = $redis->lpop('hongbao1');
	if($je > 0){
		echo '恭喜'.$uid.'您抢到'.$je.'元';
	}else{
		echo $uid.'您的手也太慢了吧！';
	}
}else{
	$count = 3; //10个红包

	$sum = 100; //100元

	$current = array();


	function do_split($sum , $cnt){
		global $current;
		if($cnt === 1){
			$current[] = $sum;
		}else{
			$ld = 0.01;
			$total = $sum / $ld;
		    $max = round($total / $cnt);
			$min = 1;
			$currWhide = rand($min , 2 * $max);
			$current[] = $jqje = $currWhide * $ld;
			$syje = $sum - $jqje;
			do_split( $syje , $cnt - 1);
		}
		
	}


	do_split($sum , $count);

	var_dump($current);

	foreach ($current as $key => $value) {
		$redis->lpush('hongbao1',$value);
	}

}
