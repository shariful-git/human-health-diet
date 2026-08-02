<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (! $profile) {
            return redirect()->route('profile.edit')->with('info', 'Please complete your health profile first!');
        }

        $pastSevenDays = DailyLog::where('user_id', $user->id)
            ->where('date', '>=', Carbon::now()->subDays(6)->toDateString())
            ->orderBy('date', 'asc')
            ->get();

        $labels = [];
        $caloriesIntake = [];
        $caloriesBurn = [];
        $waterIntake = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $formattedDate = Carbon::parse($date)->format('M d');
            $labels[] = $formattedDate;

            $log = $pastSevenDays->firstWhere('date', $date);

            $caloriesIntake[] = $log ? $log->total_calories_intake : 0;
            $caloriesBurn[] = $log ? $log->total_calories_burn : 0;
            $waterIntake[] = $log ? $log->water_intake_ml : 0;
        }

        return view('reports.index', compact('labels', 'caloriesIntake', 'caloriesBurn', 'waterIntake'));
    }

    // CSV/Excel Export Logic
    public function exportCsv(): StreamedResponse
    {
        $user = Auth::user();
        $logs = DailyLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        $headers = [
            'Content-type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename=health_report_'.now()->format('Y-m-d').'.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Date', 'Total Calories Intake (kcal)', 'Total Calories Burn (kcal)', 'Water Intake (ml)', 'Sleep (hours)', 'Steps', 'Status'];

        $callback = function () use ($logs, $columns) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, $columns);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->date,
                    $log->total_calories_intake,
                    $log->total_calories_burn,
                    $log->water_intake_ml,
                    $log->sleep_hours,
                    $log->steps,
                    $log->is_completed ? 'Completed' : 'Incomplete',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // PDF View Logic (Browser Print Ready Clean Layout)
    public function exportPdf()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $logs = DailyLog::where('user_id', $user->id)->orderBy('date', 'desc')->take(15)->get();

        return view('reports.pdf', compact('user', 'profile', 'logs'));
    }
}
