<div class="single-service">
    <img src="" alt="">
    <h3 class="text-theme-colored">{{ $subject->name }}</h3>
    <p>{{ $subject->description }}</p>
    <h4 class="line-bottom mt-20 mb-20 text-theme-colored">{{ __('All Task') }}</h4>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="small">
            <table class="table table-bordered">
                <tr>
                    <td class="text-center font-16 font-weight-600 bg-theme-color-2 text-white" colspan="4">{{ __('All Task') }}</td>
                </tr>
                <tr>
                    <th class="col-xs-1">{{ __('Name') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th class="col-xs-1">{{ __('Status') }}</th>
                    <th class="col-xs-1">{{ __('Option') }}</th>
                </tr>
                <tbody>
                    @foreach($subject->tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->description }}</td>
                        <td><button class="btn btn-success">{{ __('Finish') }}</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
