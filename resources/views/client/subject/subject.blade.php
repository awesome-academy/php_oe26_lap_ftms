<div class="single-service">
    <img src="" alt="">
    <h3 class="text-theme-colored">{{ $subject->name }}</h3>
    <p>{{ $subject->description }}</p>
    <br>
    @if ($permiss->first()->status == config('client.user.false'))
        @foreach ($subject->users as $user)
            @if (Auth::user()->id == $user->id)
                <p>
                    {{ trans('layouts.complete') }}
                    {{ ': ' . $user->pivot->process . '/' . $subject->tasks->count() }}
                </p>
                <h4 class="line-bottom mt-20 mb-20 text-theme-colored">{{ trans('layouts.all') }}</h4>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="small">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center font-16 font-weight-600 bg-theme-color-2 text-white" colspan="4">{{ trans('layouts.all') }}</td>
                            </tr>
                            <tr>
                                <th class="col-xs-1">{{ trans('layouts.name') }}</th>
                                <th>{{ trans('layouts.content') }}</th>
                                <th class="col-xs-1">{{ trans('layouts.status') }}</th>
                                <th class="col-xs-1">{{ trans('layouts.comment') }}</th>
                            </tr>
                            <tbody>
                                @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                    @php $status = config('client.user.false') @endphp
                                    @foreach ($task->users as $user)
                                        @if (Auth::user()->id == $user->pivot->user_id)
                                            @if ($user->pivot->status == config('client.user.true'))
                                                <button id="task{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-success text-center btn-report">{{ trans('layouts.completed') }}</button>
                                                @php $status = config('client.user.true') @endphp
                                            @elseif ($user->pivot->status == config('client.user.false'))
                                                <button id="task{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-warning text-center btn-report">{{ trans('layouts.wait') }}</button>
                                                @php $status = config('client.user.true') @endphp
                                            @endif
                                            <div class="modal fade" id="modal{{ $task->id }}">
                                                <div class="modal-dialog bg-white widget border-1px p-30">
                                                    <h5 class="widget-title line-bottom">{{ trans('layouts.report') }}</h5>
                                                    <form method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <textarea name="report" id="report{{ $task->id }}" class="form-control" rows="config('client.row')"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <a type="button" data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.close') }}</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if ($status == config('client.user.false'))
                                        <a id="btn{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-info text-center btn-report">{{ trans('layouts.report') }}</a>
                                        <div class="modal fade" id="modal{{ $task->id }}">
                                            <div class="modal-dialog bg-white widget border-1px p-30">
                                                <h5 class="widget-title line-bottom">{{ trans('layouts.report') }}</h5>
                                                <form class="formReport">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="report" class="form-control" id="report{{ $task->id }}" required placeholder="Enter report ..." rows="config('client.row')"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="task{{ $task->id }}" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.send') }}</button>
                                                        <a data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.close') }}</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    </td>
                                    <td><a id="cmt{{ $task->id }}" data-toggle="modal" data-target="#modalR{{ $task->id }}" class="btn btn-success">{{ trans('layouts.comment') }}</a>
                                        <div class="modal fade" id="modalR{{ $task->id }}">
                                            <div class="modal-dialog bg-white widget border-1px p-30">
                                                <h5 class="widget-title line-bottom">{{ trans('layouts.report') }}</h5>
                                                <form method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="report" id="comment{{ $task->id }}" class="form-control" disabled rows="config('client.row')"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <a type="button" data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.close') }}</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>

