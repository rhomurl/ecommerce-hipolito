<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Product;

class ReportService {

    public function get_filter($orders, $data){

        $selected_filter = $data['selected_filter'];
        $month_from = $data['month_from'];
        $month_to = $data['month_to'];
        $year_from = $data['year_from'];
        $year_to = $data['year_to'];
        $date_from = $data['date_from'];
        $date_to = $data['date_to'];
        
        switch($selected_filter) {
            case('date'):

                if($date_from && $date_to){
                    return $orders->whereDate('created_at', '>=', $date_from)
                    ->whereDate('created_at', '<=', $date_to);
                }
                else if($date_from){
                    return $orders->whereDate('created_at', '=', $date_from);

                }
                break;
 
            case('month'):

                if($month_from && $year_from && $year_to && $year_from)
                {
                    return $orders
                    ->whereDate('created_at', '>=', date($year_from.'-'.$month_from.'-01').' 00:00:00')
                    ->whereDate('created_at', '<=', date($year_to.'-'.$month_to.'-31').' 23:59:59');
                }
                else if($month_from && $year_from){
                    return $orders
                    //->whereMonth('created_at', '>=', $month_from)
                    ->whereDate('created_at', '>=', date($year_from.'-'.$month_from.'-01').' 00:00:00')
                    ->whereDate('created_at', '<=', date($year_from.'-'.$month_from.'-31').' 23:59:59');
                }
                   
                    //date('m')
                //$q->whereYear('created_at', '=', date('Y'));
                    
                break;
 
            case('year'):

                if($year_from && $year_to)
                {
                    return $orders
                        ->whereYear('created_at', '>=', date($year_from))
                        ->whereYear('created_at', '<=', date($year_to));
                }
                else if($year_from)
                {
                    return $orders
                    ->whereYear('created_at', '=', date($year_from));
                }
                   
                break;
            default:
                return $orders;
               
            }
    }
}