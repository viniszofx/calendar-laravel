<div class="overflow-x-auto">
    <table class="min-w-full bg-white border rounded">
        <thead>
            <tr>
                @foreach($days as $day)
                    <th class="py-2 px-4 border-b">{{ $day }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($weeks as $week)
                <tr>
                    @foreach($week as $date)
                        <td class="py-2 px-4 border-b h-24 align-top">
                            <div class="text-xs text-gray-500">{{ $date->format('d/m') }}</div>
                            @foreach($appointments->where('date', $date->toDateString()) as $appointment)
                                <div class="mt-1 p-1 bg-blue-100 rounded text-xs">
                                    {{ $appointment->title }}
                                </div>
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
