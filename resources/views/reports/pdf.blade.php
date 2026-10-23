<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Health Progress Report — {{ $user->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        @media print {
            body {
                background: white;
                color: black;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            @page {
                margin: 1.5cm;
            }
        }
    </style>
</head>

<body class="bg-slate-50 font-sans p-8 text-slate-800">

    <div
        class="no-print max-w-4xl mx-auto mb-6 flex justify-between items-center bg-white border border-slate-200 text-slate-800 p-3.5 rounded-lg shadow-2xs">
        <span class="text-xs text-slate-600 font-medium flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            Report ready. Click Print / Save PDF to generate or download document.
        </span>
        <div class="flex gap-2">
            <button onclick="window.print()"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-3.5 py-1.5 text-xs font-medium rounded transition shadow-2xs">Print / Save PDF</button>
            <a href="{{ route('reports.index') }}"
                class="bg-white hover:bg-slate-50 text-slate-700 px-3.5 py-1.5 text-xs font-medium rounded transition border border-slate-300">Back</a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-8 border border-slate-200 rounded-lg shadow-2xs">
        <div class="flex justify-between items-start border-b border-slate-200 pb-5">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded bg-emerald-600 text-white flex items-center justify-center font-bold text-xs">HD</span>
                    <h1 class="text-base font-semibold text-slate-900 tracking-tight">Human Health Diet</h1>
                </div>
                <p class="text-xs text-slate-500">Nutrition & Daily Activity Progress Report</p>
            </div>
            <div class="text-right text-xs text-slate-500">
                <p><span class="font-medium text-slate-700">Generated:</span> {{ now()->format('M d, Y · H:i') }}</p>
                <p><span class="font-medium text-slate-700">User ID:</span> #{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4 my-6 p-4 bg-slate-50 rounded-md border border-slate-200">
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-medium tracking-wider">User Name</p>
                <p class="text-xs font-semibold text-slate-900 mt-0.5">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-medium tracking-wider">BMI</p>
                <p class="text-xs font-semibold text-slate-900 font-mono mt-0.5">{{ $profile->bmi }} kg/m²</p>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-medium tracking-wider">Calorie Target</p>
                <p class="text-xs font-semibold text-slate-900 font-mono mt-0.5">{{ number_format($profile->daily_calorie_target) }} kcal</p>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-medium tracking-wider">Goal</p>
                <p class="text-xs font-semibold text-slate-900 capitalize mt-0.5">{{ str_replace('_', ' ', $profile->goal) }}</p>
            </div>
        </div>

        <h3 class="text-xs font-semibold text-slate-800 mb-2 uppercase tracking-wider">
            Daily Logs (Recent Records)
        </h3>
        <table class="w-full text-left text-xs border border-slate-200 rounded overflow-hidden">
            <thead>
                <tr class="bg-slate-100 text-slate-700 uppercase text-[10px] font-semibold border-b border-slate-200">
                    <th class="p-2.5">Date</th>
                    <th class="p-2.5">Intake (kcal)</th>
                    <th class="p-2.5">Burned (kcal)</th>
                    <th class="p-2.5">Water (ml)</th>
                    <th class="p-2.5">Steps</th>
                    <th class="p-2.5">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach ($logs as $log)
                    <tr class="hover:bg-slate-50">
                        <td class="p-2.5 font-medium text-slate-800 font-mono">
                            {{ \Carbon\Carbon::parse($log->date)->format('M d, Y') }}</td>
                        <td class="p-2.5 text-slate-800 font-mono">{{ number_format($log->total_calories_intake) }}</td>
                        <td class="p-2.5 text-slate-800 font-mono">{{ number_format($log->total_calories_burn) }}</td>
                        <td class="p-2.5 text-slate-800 font-mono">{{ number_format($log->water_intake_ml) }} ml</td>
                        <td class="p-2.5 text-slate-600 font-mono">{{ number_format($log->steps) }}</td>
                        <td class="p-2.5">
                            <span
                                class="text-[10px] px-2 py-0.5 font-medium rounded {{ $log->is_completed ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                {{ $log->is_completed ? 'Completed' : 'Pending' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
