<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Health Progress Report - {{ $user->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
        }

        @media print {
            body {
                background: white;
                color: black;
            }

            .no-print {
                display: none;
            }

            @page {
                margin: 1.5cm;
            }
        }
    </style>
</head>

<body class="bg-slate-50 font-sans p-8">

    <div
        class="no-print max-w-4xl mx-auto mb-6 flex justify-between items-center bg-slate-900 text-white p-4 rounded-none shadow">
        <span class="text-xs font-bold">📄 Print Preview ready. Press Ctrl+P or Click Print to Save as PDF.</span>
        <div class="flex gap-2">
            <button onclick="window.print()"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-1.5 text-xs font-bold rounded-none transition">Print / Save PDF</button>
            <a href="{{ route('reports.index') }}"
                class="bg-slate-700 hover:bg-slate-800 text-white px-4 py-1.5 text-xs font-bold rounded-none transition">Back</a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-8 border border-slate-200 rounded-none shadow-sm">
        <div class="flex justify-between items-start border-b border-slate-200 pb-6">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">HUMAN HEALTH DIET SYSTEM</h1>
                <p class="text-sm text-slate-500 mt-1">Personal Progress Assessment Report</p>
            </div>
            <div class="text-right text-xs font-semibold text-slate-500">
                <p><strong>Generated On:</strong> {{ now()->format('M d, Y') }}</p>
                <p><strong>User ID:</strong> #{{ $user->id }}</p>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4 my-6 p-4 bg-slate-50 rounded-none border border-slate-100">
            <div>
                <p class="text-[10px] text-slate-400 uppercase font-black tracking-wider">Name</p>
                <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 uppercase font-black tracking-wider">BMI</p>
                <p class="text-sm font-bold text-slate-800">{{ $profile->bmi }}</p>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 uppercase font-black tracking-wider">Daily Target</p>
                <p class="text-sm font-bold text-slate-800">{{ number_format($profile->daily_calorie_target) }} kcal</p>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 uppercase font-black tracking-wider">Fitness Goal</p>
                <p class="text-sm font-bold text-emerald-600 capitalize">{{ str_replace('_', ' ', $profile->goal) }}</p>
            </div>
        </div>

        <h3 class="text-sm font-extrabold text-slate-800 mb-3 uppercase tracking-wider">📋 Historical Log Summary (Last 15 Records)</h3>
        <table class="w-full text-left text-xs border-collapse">
            <thead>
                <tr class="bg-slate-100 text-slate-600 uppercase text-[10px] tracking-wider font-black">
                    <th class="p-3 rounded-l-xl">Date</th>
                    <th class="p-3">Intake (kcal)</th>
                    <th class="p-3">Burned (kcal)</th>
                    <th class="p-3">Water (ml)</th>
                    <th class="p-3">Steps</th>
                    <th class="p-3 rounded-r-xl">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($logs as $log)
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-3 font-semibold text-slate-800">
                            {{ \Carbon\Carbon::parse($log->date)->format('M d, Y') }}</td>
                        <td class="p-3 text-rose-600 font-bold font-mono">{{ number_format($log->total_calories_intake) }}</td>
                        <td class="p-3 text-orange-600 font-bold font-mono">{{ number_format($log->total_calories_burn) }}</td>
                        <td class="p-3 text-cyan-600 font-bold font-mono">{{ number_format($log->water_intake_ml) }} ml</td>
                        <td class="p-3 text-slate-600 font-mono">{{ number_format($log->steps) }}</td>
                        <td class="p-3">
                            <span
                                class="text-[10px] px-2.5 py-1 font-bold rounded-full {{ $log->is_completed ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                {{ $log->is_completed ? 'Completed' : 'Incomplete' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
