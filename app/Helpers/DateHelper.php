<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
   
    //Format Create At
    public static function formatCreatedAt(Carbon $createdAt): string
    {
        if ($createdAt->isToday()) 
        {
            return 'Today, ' . $createdAt->format('h:i A');

        } elseif ($createdAt->isYesterday()) 
        {
            return 'Yesterday, ' . $createdAt->format('h:i A');

        } else 
        {
            return $createdAt->format('M-d-Y, h:i A');
        }

    }

}
