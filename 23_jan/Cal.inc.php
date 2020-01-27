<?php
session_start();

class Calender {

    function validate($userMonth, $userYear) {
        if(($userMonth > 0 && $userMonth <= 12) && ($userYear > 1900 && $userYear <= 2099)) {
            return true;
        } else {
            return false;
        }
    }

    function setSessionData($userMonth, $userYear) {
        $_SESSION['userMonth'] = $userMonth;
        $_SESSION['userYear'] = $userYear;
    }

    function getSessionData() {
        if(isset($_SESSION['userMonth']) && isset($_SESSION['userMonth'])) {
            $sessionData['setMonth'] = $_SESSION['userMonth'];
            $sessionData['setYear'] = $_SESSION['userYear'];
            return $sessionData;
        }
    }

    function getCalender($userMonth, $userYear) {
        $startDate = getdate(mktime(0,0,0,$userMonth,1,$userYear));
        $endDate = date('t', strtotime($userYear . "-" . $userMonth));
        echo "<table border='1  '>";
        echo "<tr bgcolor='lightgrey'><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>";
        for($i=0;$i<$startDate['wday'];$i++){
            echo '<td>&nbsp;</td>';
        }

        for($i = 1; $i <= $endDate; $i++) {
            $data = getdate(mktime(0,0,0,$userMonth,$i,$userYear));
            echo "<td>".$data['mday']."</td>";
            $startDate['wday']++;
            if($startDate['wday'] % 7 == 0) {
                echo "</tr><tr>";
            }       
        }
        echo "</table>";
    }
}


?>