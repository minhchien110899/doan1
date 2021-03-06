@extends('layouts.main')

@section('content')
    <div class="container" style="margin-bottom: 40px">
        <div class="card">
            <div class="card-header text-center pb-0">
                <h4 class="font-weight-bold">Lịch sử thi</h4>
                <p>"Thang điểm được chấm theo số câu đúng trên tổng số câu hỏi"</p>
            </div>
            <div class="card-body">
                <!-- body -->
                <table class="table table-bordered text-center">
                    <tr>
                        <th scope="col">Stt</th>
                        <th scope="col">Mã đề</th>
                        <th scope="col">Điểm</th>
                        <th scope="col">Thực hiện</th>
                        <th scope="col">Hoàn thành</th>
                        <th scope="col">Hiệu chỉnh</th>
                    </tr>
                    @foreach ($histories as $key => $history)
                        <tr>
                            <td>{{ ++$key }}</td>
                            @if ($history->test_entrance == 2)
							<td>{{ $history->belongsPersonalize() }}-S{{ $history->step()}}</td>
                                {{-- <td>{{ $history->belongsSubjectName() }} step {{ $history->step() }}</td> --}}
                            @else
                                <td>{{ App\TestExam::find($history->testexam_id)->name }}</td>
                            @endif
                            <?php $questionCount = count($history->choose); ?>
                            <td>{{ $history->mark }}/{{ $questionCount }}</td>
                            <td>{{ date('H:i d-m-Y', strtotime($history->created_at)) }}</td>
                            <?php if (!empty($history->time_up)):
                            $minute = round($history->time_up / 60);
                            $second = $history->time_up % 60;
                            $timer = $minute . 'p ' . $second . 's';
                            else:
                            $timer = '';
                            endif; ?>
                            <td>{{ $timer }}</td>
                            <td><a href="/exam/result/detail/{{ $history->id }}" class="btn btn-purple btn-sm">Chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $histories->links() }}
            </div>
        </div>
    </div>
@endsection
