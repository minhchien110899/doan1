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

        .wrapHistory {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    </style>
    <div class="container w3-round-large w3-border py-2 mb-3">
        <div class="wrapBox">
            <div class="rowBox">
                <div class="title">L??? tr??nh</div>
                <div class="value font-weight-bold">{{ \App\Subject::find($personalize->subject_id)->name }}</div>
            </div>
            <div class="rowBox">
                <div class="title">Ph???n tr??m ho??n th??nh</div>
                <div class="value"><?php
                    $mucDo = ($current_step / $personalize->exam_number) * 100;
                    echo round($mucDo);
                    ?> %</div>
            </div>
            <div class="rowBox">
                <div class="title">S??? ??i???m mong mu???n</div>
                <div class="value">{{ $personalize->expect_mark }} ??i???m</div>
            </div>
            <div class="rowBox">
                <div class="title">S??? b??i thi</div>
                <div class="value">{{ $personalize->exam_number }} B??i</div>
            </div>
            <div class="rowBox">
                <div class="title">Th???i gian k???t th??c</div>
                <div class="value">{{ date('H:i d/m/y', strtotime($personalize->expired_time)) }}</div>
            </div>
            <span id="time" style="display: none">{{ strtotime($personalize->expired_time) }}</span>
            <div class="rowBox">
                <div class="title">Th???i gian c??n</div>
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
                        <p>B??i {{ $number }}</p>
                        <p>
                            @if ($current_step >= $number)
                                @if ($number == $personalize->exam_number)
                                    @if ($personalize->check_success() == 1)
                                        <img src="/images/checked.svg" class="imgIcon">
                                    @else
                                        <img src="/images/cancel.svg" class="imgIcon">
                                    @endif
                                @else
                                    <img src="/images/checked.svg" class="imgIcon">
                                @endif
                            @else:
                                <img src="/images/timer.svg" class="imgIcon">
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="text-center d-flex justify-content-center">
            <?php
            $expired_time = strtotime($personalize->expired_time);
            $now = time();
            $distance = $expired_time - $now;
            ?>
            @if ($distance > 0)
                @if ($exam_number == $current_step)
                    @if ($personalize->check_success() == 1)
                        <p class="text-uppercase mb-0 d-flex justify-content-center"
                            style="color: #55b776; font-weight:900; align-items:center;font-size:25px">Ho??n th??nh</p>
                        <img src="/images/happy.svg" width="80px" class="ml-4">
                    @else
                        <p class="text-uppercase mb-0 d-flex justify-content-center"
                            style="color: #ff9811; font-weight:900; align-items:center;font-size:25px">Ch??a ?????t</p>
                        <img src="/images/crying.svg" width="80px" class="ml-4">
                    @endif

                @else
                    <a href="/personalizeDetail/detail/{{ $personalize->id }}/step"><button
                            class="btn btn-info text-center no-border-radius">Play</button></a>
                @endif
            @else
                <button class="btn btn-danger no-border-radius text-white">H???t h???n</button>
            @endif
        </div>
        <span class="text-left">Chi ti???t</span><span class="spanRed">T???ng b??i</span>
        <div class="wrapHistory my-4">
            @if (count($history) > 0)
                @foreach ($history as $key => $val)
                    <div class="card w-50 my-3">
                        <div class="card-header">
                            B??i {{ ++$key }}
                        </div>
                        <div class="card-body">
                            <?php
                            $true = $val->mark;
                            $mark = ($true * 10) / 30;
                            $mark = number_format($mark, 2, '.', '');
                            ?>
                            <div class="row">
                                <div class="col-6 text-left">??i???m</div>
                                <div class="col-6 text-right">{{ $mark }} ??i???m</div>
                                <div class="col-6 text-left">S??? c??u ????ng</div>
                                <div class="col-6 text-right">{{ $val->mark }} c??u</div>
                                <div class="col-6 text-left">Th???i gian</div>
                                <?php
                                $minute = round($val->time_up / 60);
                                $second = $val->time_up % 60;
                                ?>
                                <div class="col-6 text-right">{{ $minute }}p {{ $second }}s</div>
                            </div>
                            <a href="/personalizeDetail/detail/{{ $personalize->id }}/history/{{ $key }}"
                                class="detailExam">Chi Ti???t...</a>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Hi???n t???i b???n ch??a l??m b??i n??o...</p>
            @endif
        </div>
        <div class="alertDesc">
            Ch?? ??: ?????i v???i l??? tr??nh b???n ???? t???o th??nh c??ng, m???i b??i thi s??? c?? m???t m???c ????? kh??c nhau d???a tr??n s??? ??i???m m?? b???n
            mu???n ?????t do h??? th???ng ????a ra.<br> B??i thi cu???i ch??nh l?? b??i mang t??nh ch???t quy???t ?????nh qu?? tr??nh ??n t???p c???a b???n c??
            hi???u qu??? hay kh??ng.<br> V?? v???y, b??i thi cu???i c??ng s??? ????nh gi?? b???n c?? ho??n th??nh l??? tr??nh c???a m??nh d???a v??o m???c
            ??i???m m?? b???n ???? ch???n ho??n th??nh l??? tr??nh.
            H??y ho??n th??nh m???c ti??u c???a m??nh m???t c??ch xu???t s???c nh??!
            <br>Ch??c b???n may m???n!
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
                if(days < 0 && hours < 0 && minutes < 0){
                    days = 0;
                    hours = 0;
                    minutes = 0;
                }
                document.getElementById("countDown").innerHTML = days + " ng??y " + hours + "h-" +
                    minutes + "m";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                }
            }, 1000);
        });

    </script>
@endsection
