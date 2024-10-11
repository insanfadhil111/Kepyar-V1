<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pju; // assume you have a Pju model
use App\Models\Pju2; // assume you have a Pju model
use App\Models\Pju3; // assume you have a Pju model
use App\Models\Pju4; // assume you have a Pju model
use App\Models\Pju5; // assume you have a Pju model
use App\Models\Pju_all;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use SplTempFileObject;

class PjuController extends Controller
{
    public function index()
    {
        // Return a view or perform some logic here
        $pjuData = Pju_all::latest();
        return view('landingpage.pju', compact('pjuData'));
    }
    
    public function getdata()
    {
        $pjuData = Pju_all::latest()->first();
    

        $data = [
            'daya' => (float) $pjuData->daya,
            'daya_harian' => (float) $pjuData->daya_harian,
            'profit_harian' => (float) $pjuData->profit_harian,
            'daya_total' => (float) $pjuData->daya_total,
            'profit_total' => (float) $pjuData->profit_total,
            'bebas_emisi' => (float) $pjuData->bebas_emisi,
            'updated_at' => $pjuData->updated_at,
        ];
    
        return response()->json($data);
    }   

    public function getDayaHarianWeeklyData()
    {
        // Get the last 7 days
        $startOfDay = Carbon::now()->subDays(7);
        $endOfDay = Carbon::now();
    
        // Get the daily data for the last 7 days
        $data = pju_all::selectRaw('DATE(updated_at) as date, SUM(daya_harian) as total_daya_harian')
                      ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                      ->groupBy('date')
                      ->orderBy('date')
                      ->get();
    
        return response()->json($data);
    }

    // PJU 1

    public function showPju1() {
        $pjuData = Pju::where('id', 1)->get();
        return view('landingpage.pju1', compact('pjuData'));
    }
    
    public function getdata1()
    {
        $pjuData = Pju::latest()->first();
    

        $data = [
            'daya' => (float) $pjuData->daya,
            'daya_harian' => (float) $pjuData->daya_harian,
            'profit_harian' => (float) $pjuData->profit_harian,
            'daya_total' => (float) $pjuData->daya_total,
            'profit_total' => (float) $pjuData->profit_total,
            'bebas_emisi' => (float) $pjuData->bebas_emisi,
            'updated_at' => $pjuData->updated_at,
            'voltage' => $pjuData->arus,
        ];
    
        return response()->json($data);
    }   

    public function getDayaHarianWeeklyData1()
    {
        // Get the last 7 days
        $startOfDay = Carbon::now()->subDays(7);
        $endOfDay = Carbon::now();
    
        // Get the daily data for the last 7 days
        $data = pju::selectRaw('DATE(updated_at) as date, SUM(daya_harian) as total_daya_harian')
                      ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                      ->groupBy('date')
                      ->orderBy('date')
                      ->get();
    
        return response()->json($data);
    }

    // PJU 2

    public function showPju2() {
        $pjuData = Pju2::where('id', 2)->get();
        return view('landingpage.pju2', compact('pjuData'));
    }

    public function getdata2()
    {
        $pjuData = Pju2::latest()->first();
    

        $data = [
            'daya' => (float) $pjuData->daya,
            'daya_harian' => (float) $pjuData->daya_harian,
            'profit_harian' => (float) $pjuData->profit_harian,
            'daya_total' => (float) $pjuData->daya_total,
            'profit_total' => (float) $pjuData->profit_total,
            'bebas_emisi' => (float) $pjuData->bebas_emisi,
            'updated_at' => $pjuData->updated_at,
            'voltage' => $pjuData->arus,
        ];
    
        return response()->json($data);
    }   

    public function getDayaHarianWeeklyData2()
    {
        // Get the last 7 days
        $startOfDay = Carbon::now()->subDays(7);
        $endOfDay = Carbon::now();
    
        // Get the daily data for the last 7 days
        $data = pju2::selectRaw('DATE(updated_at) as date, SUM(daya_harian) as total_daya_harian')
                      ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                      ->groupBy('date')
                      ->orderBy('date')
                      ->get();
    
        return response()->json($data);
    }

    public function showPju3() {
        $pjuData = Pju3::where('id', 3)->get();
        return view('landingpage.pju3', compact('pjuData'));
    }

    public function getdata3()
    {
        $pjuData = Pju3::latest()->first();
    

        $data = [
            'daya' => (float) $pjuData->daya,
            'daya_harian' => (float) $pjuData->daya_harian,
            'profit_harian' => (float) $pjuData->profit_harian,
            'daya_total' => (float) $pjuData->daya_total,
            'profit_total' => (float) $pjuData->profit_total,
            'bebas_emisi' => (float) $pjuData->bebas_emisi,
            'updated_at' => $pjuData->updated_at,
            'voltage' => $pjuData->arus,
        ];
    
        return response()->json($data);
    }   

