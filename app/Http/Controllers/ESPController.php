<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Timer;
use App\Models\Pju;
use App\Models\Pju2;
use App\Models\Pju3;
use App\Models\Pju4;
use App\Models\Pju5;
use App\Models\Pju_all;
use App\Http\Controllers\PjuAllController;

class ESPController extends Controller
{
    private $models = [
        1 => Pju::class,
        2 => Pju2::class,
        3 => Pju3::class,
        4 => Pju4::class,
        5 => Pju5::class,
    ];

    private $tarifListrik = 1444;
    private $jamEfektif = 4;

    public function calculateProfit($energi)
    {
        return $energi * $this->tarifListrik;
    }

    public function calculateEmisi($energi)
    {
        // Misalkan daya dalam watt, kita konversi ke kilowatt
        $emisiKarbonDikurangiPerKwh = 3.2;

        return $energi * $emisiKarbonDikurangiPerKwh;
    }

    public function uploadDaya(Request $request, $device)
    {
        $daya = $request->input('daya');
        $arus = $request->input('arus');
        
        if (!is_numeric($daya) || !is_numeric($arus)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }
        
        // Abaikan data jika daya < 0.05
        if ($daya < 0.05) {
            return response()->json(['message' => 'Daya terlalu rendah untuk diproses'], 200);
        }
        
        $model = $this->getModel($device);
        $today = now()->startOfDay();
        $latestRecords = $model::where('created_at', '>=', $today)
                                ->where('daya', '>=', 0.05)
                                ->get();
        $latestRecordTotal = $model::latest()->first();
        
        // Hitung rata-rata daya harian dari data yang ada
        $averageDayaHarian = $latestRecords->avg('daya');
    
        // Hitung energi (kWh) dengan rata-rata daya harian dan jam efektif
        $energi = ($averageDayaHarian * $this->jamEfektif) / 1000;
    
        // Hitung total daya harian
        $totalDayaHarian = $latestRecords->sum('daya_harian') + $energi;
        $totalProfitHarian = $latestRecords->sum('profit_harian');
        
        $profit = $this->calculateProfit($energi);
        $totalDaya = $latestRecordTotal ? $latestRecordTotal->daya_total : 0;
        $totalProfit = $latestRecordTotal ? $latestRecordTotal->profit_total : 0;
        $emisi = $this->calculateEmisi($energi);
        $emisiTotal = $latestRecordTotal ? $latestRecordTotal->bebas_emisi : 0;
        
        $pju = $model::create([
            'daya' => $daya, 
            'daya_harian' => $energi, // Menyimpan energi yang dihitung ke daya_harian
            'arus' => $arus, 
            'profit_harian' => $totalProfitHarian + $profit, 
            'daya_total' => $totalDaya + $energi, 
            'profit_total' => $totalProfit + $profit, 
            'bebas_emisi' => $emisiTotal + $emisi
        ]);
        
        $pjuAllController = new PjuAllController();
        $pjuAllController->collectData();
        
        return response()->json([
            'message' => 'Data received successfully', 
            'daya' => $daya, 
            'arus' => $arus, 
            'profit_harian' => $totalProfitHarian + $profit, 
            'daya_total' => $totalDaya + $energi, 
            'profit_total' => $totalProfit + $profit, 
            'bebas_emisi' => $emisiTotal + $emisi
        ], 200);
    }
    
    public function store(Request $request, $device)
    {
        $daya = $request->input('daya');
        $arus = $request->input('arus');
        
        if (!is_numeric($daya) || !is_numeric($arus)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }
    
        // Abaikan data jika daya < 0.05
        if ($daya < 0.05) {
            return response()->json(['message' => 'Daya terlalu rendah untuk diproses'], 200);
        }
        
        $model = $this->getModel($device);
        $today = now()->startOfDay();
        $latestRecords = $model::where('created_at', '>=', $today)
                                ->where('daya', '>=', 0.05)
                                ->get();
        $latestRecordTotal = $model::latest()->first();
    
        // Hitung rata-rata daya harian dari data yang ada
        $averageDayaHarian = $latestRecords->avg('daya');
    
        // Hitung energi (kWh) dengan rata-rata daya harian dan jam efektif
        $energi = ($averageDayaHarian * $this->jamEfektif) / 1000;
    
        // Hitung total daya harian
        $totalDayaHarian = $latestRecords->sum('daya_harian') + $energi;
        $totalProfitHarian = $latestRecords->sum('profit_harian');
        
        $profit = $this->calculateProfit($energi);
        $totalDaya = $latestRecordTotal ? $latestRecordTotal->daya_total : 0;
        $totalProfit = $latestRecordTotal ? $latestRecordTotal->profit_total : 0;
        $emisi = $this->calculateEmisi($energi);
        $emisiTotal = $latestRecordTotal ? $latestRecordTotal->bebas_emisi : 0;
        
        $pju = $model::create([
            'daya' => $daya, 
            'daya_harian' => $energi, // Menyimpan energi yang dihitung ke daya_harian
            'arus' => $arus, 
            'profit_harian' => $totalProfitHarian + $profit, 
            'daya_total' => $totalDaya + $energi, 
            'profit_total' => $totalProfit + $profit, 
            'bebas_emisi' => $emisiTotal + $emisi
        ]);
        
        $pjuAllController = new PjuAllController();
        $pjuAllController->collectData();
        
        return response()->json([
            'daya' => $daya, 
            'arus' => $arus, 
            'profit_harian' => $totalProfitHarian + $profit, 
            'daya_total' => $totalDaya + $energi, 
            'profit_total' => $totalProfit + $profit, 
            'bebas_emisi' => $emisiTotal + $emisi
        ], 200);
    }


    private function getModel($device)
    {
        if (!isset($this->models[$device])) {
            throw new \Exception('Invalid device');
        }
        
        return $this->models[$device];
    }
    
    public function triggerRelay(Request $request)
    {
        // Ambil pju_id dari parameter GET
        $pju_id = $request->query('pju_id', 1); // Default ke 1 jika tidak ada parameter

        // Ambil data untuk pju_id yang diberikan
        $timer = Timer::where('pju_id', $pju_id)->where('status', 'active')->first();
        
        if ($timer) {
            $condition = $timer->condition ? 1 : 0;
            return response()->json(['condition' => $condition], 200);
        }

        return response()->json(['error' => 'Timer not found or inactive'], 404);
    }

}


