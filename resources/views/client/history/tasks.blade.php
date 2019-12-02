<table class="table table-striped table-schedule">
    <thead>
        <tr class="bg-theme-colored">
            <th>{{ trans('layouts.date') }}</th>
            <th>{{ trans('layouts.time') }}</th>
            <th>{{ trans('layouts.event') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($tasksHistory as $task)
        <tr>
            <td><strong>{{ substr($task['date'], config('client.user.false'), config('client.user.dateL')) }}</strong></td>
            <td><em>{{ substr($task['date'], config('client.user.time'), config('client.user.timeL')) }}</em></td>
            <td>{{ $task['content'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
