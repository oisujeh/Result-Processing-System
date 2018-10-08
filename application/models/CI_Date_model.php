<?php if (! defined ( 'BASEPATH' ))
    exit ( 'No direct script access allowed' );
class CI_Date_model extends CI_Model {
    public $sec_in_min, $min_in_hour, $hr_in_day, $day_in_wk, $sec_in_wk, $sec_in_day, $min_in_wk, $min_in_day, $hr_in_wk;
    public function __construct() {
        $this->sec_in_min   = 60;
        $this->min_in_hr    = 60;
        $this->hr_in_day    = 24;
        $this->day_in_wk    = 7;
        $this->day_in_yr    = 365;
        $this->sec_in_hr    = $this->sec_in_min * $this->min_in_hr;
        $this->sec_in_wk    = $this->sec_in_min * $this->min_in_hr * $this->hr_in_day * $this->day_in_wk;
        $this->sec_in_day   = $this->sec_in_min * $this->min_in_hr * $this->hr_in_day;
        $this->sec_in_yr    = $this->sec_in_day * $this->day_in_yr;
        $this->sec_in_mo    = $this->sec_in_yr / 12;
        $this->min_in_wk    = $this->min_in_hr  * $this->hr_in_day * $this->day_in_wk;
        $this->min_in_day   = $this->min_in_hr  * $this->hr_in_day;
        $this->hr_in_wk     = $this->hr_in_day  * $this->day_in_wk;
    }
    // *****************************************************************************
    // convert_datetime_to_epoch( $datetime )
    //  -- takes datetime and converts it to seconds since epoch
    // *****************************************************************************
    public function convert_datetime_to_epoch( $datetime = '1971-01-01 12:00:00' ) {
        list( $date, $time ) = explode( ' ', $datetime );
        list( $year, $month, $day) = explode( '-', $date );
        list( $hour, $min, $sec) = explode( ':', $time );
        return mktime( $hour, $min, $sec, $month, $day, $year );
    }
    
    // *****************************************************************************
    // Takes time in seconds since epoch and converts it to a datetime (Y-m-d h:i:s)
    // If not time is given, the current time is used.
    // -----
    // @param   Integer $epoch  The number of seconds since Jan 1 1971 @ 00:00:00.
    // @return  String  Datetime formatted from epoch time.
    // *****************************************************************************
    public function convert_epoch_to_datetime($epoch=false) {
        if(!$epoch) { $epoch = time(); }
        return date('Y-m-d h:i:s',$epoch);
    }
    
    // *****************************************************************************
    // Takes one of those wierd time values from AD/LDAP found in pwdLastSet and
    // stuff like that and converts it to a unix epoch timestamp.
    // -----
    // @param   Integer $ldap_date  Crazy time like this: 129095083680625000
    // @return  Integer             Unix seconds since epoch.
    // *****************************************************************************
    public function convert_ldap_to_epoch($ldap_date=false) {
        if(empty($ldap_date)) return 0;
        $years_from_1601_to_1970 = 1970 - 1601;
        $days_from_1601_to_1970 = $years_from_1601_to_1970 * 365;
        $days_from_1601_to_1970 += ($years_from_1601_to_1970 / 4); // leap years
        $days_from_1601_to_1970 -= 3; // non-leap centuries (1700,1800,1900).  2000 is a leap century
        $seconds_from_1601_to_1970 = $days_from_1601_to_1970 * 24 * 60 * 60;
        $total_seconds_since_1601 = ($ldap_date / 10000000);
        $total_seconds_since_1970 = $total_seconds_since_1601 - $seconds_from_1601_to_1970;
        
        return $total_seconds_since_1970;
    }
    
