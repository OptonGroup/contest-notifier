<?php
    // github:@OptonGroup development
    // tg:@active_botane
    header('Content-type: application/json');
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

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
            if ($best_contest->relativeTimeSeconds < $contest->relativeTimeSeconds && $contest->relativeTimeSeconds < 0){
                $best_contest = $contest;
                $best_contest->status = "OK";
            }
        }
        set_time($best_contest);
    }
    $post_data->contest = $best_contest;
    echo json_encode($post_data);
?>
