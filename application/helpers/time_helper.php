<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Function for getting time_difference
 */
if ( ! function_exists('get_time_diff'))
{
	  function get_time_diff($time1, $time2, $precision = 6)
		{
			if (!is_int($time1))
			{
				$time1 = strtotime($time1);
			}
			if (!is_int($time2))
			{
				$time2 = strtotime($time2);
			}
			if ($time1 > $time2)
			{
				$ttime = $time1;
				$time1 = $time2;
				$time2 = $ttime;
			}
			$intervals = array('year','month','day','hour','minute','second');
			$diffs = array();
			foreach ($intervals as $interval)
			{
				$diffs[$interval] = 0;
				$ttime = strtotime("+1 " . $interval, $time1);
				while ($time2 >= $ttime)
				{
					$time1 = $ttime;
					$diffs[$interval]++;
					$ttime = strtotime("+1 " . $interval, $time1);
				}
			}
			$count = 0;
			$times = array();
			foreach ($diffs as $interval => $value)
			{
				if ($count >= $precision)
				{
					break;
				}
				if ($value > 0)
				{
					if ($value != 1)
					{
						$interval .= "s";
					}
						$times[] = $value . " " . $interval;
						$count++;
						break;
				}
			}
			if(!empty($times))
				$aac = implode(", ", $times).' ago';
			else
				$aac = 'Just now.';
			return $aac;
	  }
}