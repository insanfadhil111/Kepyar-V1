<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pju;
use App\Models\Pju2;
use App\Models\Pju3;
use App\Models\Pju4;
use App\Models\Pju5;
use App\Models\Pju_all;
use Log;

class PjuAllController extends Controller
{
    public function collectData()
    {
        Log::info('collectData method called');

        $pjus = [
            Pju::latest()->take(1)->get(),
            Pju2::latest()->take(1)->get(),
            Pju3::latest()->take(1)->get(),
            Pju4::latest()->take(1)->get(),
            Pju5::latest()->take(1)->get(),
        ];

        $data = [];
        $totalDaya = 0;
        $totalDayaHarian = 0;
        $profit = 0;
        $dayaTotal = 0;
        $profitTotal = 0;
        $emisi = 0;

        foreach ($pjus as $pju) {
            foreach ($pju as $item) {
                $data[] = [
                    'daya' => $item->daya,
                    'daya_harian' => $item->daya_harian,
                    // 'arus' => $item->arus,
                    'profit_harian' => $item->profit_harian,
                    'daya_total' => $item->daya_total,
                    'bebas_emisi' => $item->bebas_emisi,
                ];
                $totalDaya += $item->daya;
                $totalDayaHarian += $item->daya_harian;
                $profit += $item->profit_harian;
                $dayaTotal += $item->daya_total;
                $profitTotal += $item->profit_total;
                $emisi += $item->bebas_emisi;
            }
        }

        // Debugging: Check the collected data and totalDaya
        Log::debug('Collected data: ', $data);
        Log::debug('Total daya: ' . $totalDaya);
        Log::debug('profit harian: ' . $profit);
        Log::debug('daya total: ' . $dayaTotal);
        Log::debug('profit total: ' . $profitTotal);

        // Prepare the data to be inserted into pju_all
        $dataToInsert = [
            'daya' => $totalDaya,
            'daya_harian' => $totalDayaHarian,
            'profit_harian' => $profit,
            'daya_total' => $dayaTotal,
            'profit_total' => $profitTotal,
            'bebas_emisi' => $emisi,
            // Add other columns as needed
        ];

        try {
            Pju_all::create($dataToInsert);
            Log::info('Data collected and total daya sent to Pju_all table successfully');
            return response()->json(['message' => 'Data collected and total daya sent to Pju_all table', 'daya', 'profit_harian', 'profit_total', 'bebas_emisi'], 200);
        } catch (\Exception $e) {
            Log::error('Error sending data to Pju_all table: ' . $e->getMessage(), [
                'data' => $dataToInsert,
                'exception' => $e,
            ]);
            return response()->json(['message' => 'Error sending data to Pju_all table', 'error' => $e->getMessage()], 500);
        }
    }
}
