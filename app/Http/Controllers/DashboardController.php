<?php

namespace App\Http\Controllers;

use App\Models\FakItem;
use App\Models\HardcaseItem;
use App\Models\HelmetItem;
use App\Models\MotorItem;
use App\Models\Plan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $motor = new MotorItem();
        $hardcase = new HardcaseItem();
        $fak = new FakItem();
        $helmet = new HelmetItem();
        $plan = new Plan();
        $motorItem = [
            "Total"=> $motor->count(),
            "Ready For Rent"=>$motor->where('status', 'Ready For Rent')->count(),
            "Out Of Service"=>$motor->where('status', 'Out Of Service')->count(),
            "InRental"=>$motor->where('status', 'In Rental')->count(),
        ];
        $hardcaseItem = [
            "Total"=> $hardcase->count(),
            "Lost"=>$hardcase->where('status', 'Lost')->count(),
            "ReadyForRent"=>$hardcase->where('status', 'Ready For Rent')->count(),
            "Scrab"=>$hardcase->where('status', 'Scrab')->count(),
            "OutOfService"=>$hardcase->where('status', 'Out Of Service')->count(),
            "InRental"=>$hardcase->where('status', 'In Rental')->count(),
        ];
        $fakItem = [
            "Total"=> $fak->count(),
            "Complete"=>$fak->where('status', 'Complete')->count(),
            "Incomplete"=>$fak->where('status', 'Incomplete')->count(),
            "InRental"=>$fak->where('status', 'In Rental')->count(),
        ];
        $helmetItem = [
            "Total"=> $helmet->count(),
            "Lost"=>$helmet->where('status', 'Lost')->count(),
            "ReadyForRent"=>$helmet->where('status', 'Ready For Rent')->count(),
            "Scrab"=>$helmet->where('status', 'Scrab')->count(),
            "OutOfService"=>$helmet->where('status', 'Out Of Service')->count(),
            "InRental"=>$helmet->where('status', 'In Rental')->count(),
        ];

        $plans = $plan->with(['motorItems', 'hardcaseItems', 'helmetItems', 'fakItems'])->get(); 
        $planItems = [];
        foreach ($plans as $i => $p) {
            $planItem = [
                    $i =>[
                        "name"=> $p->name,
                        "Motor"=>[
                            "Total"=> $p->motorItems->count(),
                            "Ready For Rent"=>$p->motorItems->where('status', 'Ready For Rent')->count(),
                            "Out Of Service"=>$p->motorItems->where('status', 'Out Of Service')->count(),
                            "InRental"=>$p->motorItems->where('status', 'In Rental')->count(),
                        ],
                        "Hardcase"=>[
                            "Total"=> $p->hardcaseItems->count(),
                            "Lost"=>$p->hardcaseItems->where('status', 'Lost')->count(),
                            "Scrab"=>$p->hardcaseItems->where('status', 'Scrab')->count(),
                            "Ready For Rent"=>$p->hardcaseItems->where('status', 'Ready For Rent')->count(),
                            "Out Of Service"=>$p->hardcaseItems->where('status', 'Out Of Service')->count(),
                            "InRental"=>$p->hardcaseItems->where('status', 'In Rental')->count(),
                        ],
                        "Helmet"=>[
                            "Total"=> $p->helmetItems->count(),
                            "Lost"=>$p->helmetItems->where('status', 'Lost')->count(),
                            "Scrab"=>$p->helmetItems->where('status', 'Scrab')->count(),
                            "Ready For Rent"=>$p->helmetItems->where('status', 'Ready For Rent')->count(),
                            "Out Of Service"=>$p->helmetItems->where('status', 'Out Of Service')->count(),
                            "InRental"=>$p->helmetItems->where('status', 'In Rental')->count(),
                        ],
                        "Fak"=>[
                            "Total"=> $p->fakItems->count(),
                            "Complete"=>$p->fakItems->where('status', 'Complete')->count(),
                            "Incomplete"=>$p->fakItems->where('status', 'Incomplete')->count(),
                            "InRental"=>$p->fakItems->where('status', 'In Rental')->count(),
                        ]

                    ]
                ];
            $planItems[] = $planItem;
        }
        return [
            "Motor"=> $motorItem,
            "Hardcase"=> $hardcaseItem,
            "Fak"=> $fakItem,
            "Helmet"=> $helmetItem,
            "Plan"=> $planItems,
        ];
    }
}
