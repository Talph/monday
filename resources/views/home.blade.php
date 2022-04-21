@extends('layouts.app')

@section('content')
<div class="container">
    @include("layouts.alert")
    <div class="row mt-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="row mb-5">
                <div class="col-md-10">
                    <form action="{{route('generate')}}" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                @csrf
                                
                                <input type="text" name="board_id" class="form-control" id="bi" placeholder="237326906">
                                <label for="bi">Boord ID No.</label>
                                <small>Get this detail from monday.com</small>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    
                                    <input type="text" id="colid" name="column_id" class="form-control"
                                        placeholder="time_tracking6">
                                        <label for="colid">Time Tracking ID.</label>
                                    <small>Get this detail from monday.com</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="limit_num" class="form-control" id="lm" placeholder="50">
                                    <label for="lm">Limit.</label>
                                    <small>Number of tasks</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <button class="btn btn-danger">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="{{route('export')}}" class="btn btn-primary float-end">Export</a>
                </div>
            </div>
            <table id="times" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Board Name</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start Date/Time</th>
                        <th scope="col">End Date/Time</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Hours Used</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timings as $index => $time)
                    <tr>
                        <th scope="row">
                            {{ $index +1 }}
                        </th>
                        <td>{{$time->boardname}}</td>
                        <td>{{$time->taskname}}</td>
                        <td>{{$time->subtaskStatus}}</td>
                        <td>{{$time->start_time}}</td>
                        <td>{{$time->end_time}}</td>
                        <td>{{$time->user}}</td>
                        <td>{{$time->task_hours_used}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- {{$timings->links()}} --}}
        </div>
    </div>
</div>
</div>
@endsection

@section("scripts")
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
$('#times').DataTable();
} );
</script>
@endsection