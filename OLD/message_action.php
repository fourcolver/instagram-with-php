<?php

session_start();
require_once('session.php');
$phone = $_GET['phone'];
$name = $_GET['name'];
$msg = $_GET['text'];
$msg = urldecode($msg);
$publishdate = $_GET['publishdate'];
$repeat = $_GET['repeat'];
$repeatFrequency = $_GET['repeatFrequency'];
$repeatUntil = $_GET['repeatUntil'];
$status = $_GET['status'];
?>

<script>
    var timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

</script>

<?php

$timezone_offset_minutes = 330;
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes * 60, false);
date_default_timezone_set($timezone_name);

$date = date("d-m-Y H:i");

$file = getSession();
if ($file != '0') {
    $filename = $file;
} else {
    $filename = "results";
}
if (file_exists('data/' . $filename . '.json')) {
    $jsonString = file_get_contents('data/' . $filename . '.json');
} else {
    $jsonString = '';
}
$data = json_decode($jsonString, true);
$id = 0;
$id = count($data['msg']);

$id1 = $id + 1;
if ($id > 0) {
    $ids = end($data['msg'])['id'];
    $id1 = $ids + 1;
}

if ($repeatUntil != null) {
    $seconds = strtotime($repeatUntil) - strtotime($publishdate);
    if ($seconds > 0) {
        $minutes = $seconds / 60;
    }
    if ($repeatFrequency == 'minute') {
        $frequency = $minutes / $repeat;
    } else if ($repeatFrequency == 'hour') {
        $frequency = intval($minutes / ($repeat * 60));
    } else if ($repeatFrequency == 'day') {
        $frequency = intval($minutes / (intval(24 / $repeat) * 60));
    } else if ($repeatFrequency == 'week') {
        $frequency = intval($minutes / (intval(7 / $repeat) * 24 * 60));
    }
    for ($i = 0; $i <= $frequency; $i++) {
        if ($i > 0) {
            if ($repeatFrequency == 'minute') {
                $newtimestamp = ( strtotime($publishdate) + ( $repeat * 60));
            } else if ($repeatFrequency == 'hour') {
                $newtimestamp = ( strtotime($publishdate) + ( $repeat * 60 * 60));
            } else if ($repeatFrequency == 'day') {
                $newtimestamp = ( strtotime($publishdate) + ( (intval(24 / $repeat) * 60) * 60));
            } else if ($repeatFrequency == 'week') {
                $newtimestamp = ( strtotime($publishdate) + ( (intval(7 / $repeat) * 24 * 60) * 60));
            }
            $publishdate = date("m-d-Y H:i", $newtimestamp);

            // "DD-MM-YYYY hh:mm"
        }
        if ($data['msg'] == null) {
            $msgs[] = array(
                'id' => $id1++,
                'to_number' => $phone,
                'name' => $name,
                'message' => $msg,
                'publishdate' => $publishdate,
                'status' => $status,
                'created_at' => $date,
                'repeat' => $repeat,
                'repeatFrequency' => $repeatFrequency,
                'repeatUntil' => $repeatUntil
            );
            $data['msg'] = $msgs;
        } else {
            array_push($data['msg'], array('id' => $id1++, 'to_number' => $phone, 'name' => $name, 'message' => $msg, 'publishdate' => $publishdate, 'status' => $status, 'created_at' => $date, 'repeat' => $repeat, 'repeatFrequency' => $repeatFrequency, 'repeatUntil' => $repeatUntil));
        }
    }
    $newJsonString = json_encode($data);
    file_put_contents('data/' . $filename . '.json', $newJsonString);
} else {
    if ($id > 0) {
        array_push($data['msg'], array(
            'id' => $id1,
            'to_number' => $phone,
            'name' => $name,
            'message' => $msg,
            'publishdate' => $publishdate,
            'status' => $status,
            'created_at' => $date,
            'repeat' => $repeat,
            'repeatFrequency' => $repeatFrequency,
            'repeatUntil' => $repeatUntil
        ));
    } else {
        $msgs[] = array(
            'id' => $id1,
            'to_number' => $phone,
            'name' => $name,
            'message' => $msg,
            'publishdate' => $publishdate,
            'status' => $status,
            'created_at' => $date,
            'repeat' => $repeat,
            'repeatFrequency' => $repeatFrequency,
            'repeatUntil' => $repeatUntil
        );
        $data['msg'] = $msgs;
    }
    $fp = fopen('data/' . $filename . '.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
}



echo '<script type="text/javascript">window.location="send.php"</script>';
