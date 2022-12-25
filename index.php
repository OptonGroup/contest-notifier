// github:@OptonGroup development
// tg:@active_botane

<?php
    function set_time(&$contest){
        $n = -$contest->relativeTimeSeconds;
        $secs = $n%60;
        $mins = ($n/60)%60;
        $hours = ($n/60/60)%24;
        $days = round($n/60/60/24);

        $contest->relativeTime = $days.':'.$hours.':'.$mins.':'.$secs;
    }
    $url = 'https://codeforces.com/api/contest.list?gym=false';
  
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $json = json_decode($response);
    curl_close($ch);

    $post_data = new stdClass();
    $post_data->status = $json->status;

    $best_contest = new stdClass();
    $best_contest->status = "no_contest";
    
    foreach ($json->result as $contest){
        if ($best_contest->status == "CONTEST_NOT_FOUND"){
            $best_contest = $contest;
            $best_contest->status = "OK";
        }else{
            if ($contest->relativeTimeSeconds < 0 && $best_contest->relativeTimeSeconds < $contest->relativeTimeSeconds){
                $best_contest = $contest;
                $best_contest->status = "OK";
            }
        }
        set_time($best_contest);
    }
    $post_data->contest = $best_contest;

	header('Content-type: application/json');
	echo json_encode($post_data);
?>