    public function getDayaHarianWeeklyData3()
    {
        // Get the last 7 days
        $startOfDay = Carbon::now()->subDays(7);
        $endOfDay = Carbon::now();
    
        // Get the daily data for the last 7 days
        $data = pju3::selectRaw('DATE(updated_at) as date, SUM(daya_harian) as total_daya_harian')
                      ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                      ->groupBy('date')
                      ->orderBy('date')
                      ->get();
    
        return response()->json($data);
    }

    //PJU 4 

    public function showPju4() {
        $pjuData = Pju4::where('id', 4)->get();
        return view('landingpage.pju4', compact('pjuData'));
    }

    public function getdata4()
    {
        $pjuData = Pju4::latest()->first();
    

        $data = [
            'daya' => (float) $pjuData->daya,
            'daya_harian' => (float) $pjuData->daya_harian,
            'profit_harian' => (float) $pjuData->profit_harian,
            'daya_total' => (float) $pjuData->daya_total,
            'profit_total' => (float) $pjuData->profit_total,
            'bebas_emisi' => (float) $pjuData->bebas_emisi,
            'updated_at' => $pjuData->updated_at,
            'voltage' => $pjuData->arus,
        ];
    
        return response()->json($data);
    }   

    public function getDayaHarianWeeklyData4()
    {
        // Get the last 7 days
        $startOfDay = Carbon::now()->subDays(7);
        $endOfDay = Carbon::now();
    
        // Get the daily data for the last 7 days
        $data = pju4::selectRaw('DATE(updated_at) as date, SUM(daya_harian) as total_daya_harian')
                      ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                      ->groupBy('date')
                      ->orderBy('date')
                      ->get();
    
        return response()->json($data);
    }

    // PJU 5

    public function showPju5() {
        $pjuData = Pju5::where('id', 5)->get();
        return view('landingpage.pju5', compact('pjuData'));
    }

    public function getdata5()
    {
        $pjuData = Pju5::latest()->first();
    

        $data = [
            'daya' => (float) $pjuData->daya,
            'daya_harian' => (float) $pjuData->daya_harian,
            'profit_harian' => (float) $pjuData->profit_harian,
            'daya_total' => (float) $pjuData->daya_total,
            'profit_total' => (float) $pjuData->profit_total,
            'bebas_emisi' => (float) $pjuData->bebas_emisi,
            'updated_at' => $pjuData->updated_at,
            'voltage' => $pjuData->arus,
        ];
    
        return response()->json($data);
    }   

    public function getDayaHarianWeeklyData5()
    {
        // Get the last 7 days
        $startOfDay = Carbon::now()->subDays(7);
        $endOfDay = Carbon::now();
    
        // Get the daily data for the last 7 days
        $data = pju5::selectRaw('DATE(updated_at) as date, SUM(daya_harian) as total_daya_harian')
                      ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                      ->groupBy('date')
                      ->orderBy('date')
                      ->get();
    
        return response()->json($data);
    }

    // PJU All

    public function showPjuAll() {
        $pjuData = Pju_all::latest();
        return view('landingpage.pju', compact('pjuData'));
    }

    public function getdataAll()
    {
        $pjuData = Pju_all::latest()->first();
    

        $data = [
            'daya' => (float) $pjuData->daya,
            'daya_harian' => (float) $pjuData->daya_harian,
            'profit_harian' => (float) $pjuData->profit_harian,
            'daya_total' => (float) $pjuData->daya_total,
            'profit_total' => (float) $pjuData->profit_total,
            'bebas_emisi' => (float) $pjuData->bebas_emisi,
            'updated_at' => $pjuData->updated_at,
        ];
    
        return response()->json($data);
    }   

    public function getDayaHarianWeeklyDataAll()
    {
        // Get the last 7 days
        $startOfDay = Carbon::now()->subDays(7);
        $endOfDay = Carbon::now();
    
        // Get the daily data for the last 7 days
        $data = pju_all::selectRaw('DATE(updated_at) as date, SUM(daya_harian) as total_daya_harian')
                      ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                      ->groupBy('date')
                      ->orderBy('date')
                      ->get();
    
        return response()->json($data);
    }

    public function exportCsv()
    {
        // Ambil data monitoring terakhir
        $data = DB::table('pju')
            ->select('daya_total', 'profit_total', 'bebas_emisi', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Buat file CSV
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(['Total Energi', 'Total Profit', 'Total Emisi', 'Tanggal']);

        foreach ($data as $row) {
            $csv->insertOne([
                $row->daya_total,
                $row->profit_total,
                $row->bebas_emisi,
                $row->created_at,
            ]);
        }

        // Output file CSV
        $filename = 'monitoring_data.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        return response((string) $csv, 200, $headers);
    }
}