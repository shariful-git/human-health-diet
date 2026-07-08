<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Health Progress Report - {{ $user->name }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
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

<body class="bg-gray-50 font-sans p-8">

    <div
        class="no-print max-w-4xl mx-auto mb-6 flex justify-between items-center bg-gray-800 text-white p-4 rounded-xl shadow">
        <span class="text-sm">📄 Print Preview ready. Press Ctrl+P or Click Print to Save as PDF.</span>
        <div class="flex gap-2">
            <button onclick="window.print()"
                class="bg-emerald-500 hover:bg-emerald-600 px-4 py-1.5 text-xs font-bold rounded-lg transition">Print /
                Save PDF</button>
            <a href="{{ route('reports.index') }}"
                class="bg-gray-600 hover:bg-gray-700 px-4 py-1.5 text-xs font-bold rounded-lg transition">Back</a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-8 border border-gray-100 rounded-2xl shadow-sm">
        <div class="flex justify-between items-start border-b pb-6">
            <div>
                <h1 class="text-2xl font-black text-gray-800 tracking-tight">HUMAN HEALTH DIET SYSTEM</h1>
                <p class="text-sm text-gray-400 mt-1">Personal Progress Assessment Report</p>
            </div>
            <div class="text-right text-sm text-gray-500">
                <p><strong>Generated On:</strong> {{ now()->format('M d, Y') }}</p>
                <p><strong>User ID:</strong> #{{ $user->id }}</p>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4 my-6 p-4 bg-gray-50 rounded-xl">
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold">Name</p>
                <p class="text-sm font-bold text-gray-800">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold">BMI</p>
                <p class="text-sm font-bold text-gray-800">{{ $profile->bmi }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold">Daily Target</p>
                <p class="text-sm font-bold text-gray-800">{{ $profile->daily_calorie_target }} kcal</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold">Fitness Goal</p>
                <p class="text-sm font-bold text-emerald-600 capitalize">{{ str_replace('_', ' ', $profile->goal) }}</p>
            </div>
        </div>

        <h3 class="text-md font-bold text-gray-700 mb-3">📋 Historical Log Summary (Last 15 Records)</h3>
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="p-3 rounded-l-lg">Date</th>
                    <th class="p-3">Intake (kcal)</th>
                    <th class="p-3">Burned (kcal)</th>
                    <th class="p-3">Water (ml)</th>
                    <th class="p-3">Steps</th>
                    <th class="p-3 rounded-r-lg">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($logs as $log)
                    <tr class="hover:bg-gray-50/50">
                        <td class="p-3 font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($log->date)->format('M d, Y') }}</td>
                        <td class="p-3 text-rose-600 font-bold">{{ $log->total_calories_intake }}</td>
                        <td class="p-3 text-orange-600 font-bold">{{ $log->total_calories_burn }}</td>
                        <td class="p-3 text-blue-600 font-bold">{{ $log->water_intake_ml }} ml</td>
                        <td class="p-3 text-gray-600">{{ $log->steps }}</td>
                        <td class="p-3">
                            <span
                                class="text-xs px-2 py-0.5 font-bold rounded-full {{ $log->is_completed ? 'bg-green-50 text-green-600' : 'bg-amber-50 text-amber-600' }}">
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
