@extends('layouts.main')

@section('content')
    <style>
        .imgIcon {
            width: 20px;
            margin-top: -20px;
        }

        .wrapBox {
            width: 50%;
            margin: 25px auto;
            border: 1px #b9b9b9 solid;
        }

        .wrapBox .rowBox {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f6f5f5;
            height: 50px;
            border-bottom: 1px #b9b9b9 solid;
            padding: 1vh 2vw;
        }

        .wrapBox .rowBox:last-child {
            border-bottom: 0px;
        }

        .wrapProcess {
            width: 80%;
            height: 100px;
            margin: 50px 60px 15px;
        }

        .progressbar {
            counter-reset: step;
        }

        .progressbar li {
            list-style-type: none;
            width: 20%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }

        .progressbar li:before {
            width: 30px;
            height: 30px;
            content: counter(step);
            counter-increment: step;
            line-height: 30px;
            border: 3px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
            font-weight: bold;
        }

        .progressbar li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressbar li:first-child:after {
            content: none;
        }

        .progressbar li.active {
            color: green;
        }

        .progressbar li.active:before {
            border-color: #55b776;
        }

        .progressbar li.active+li:after {
            background-color: #55b776;
        }

        .alertDesc {
            font-size: 11px;
        }

        .spanRed {
            border-radius: 15px;
            border: 1px red solid;
            color: white;
            background: red;
            font-size: 11px;
            padding: 1px 13px;
            margin-left: 5px;
        }

    </style>
    <div class="container w3-round-large w3-border py-2 mb-3">
        <div class="wrapBox">
            <div class="rowBox">
                <div class="title">Lộ trình</div>
                <div class="value font-weight-bold">{{ \App\Subject::find($personalize->subject_id)->name }}</div>
            </div>
            <div class="rowBox">
                <div class="title">Phần trăm hoàn thành</div>
                <div class="value"><?php
                    $mucDo = ($current_step / $personalize->exam_number) * 100;
                    echo round($mucDo);
                    ?> %</div>
            </div>
            <div class="rowBox">
                <div class="title">Số điểm mong muốn</div>
                <div class="value">{{ $personalize->expect_mark }} Điểm</div>
            </div>
            <div class="rowBox">
                <div class="title">Số bài thi</div>
                <div class="value">{{ $personalize->exam_number }} Bài</div>
            </div>
            <div class="rowBox">
                <div class="title">Thời gian kết thúc</div>
                <div class="value">{{ date('H:i d/m/y', strtotime($personalize->expired_time)) }}</div>
            </div>
            <span id="time" style="display: none">{{ strtotime($personalize->expired_time) }}</span>
            <div class="rowBox">
                <div class="title">Thời gian còn</div>
                <div class="value text-warning" id="countDown"></div>
            </div>
        </div>
        <div class="wrapProcess">
            <ul class="progressbar">
                <?php
                $exam_number = $personalize->exam_number;
                if ($exam_number == 3):
                $width = 'width:33%';
                elseif ($exam_number == 4):
                $width = 'width:25%';
                else:
                $width = 'width:20%';
                endif;
                ?>
                @foreach (range(1, $exam_number) as $key => $number)
                    <li style="{{ $width }}" class="@if ($current_step>= $number) {{ 'active' }} @endif">
                        <p>Bài {{ $number }}</p>
                        <p>
                            @if ($current_step >= $number)
                                <img src="/images/checked.svg" class="imgIcon">
                            @else:
                                <img src="/images/timer.svg" class="imgIcon">
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="text-center d-flex justify-content-center">
            <a href="/personalizeDetail/detail/{{ $personalize->id }}/step"><button
                    class="btn btn-info text-center no-border-radius">Play</button></a>
        </div>
        <span class="text-left">Chi tiết</span><span class="spanRed">Từng bài</span>
        <div class="wrapHistory my-4">
            @foreach ($history as $key => $val)
                <div class="card w-50">
                    <div class="card-header">
                        Bài {{ ++$key }}
                    </div>
                    <div class="card-body">
                        <?php
                        $true = $val->mark;
                        $mark = ($true * 10) / 30;
                        $mark = number_format($mark, 2, '.', '');
                        ?>
                        <div class="row">
                            <div class="col-6 text-left">Điểm</div>
                            <div class="col-6 text-right">{{ $mark }} điểm</div>
                            <div class="col-6 text-left">Số câu đúng</div>
                            <div class="col-6 text-right">{{ $val->mark }} câu</div>
                            <div class="col-6 text-left">Thời gian</div>
                            <?php
                              $minute = round(($val->time_up)/60);
                              $second = ($val->time_up)%60;
                            ?>
                            <div class="col-6 text-right">{{$minute}}p {{$second}}s</div>
                        </div>
                        <a href="/personalizeDetail/detail/{{ $personalize->id }}/history/{{$key}}" class="detailExam">Chi Tiết...</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="alertDesc">
            Chú ý: Đối với lộ trình bạn đã tạo thành công, mỗi bài thi sẽ có một mức độ khác nhau dựa trên số điểm mà bạn
            muốn đạt do hệ thống đưa ra.<br> Bài thi cuối chính là bài mang tính chất quyết định quá trình ôn tập của bạn có
            hiệu quả hay không.<br> Vì vậy, bài thi cuối cùng sẽ đánh giá bạn có hoàn thành lộ trình của mình dựa vào mức
            điểm mà bạn đã chọn hoàn thành lộ trình.
            Hãy hoàn thành mục tiêu của mình một cách xuất sắc nhé!
            <br>Chúc bạn may mắn!
        </div>
    </div>
    <script src="{{ url('/js/jquery-3.3.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var expect_time = $('#time').text();
            var expect_time = new Date(expect_time * 1000).getTime();

            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = expect_time - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                //  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("countDown").innerHTML = days + " ngày " + hours + "h-" +
                    minutes + "m";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                }
            }, 1000);
        });

    </script>
@endsection