    // *****************************************************************************
    // Converts a given date/time string and converts it to the ISO 8601 datetime
    // standard. The format is as such: 2004-02-12T15:19:21+00:00.
    // If `$datetime` is empty, the current time is used.
    // -----
    // @param   String  $datetime   The date/time in some 'valid' format to convert.
    // @return  String  ISO 8601 date/time string.
    // *****************************************************************************
    public function convert_to_iso_8601($datetime) {
        if(empty($datetime)) 
            $datetime = time();
        else
            $datetime = strtotime($datetime);
        if($this->is_valid_date($datetime))
            return date('c',$datetime);
        return date('c',0);
    }
    // *****************************************************************************
    // convert_google_to_epoch( $google_time )
    //  -- Converts google date/time format (2009-04-28T10:00:00.000-04:00) to unix time
    // *****************************************************************************
    public function convert_google_to_epoch($google_time='1971-01-01T12:00:00.000-05:00') {
        if(strpos($google_time,'T') === false) {
            // Assume only date is given (yyyy-mm-dd)
            list( $year, $month, $day) = explode( '-', $google_time );
            return mktime( 0,0,0, $month, $day, $year );
        }
        list($date,$time) = explode('T',$google_time);
        list($time,$timezone) = explode('.',$time);
        list( $year, $month, $day) = explode( '-', $date );
        list( $hour, $min, $sec) = explode( ':', $time );
        return mktime( $hour, $min, $sec, $month, $day, $year );
    }
    // *****************************************************************************
    // convert_to_time_ago( $datefrom, $dateto )
    //  -- Tells how long ago a time (in seconds since epoch) occured.
    //      http://www.sajithmr.com/php-time-ago-calculation/
    // *****************************************************************************
    public function convert_to_time_ago( $datefrom, $dateto=-1 ) {
        return $this->convert_to_easy_time( $datefrom, $dateto );
    }
    public function convert_to_easy_time( $datefrom, $dateto=-1,$easy_measure='ago' ) {
        if( $datefrom<=0 ) return "before the 70's... wow...!";
        if( $dateto==-1 ) $dateto = time();
        $difference = $dateto - $datefrom;
        // If difference is less than 60 seconds, seconds is a good interval of choice
        if($difference < 60) {
            $interval = "s";
        }
        // If difference is between 60 seconds and 60 minutes, minutes is a good interval
        elseif($difference >= 60 && $difference<60*60) {
            $interval = "n";
        }
        // If difference is between 1 hour and 24 hours hours is a good interval
        elseif($difference >= 60*60 && $difference<60*60*24) {
            $interval = "h";
        }
        // If difference is between 1 day and 7 days days is a good interval
        elseif($difference >= 60*60*24 && $difference<60*60*24*7) {
            $interval = "d";
        }
        // If difference is between 1 week and 30 days weeks is a good interval
        elseif($difference >= 60*60*24*7 && $difference < 60*60*24*30) {
            $interval = "ww";
        }
        // If difference is between 30 days and 365 days months is a good interval, again, the same thing
        // applies, if the 29th February happens to exist between your 2 dates, the function will return
        // the 'incorrect' value for a day
        elseif($difference >= 60*60*24*30 && $difference < 60*60*24*365) {
            $interval = "m";
        }
        // If difference is greater than or equal to 365days, return year. This will be incorrect if
        // for example, you call the function on the 28th April 2008 passing in 29th April 2007. It will return
        // 1 year ago when in actual fact (yawn!) not quite a year has gone by
        elseif($difference >= 60*60*24*365) {
            $interval = "y";
        }
        // Based on the interval, determine the number of units between the two dates
        // From this point on, you would be hard pushed telling the difference between
        // this function and DateDiff. If the $datediff returned is 1, be sure to return the singular
        // of the unit, e.g. 'day' rather 'days'
        switch($interval) {
            case "m":
                $months_difference = floor($difference / 60 / 60 / 24 /
                29);
                while (mktime(date("H", $datefrom), date("i", $datefrom),
                    date("s", $datefrom), date("n", $datefrom)+($months_difference),
                    date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                        $months_difference++;
                }
                $datediff = $months_difference;
                // We need this in here because it is possible
                // to have an 'm' interval and a months
                // difference of 12 because we are using 29 days
                // in a month
                if($datediff==12) {
                    $datediff--;
                }
                $res = ($datediff==1) ? "$datediff month $easy_measure" : "$datediff months $easy_measure";
                break;
            case "y":
                $datediff = floor($difference / 60 / 60 / 24 / 365);
                $res = ($datediff==1) ? "$datediff year $easy_measure" : "$datediff years $easy_measure";
                break;
            case "d":
                $datediff = floor($difference / 60 / 60 / 24);
                $res = ($datediff==1) ? "$datediff day $easy_measure" : "$datediff days $easy_measure";
                break;
            case "ww":
                $datediff = floor($difference / 60 / 60 / 24 / 7);
                $res = ($datediff==1) ? "$datediff week $easy_measure" : "$datediff weeks $easy_measure";
                break;
            case "h":
                $datediff = floor($difference / 60 / 60);
                $res = ($datediff==1) ? "$datediff hour $easy_measure" : "$datediff hours $easy_measure";
                break;
            case "n":
                $datediff = floor($difference / 60);
                $res = ($datediff==1) ? "$datediff minute $easy_measure" : "$datediff minutes $easy_measure";
                break;
            case "s":
                $datediff = $difference;
                $res = ($datediff==1) ? "$datediff second $easy_measure" : "$datediff seconds $easy_measure";
                break;
        }
        return $res;
    }
    // *****************************************************************************
    // Deducts the given number of seconds from a given datetime and returns the modified
    // MySQL datetime string.
    // -----
    // @param String $datetime - the valid MySQL datetime to be modified
    // @param Integer $seconds - the number of seconds to be deducted from datetime 
    // @hint - use this format for seconds: 2*60*60 (2 hrs * 60 mins * 60 secs), for instance.
    // @Return String - the new datetime with deducted seconds
    // *****************************************************************************
    public function deduct_time_from_datetime($datetime,$seconds) {
        if(is_valid_datetime($datetime)) {
            $time   = (int)$this->convert_datetime_to_epoch($datetime)-(int)$seconds;
            $time   = $this->convert_epoch_to_datetime($time);
            return $time;
        }
        return false;
    }
    
    // ***************************************************************************************
    // Establishes a date range from the most recent previous Sunday to the next-most Saturday.
    // -----
    // @return	Array	- an array containin the start date and end date described above.
    // ***************************************************************************************
    public function get_current_week_range($current_date=false) {
        if($current_date === false) { $current_date = time(); }
        // figure out date range info
        $one_day = 24*60*60;
        $today   = getdate($current_date);
        // Use 1 am so DST spring forward doesn't mess up our date calculation below
        $ts      = mktime(1, 0, 0, $today['mon'], $today['mday'], $today['year']);
        // adjust the timestamp to Sunday
        if($today['wday'] != 0)  {
            $ts -= $today['wday'] * $one_day;
        }
        $start_ts   = $ts; // keep track of the starting timestamp
        $start_date = date("Y-m-d", $ts);
        $end_date   = date("Y-m-d", ( $ts + (6 * $one_day)) );
        $date_range = array('start_date'=>$start_date,'end_date'=>$end_date);
        return $date_range;
    }
    // *****************************************************************************
    // Formats a timestamp (seconds since epoch) to its wordy cousin:
    // "Monday, the 27th of October 2008"
    // -----
    // @param   Unix Timestamp  $when   Either 'now' or a valid unix timestamp.
    // *****************************************************************************
    public function get_formatted_date( $when = 'now' ) {
        if( $when == 'now' ) {
            return date( 'l, \t\h\e jS \of F Y' );
        }
        return date( 'l, \t\h\e jS \of F Y', $when );
    }
    // *****************************************************************************
    // Takes two times (24-hour range, formatted HH:MM) and returns an array
    // of half-hour increments within the two given times
    // -----
    // @param   String  $start_time The time to tart giving 30 minute increments
    // @param   String  $end_time   The time to stop creating 30 minute increments
    // *****************************************************************************
    public function get_half_hour_time_range( $start_time='8:00', $end_time='18:00' ) {
        list( $sh,$sm ) = explode( ':', $start_time );
        list( $eh,$em ) = explode( ':', $end_time );
        $timeRangeArray = array();
        //return ;
        while((int)$sh.$sm < (int)$eh.$em) {
            if($sm == "00") {
                $sm = "30";
            } else {
                $sm = "00";
                $sh = (int)($sh+1);
            }
            $fullTime = date("h:ia",mktime((int)$sh,(int)$sm,0));
            array_push($timeRangeArray,$fullTime);
            if($sh < 10) {
                $sh = "0"+$sh;
            }
        }
        return $timeRangeArray;
    }
    
    // *****************************************************************************
    // Returns the number of work days within the range of a provided start and end
    // date. If no date is provided for either or both dates, defaults will be:
    // -----
    // @default Date    $date1  today -1 week
    // @default Date    $date2  today
    // -----
    // @param   Date    $date1  - should be the start of the date range
    // @param   Date    $date2  - should be the end of the date range.
    // @return array
    // *****************************************************************************
    public function get_num_work_days($date1='',$date2='') {
        if(empty($date1)) {
            $date1 = strtotime(date('Y-m-d', strtotime('-1 week')) . " 00:00:00");
        } else {
            $date1 = strtotime($date1 . " 00:00:00");
        }
        if(empty($date2)) {
            $date2 = strtotime(date('Y-m-d', time()) . " 23:59:59");
        } else {
            $date2 = strtotime($date2 . " 23:59:59");
        }
        
        if($date1 >= $date2) { $end_date = $date1; $start_date = $date2; }
        if($date2 > $date1) { $end_date = $date2; $start_date = $date1; }
        
        //echo "Start Date: {$start_date} (".date('Y-m-d H:i:s',$start_date).") | End Date: {$end_date} (".date('Y-m-d H:i:s',$end_date).")<br />";
        
        $num_days = abs(($end_date - $start_date)) / $this->sec_in_day;
        $num_weekdays = 0;
        for($i=0;$i<=$num_days;$i++) {
            $the_date = date('N',($start_date + ($this->sec_in_day * $i)));
            if($the_date >= 1 && $the_date <= 5)
                $num_weekdays++;
        }
        
        return $num_weekdays;
    }
    
    // ***************************************************************************************
    // Returns the number of seconds in between two dates. Dates provided could be in any
    // parsable date format. There is no inherent order in which the params need to be provided.
    // -----
    // @param   String  $t1     One of the two times in the span
    // @param   String  $t2     One of the two times in the span
    // @return  Integer         The number of seconds between the two times given.
    // ***************************************************************************************
    public function get_time_between($t1=0,$t2=0) {
        $t1 = (preg_match('/^\d{6,}$/',$t1) ? $t1 : strtotime($t1));
        $t2 = (preg_match('/^\d{6,}$/',$t2) ? $t2 : strtotime($t2));
        if($t1 == 0 || $t2 == 0) {
            $t1 = $this->nice_date($t1,'U');
            $t2 = $this->nice_date($t2,'U');
            //error_log("T1: $t1, T2: $t2");
            if(empty($t2) || empty($t1) || $t2 == 'Unknown' || $t1 == 'Unknown')
                return 'Unknown';
        }
        if($t2 >= $t1)
            return ($t2 - $t1);
        return ($t1 - $t2);
    }
    // *****************************************************************************
    // Returns in a human-readable format, the amount of time left between the given 
    // time ($time) and now (time()). If time has already passed, let the user know.
    // -----
    // @param Integer $time - the timestamp that we will compare to now.
    // @Return array
    // *****************************************************************************
    public function get_time_left($time,$day=true,$hr=true,$min=true,$sec=true,$week=false,$month=false,$year=false) {
        $time  = $time - time();
        if($time > 0) {
            $years  = ($year ? floor($time/$this->sec_in_year) : 0);
            $months = (($month || $year == 0) ? floor(($time-($years*$this->sec_in_mo))): 0);
            $weeks  = 0;
            $days   = ($day ? floor($time/$this->sec_in_day) : 0);
            $hours  = (($hr  ||  $days == 0) ? floor(($time-($days*86400))/3600) : 0);
            $mins   = (($min || ($days == 0 && $hours == 0)) ? floor (($time-($days*86400)-($hours*3600))/60) : 0);
            $secs   = (($sec || ($days == 0 && $hours == 0 && $mins == 0)) ? floor ($time-($days*86400)-($hours*3600)-($mins*60)) : 0);
            $expires_in = ($days > 0?"$days days, ":'').($hours > 0?"$hours hours, ":'').($mins > 0?"$mins mins, ":'').($secs > 0?"$secs secs. ":'');
            $expires_in = rtrim($expires_in,',. ').'.';
            return $expires_in;
        } else {
            return 'Time is up!';
        }
    }
    
    // *****************************************************************************
    // A more advanced/elaborate version of get_time_left method.
    // -----
    // @param   Integer $future     The timestamp that we will compare to now.
    // @return  String              Legible amount of time until the $future date.
    // *****************************************************************************
    // $original should be the future date and time in unix format
    public function time_to($future,$options=array(),$bad_wrap=array('<span class="error" style="display:inline">Your item is ',' old!</span>')) {
        $defaults = array(
            'year'  => false,
            'month' => false,
            'week'  => false,
            'day'   => false,
            'hour'  => false,
            'min'   => false,
            'sec'   => true,
        );
        $options = array_merge($defaults,$options);
        if(!isset($this->time_left)) $this->time_left = '';
        // Common time periods as an array of arrays
        if(!isset($this->periods)) {
            $this->periods = array(
                ($options['year']   ? array('year',   $this->sec_in_yr) : false),
                ($options['month']  ? array('month',  $this->sec_in_mo) : false),
                ($options['week']   ? array('week',   $this->sec_in_wk) : false),
                ($options['day']    ? array('day',    $this->sec_in_day): false),
                ($options['hour']   ? array('hour',   $this->sec_in_hr) : false),
                ($options['min']    ? array('minute', $this->sec_in_min): false),
                ($options['sec']    ? array('second', 1): false),
            );
        }
        $today = strtotime(date('Y-m-d',time()) . '00:00:00');
        $since = $future - $today; // Find the difference of time between now and the future
        if($since < 0) return $bad_wrap[0] . $this->convert_to_easy_time($future,-1,'') . $bad_wrap[1];
        // Loop around the periods, starting with the biggest
        if(count($this->periods) > 0) {
            $chunk = array_shift($this->periods);
            if(empty($chunk))
                return $this->time_to($future,$options);
            list($period,$seconds) = $chunk;
            // Find the biggest whole period
            $count = floor($since / $seconds);
            if($count == 0) {
                return $this->time_to($future,$options);
            } else {
                $this->time_left .= ($count == 1 ? "1 {$period}" : "{$count} {$period}s") . ', ';
                return $this->time_to($future - ($count * $seconds),$options);
            }
        } else {
            $time_left = $this->time_left;
            unset($this->time_left);
            unset($this->periods);
            return rtrim($time_left,' ,');
        }
    }
    // ****************************************************************************
    // Basic Description
    // -----
    // @param
    // @return
    // ****************************************************************************
    public function get_weekdays_in_timerange($date1=false,$date2=false) {
        if(!empty($date1) && !empty($date2)) {
            $seconds = $this->get_time_between($date1,$date2);
        } else {
            $seconds = $date1;
        }
        if($this->sec_in_day >= $seconds) {
            if($this->sec_in_hr > $seconds) {
                return 'Less than one work hour';
            } else {
                return round($seconds / $this->sec_in_hr) . ' work hours';
            }
        } else {
            $final = '';
            $days = $seconds / $this->sec_in_day;
            $work_days = $days - (2 * floor($days / 7));
            $remainder = $seconds - (($work_days * $this->sec_in_day) + (2 * floor($days / 7)));
            if($this->sec_in_hr > $remainder) {
                $final = "{$work_days} work days and less than one work hour";
            } else {
                $hours = round($remainder / $this->sec_in_hr) . ' work hours';
                $final = "{$work_days} work days and {$hours} work hours";
            }
        }
    }
    
    // ****************************************************************************
    // Uses Regex to determine if a given string is a valid MySQL datetime stamp.
    // @param String $datetime - the MySQL datetime to be verified
    // @hint - it should be yyyy-mm-dd hh:mm:ss
    // @Return Boolean - true if valid, false if not.
    // *****************************************************************************
    public function is_valid_datetime($datetime) {
        if ( !isset($datetime) ) return false;
        if ( strlen($datetime) != 19 ) return false;
        $array = explode( ' ', $datetime );
        if ( count($array) != 2 ) return false;
        if ( preg_match( '/^(\d\d\d\d)-(\d\d)-(\d\d)$/', $array[0], $matches ) ) {
            if ( !checkdate($matches[2], $matches[3], $matches[1]) ) return false;
        }
        else {
            return false;
        }
        if ( !preg_match( '/^(?:0\d|1\d|2[0-4]):(?:0\d|[1-5]\d):(?:0\d|[1-5]\d)$/', $array[1] ) )
            return false;
        return true;
    }
    
    
    // *****************************************************************************
    // Tests to see if a time is a valid time (and not the epoch). 
    // -----
    // @param   String  $datetime   the MySQL datetime to be verified
    // @return  Boolean             true if valid, false if not.
    // *****************************************************************************
    public function is_valid_date($datetime) {
        if(!isset($datetime)) return false;
        if(!date('U', strtotime($datetime)) == '0')
            return false;
        return true;
    }
    
    // ***************************************************************************************
    // Converts crappy, fake date formats into whatever format you want...
    // ***************************************************************************************
    function nice_date($bad_date='',$format='Y-m-d') {
        if(empty($bad_date))
            return 'Unknown';
        // Date like: YYYYMM
        if(preg_match('/^\d{6}$/',$bad_date)) {
            //echo $bad_date." ";
            if(in_array(substr($bad_date,0,2),array('19','20'))) {
                $year  = substr($bad_date,0,4);
                $month   = substr($bad_date,4,2);
            } else {
                $month  = substr($bad_date,0,2);
                $year   = substr($bad_date,2,4);
            }
            return date($format,strtotime($year . '-' . $month . '-01'));
            
        }
        // Date Like: YYYYMMDD
        if(preg_match('/^\d{8}$/',$bad_date)) {
            $month = substr($bad_date,0,2);
            $day   = substr($bad_date,2,2);
            $year  = substr($bad_date,4,4);
            return date($format,strtotime($month . '/01/' . $year));
        }
        // Date Like: MM-DD-YYYY __or__ M-D-YYYY (or anything in between)
        if(preg_match('/^\d{1,2}-\d{1,2}-\d{4}$/',$bad_date)) { 
            list($m,$d,$y) = explode('-',$bad_date);
            return date($format,strtotime("{$y}-{$m}-{$d}"));
        }
        // Any other kind of string, when converted into UNIX time,
        // produces "0 seconds after epoc..." is probably bad...
        // return "Invalid Date".
        if(!date('U', strtotime($bad_date)) == '0') { 
            return "Invalid Date"; //date($format,strtotime($bad_date));
        }
        // It's probably a valid-ish date format already
        if($format != 'U')
            return date($format,strtotime($bad_date));
        return strtotime($bad_date);
    }
}