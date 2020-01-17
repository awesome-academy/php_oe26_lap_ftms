@extends('client.layouts.main')
@section('content')
<div class="main-content">
    <section class="divider bg-lightest">
        <div class="container">
            <div class="section-content text-center">
                <div class="row">
                    <div class="col-md-12">
                        <div id='full-event-calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" id="subject-calendar" value="{{ json_encode($subjectCalendar) }}">
@endsection
