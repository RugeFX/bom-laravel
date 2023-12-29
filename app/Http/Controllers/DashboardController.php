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
        $motors = $motor->get();
        $hardcases = $hardcase->get();
        $helmets = $helmet->get();
        $faks = $fak->get();
        $motorItem = $motors->groupBy('bom_code')->map(function ($group) {
            return [
                'name' => $group->first()->bom_code,
                'Total' => $group->count(),
                'ReadyForRent' => $group->where('status', 'Ready For Rent')->count(),
                'OutOfService' => $group->where('status', 'Out Of Service')->count(),
                'InRental' => $group->where('status', 'In Rental')->count(),
            ];
        })->values();
        $hardcaseItem = $hardcases->groupBy('bom_code')->map(function ($group) {
            return [
                "name" => $group->first()->bom_code,
                "Total" => $group->count(),
                "Lost" => $group->where('status', 'Lost')->count(),
                "ReadyForRent" => $group->where('status', 'Ready For Rent')->count(),
                "Scrab" => $group->where('status', 'Scrab')->count(),
                "OutOfService" => $group->where('status', 'Out Of Service')->count(),
                "InRental" => $group->where('status', 'In Rental')->count(),
            ];
        })->values();
        $fakItem = $faks->groupBy('bom_code')->map(function ($group) {
            return [
                "name" => $group->first()->bom_code,
                "Total" => $group->count(),
                "Lost" => $group->where('status', 'Lost')->count(),
                "Complete" => $group->where('status', 'Complete')->count(),
                "Incomplete" => $group->where('status', 'Incomplete')->count(),
                "InRental" => $group->where('status', 'In Rental')->count(),
            ];
        })->values();
        $AllMotorData = [
            "name" => "Motor",
            'Total' => $motor->count(),
            'ReadyForRent' => $motor->where('status', 'Ready For Rent')->count(),
            'OutOfService' => $motor->where('status', 'Out Of Service')->count(),
            'InRental' => $motor->where('status', 'In Rental')->count(),
        ];
        $AllhardcaseData = [
            "name" => "Hardcase",
            "Total" => $hardcase->count(),
            "Lost" => $hardcase->where('status', 'Lost')->count(),
            "ReadyForRent" => $hardcase->where('status', 'Ready For Rent')->count(),
            "Scrab" => $hardcase->where('status', 'Scrab')->count(),
            "OutOfService" => $hardcase->where('status', 'Out Of Service')->count(),
            "InRental" => $hardcase->where('status', 'In Rental')->count(),
        ];
        $helmetItem = $helmets->groupBy('bom_code')->map(function ($group) {
            return [
                "name" => $group->first()->bom_code,
                "Total" => $group->count(),
                "Lost" => $group->where('status', 'Lost')->count(),
                "ReadyForRent" => $group->where('status', 'Ready For Rent')->count(),
                "Scrab" => $group->where('status', 'Scrab')->count(),
                "OutOfService" => $group->where('status', 'Out Of Service')->count(),
                "InRental" => $group->where('status', 'In Rental')->count(),
            ];
        })->values();
        $AllhelmetData = [
            "name" => "Helmet",
            "Total" => $helmet->count(),
            "Lost" => $helmet->where('status', 'Lost')->count(),
            "ReadyForRent" => $helmet->where('status', 'Ready For Rent')->count(),
            "Scrab" => $helmet->where('status', 'Scrab')->count(),
            "OutOfService" => $helmet->where('status', 'Out Of Service')->count(),
            "InRental" => $helmet->where('status', 'In Rental')->count(),
        ];

        $plans = $plan->with(['motorItems', 'hardcaseItems', 'helmetItems', 'fakItems'])->get();
        $planItems = [];
        foreach ($plans as $i => $p) {
            $planItem = [
                "name" => $p->name,
                "Motor" => [
                    "Total" => $p->motorItems->count(),
                    "ReadyForRent" => $p->motorItems->where('status', 'Ready For Rent')->count(),
                    "OutOfService" => $p->motorItems->where('status', 'Out Of Service')->count(),
                    "InRental" => $p->motorItems->where('status', 'In Rental')->count(),
                ],
                "Hardcase" => [
                    "Total" => $p->hardcaseItems->count(),
                    "Lost" => $p->hardcaseItems->where('status', 'Lost')->count(),
                    "Scrab" => $p->hardcaseItems->where('status', 'Scrab')->count(),
                    "ReadyForRent" => $p->hardcaseItems->where('status', 'Ready For Rent')->count(),
                    "OutOfService" => $p->hardcaseItems->where('status', 'Out Of Service')->count(),
                    "InRental" => $p->hardcaseItems->where('status', 'In Rental')->count(),
                ],
                "Helmet" => [
                    "Total" => $p->helmetItems->count(),
                    "Lost" => $p->helmetItems->where('status', 'Lost')->count(),
                    "Scrab" => $p->helmetItems->where('status', 'Scrab')->count(),
                    "ReadyForRent" => $p->helmetItems->where('status', 'Ready For Rent')->count(),
                    "OutOfService" => $p->helmetItems->where('status', 'Out Of Service')->count(),
                    "InRental" => $p->helmetItems->where('status', 'In Rental')->count(),
                ],
                "Fak" => [
                    "Total" => $p->fakItems->count(),
                    "Complete" => $p->fakItems->where('status', 'Complete')->count(),
                    "Incomplete" => $p->fakItems->where('status', 'Incomplete')->count(),
                    "InRental" => $p->fakItems->where('status', 'In Rental')->count(),
                ]
            ];
            $planItems[] = $planItem;
        }
        return response()->json([
            "data" => [
                "Motor" => $motorItem,
                "AllMotor" => [$AllMotorData],
                "Hardcase" => $hardcaseItem,
                "AllHardcase" => [$AllhardcaseData],
                "Fak" => $fakItem,
                "Helmet" => $helmetItem,
                "AllHelmet" => [$AllhelmetData],
                "Plan" => $planItems,
            ],
        ]);
    }
}
