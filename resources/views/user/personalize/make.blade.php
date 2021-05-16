@extends('layouts.main')

@section('content')
    <style>
        td {
            padding: 0 !important;
        }

        .w3-modal-content {
            top: -8%;
            font-size: 15px;
        }
        .selectRow{
            display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px #e6e6e6 solid;
    line-height: 60px;
        }
        .custom-select{
            width: 100px;
            border-radius: 24px;
        }
    </style>
    <button class="btn time_exam btn-warning px-0" id="time">30:00</button>
    <script>
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;
                $('#countDown').val(timer);
                if (--timer < 0) {
                    $("button[name=complete]").click();
                }
            }, 1000);
        }

        window.onload = function() {
            var thirtyMinutes = 60 * 30,
                display = document.querySelector('#time');
            startTimer(thirtyMinutes, display);
        };

    </script>

    <div class="container w3-round-large w3-border py-2 mb-3">
        <div class="container">
            <div class="card my-3">
                <div class="card-header text-center">
                    <h4 class="text-uppercase mb-0">{{ $testexam->name }}</h4>
                    <h6 class="text-uppercase my-1">Bài kiểm tra tổng hợp để đánh giá khách quan trình độ</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/personalizeDetail', $testexam->id) }}" method="POST" id="personalizeForm">
                        @csrf
                        <input type="hidden" id="countDown" name="countDown" value="">
                        @if (count($questions) > 0)

                            @foreach ($questions as $key => $question)
                                <input type="hidden" name="questionChoose[]" value="{{ $question->id }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h6 class="font-weight-bold">Câu {{ ++$key }}: {{ $question->content }}
                                            </h6>
                                            <?php
                                            $options = $question->option->name;
                                            shuffle($options);
                                            ?>
                                            @foreach ($options as $option)
                                                <label class="radio-inline">
                                                    <input type="radio" name="choose[{{ $question->id }}]"
                                                        value="{{ $option }}">
                                                    {{ $option }}
                                                </label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endif
                        @if (count($questions) > 0)
                            <div class="text-center"><button type="submit" class="btn btn-outline-warning" name="complete"
                                    id="makePersonalize">Nộp bài</button></div>
                        @else
                            <p>Quản lý đang soạn câu hỏi.Vui lòng chọn đề khác</p>
                        @endif
                    </form>
                </div>
            </div>
            <a href="{{ url('/personalizeElearning/init') }}" style="margin-bottom: 30px !important;">&larr; Quay lại</a>
        </div>
    </div>
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-round py-3 w-75">
            <div class="w3-container">
                {{-- <span onclick="document.getElementById('id01').style.display='none'"
            class="w3-button w3-display-topright" style="font-size: 25px;line-height: 24px;z-index:1;">&times;</span> --}}
                    <div class="container w-75">
                        <h3 class="text-center">Kết quả kiểm tra:</h3>
                        <div class="row w-75" style="margin: 0 auto">
                            <div class="col-6 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-12 col-xl-6 text-left font-weight-bold">Điểm:</div>
                                    <div class="col-12 col-xl-6 text-left" id="mark"></div>
                                    <div class="col-12 col-xl-6 text-left font-weight-bold">Thời gian làm:</div>
                                    <div class="col-12 col-xl-6 text-left" id="time_up"></div>
                                    <div class="col-12 col-xl-6 text-left font-weight-bold">Số câu đúng:</div>
                                    <div class="col-12 col-xl-6 text-left text-success" id="correctQuestion"></div>
                                    <div class="col-12 col-xl-6 text-left font-weight-bold">Số câu sai:</div>
                                    <div class="col-12 col-xl-6 text-left text-danger" id="wrongQuestion"></div>
                                </div>
                            </div>
                            <div class="col-6 text-center mb-1">
                                <img src="/images/drawing.svg" width="93px">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-bordered" id="myTable">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col">Câu hỏi</th>
                                            <th scope="col">Trả lời</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered" id="myTable1">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col">Câu hỏi</th>
                                            <th scope="col">Trả lời</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <footer class="w3-container d-flex justify-content-end">
                        <button class="w3-btn w3-round-large w3-medium btn-primary w3-padding-small mr-1" onclick="$('#id01').hide();$('#id02').show();">Tiếp&gt;&gt; </button>
                </footer>
            </div>
        </div>
    </div>
    <div id="id02" class="w3-modal">
        <div class="w3-modal-content w3-animate-left w3-round py-3 w-50" >
            <div class="w3-container px-0">
                {{-- <span onclick="document.getElementById('id01').style.display='none'"
            class="w3-button w3-display-topright" style="font-size: 25px;line-height: 24px;z-index:1;">&times;</span> --}}
                    <div class="container px-0">
                        <h5 class="text-center font-weight-bold">Đề xuất lộ trình:</h5>
                        <div class="px-3"><small style="opacity: 0.5;font-size:11px">Hệ thống dựa vào kết quả đầu vào của bạn và đề xuất lộ trình mong muốn bạn đạt kết quả tốt nhất sau khi kết thúc.</small></div>
                        <form action="/personalizeDetail/create" method="post" style="border-bottom: 1px #e6e6e6 solid;margin-bottom: 15px;">
                            @csrf
                            <input type="hidden" name="history_id">
                            <div class="selectRow px-3">
                                <div>Số bài:</div>
                                <select name="exam_number" class="custom-select custom-select-sm">
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="selectRow px-3">
                                <div>Thời gian hoàn thành:</div>
                                <select name="expired_time" class="custom-select custom-select-sm">
                                    <option value="5">5 ngày</option>
                                    <option value="6">6 ngày</option>
                                    <option value="7">7 ngày</option>
                                </select>
                            </div>
                            <div class="selectRow px-3">
                                <div>Số điểm mong muốn(khoảng):</div>
                                <select name="expect_mark" class="custom-select custom-select-sm">
                                    <option value="5">~5 điểm</option>
                                    <option value="6">~6 điểm</option>
                                    <option value="7">~7 điểm</option>
                                    <option value="8">~8 điểm</option>
                                    <option value="9">~9 điểm</option>
                                    <option value="10">10 điểm</option>
                                </select>
                            </div>
                            <input type="submit" id="submitBtn2" style="display: none">
                        </form>
                        <div class="row d-flex justify-content-center">
                            <img src="/images/superhero.svg" width="100px">
                        </div>
                        <div class="row d-flex justify-content-center mt-2">
                            <h5 class="text-uppercase text-success">Click "lưu" để xây dựng lộ trình !</h5>
                        </div>
                    </div>
                    <footer class="w3-container d-flex justify-content-center">
                        <button class="w3-btn w3-round-large w3-medium btn-primary w3-padding-small mr-1" onclick="$('#submitBtn2').click()">Lưu</button>
                        <a href='/personalizeElearning/init' class="w3-btn w3-round-large w3-medium btn-secondary w3-padding-small">Hủy</a>    
                </footer>
            </div>
        </div>
    </div>
    <script src="{{ url('/js/jquery-3.3.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("form#personalizeForm").on('submit', function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        document.getElementById('id01').style.display = 'block';
                        $('#time').hide();
                        console.log(data);
                        var history = data.history;
                        var result = data.check_result;
                        //chuyền history_id vào 
                        $('input[name="history_id"]').val(history.id);
                        //check số lượng số câu hỏi đúng và sai 
                        var counts = {};
                        result.forEach(function(x) {
                            counts[x] = (counts[x] || 0) + 1;
                        });
                        var correctQuestion = counts[1] ? counts[1] : 0;
                        //câu trả lời đúng
                        $('#correctQuestion').text(correctQuestion + " Câu");
                        var wrongQuestion = counts[0] ? counts[0] : 0;
                        //Câu trả lời sai
                        $('#wrongQuestion').text(wrongQuestion + " Câu");
                        //Điểm kt
                        var mark = (parseInt(history.mark)) * 10 / 30;
                        mark = mark.toFixed(2);
                        $('#mark').text(mark + " Điểm");
                        var minutes = parseInt(history.time_up / 60, 10);
                        var seconds = parseInt(history.time_up % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;
                        $('#time_up').text(`${minutes}:${seconds}`);
                        // console.log(result);
                        var question15First = result.slice(0, 15);
                        var question15Final = result.slice(15, 30);
                        const range = (start, end, step = 1) => {
                            let output = [];
                            if (typeof end === 'undefined') {
                                end = start;
                                start = 0;
                            }
                            for (let i = start; i < end; i += step) {
                                output.push(i);
                            }
                            return output;
                        };
                        console.log(question15First);
                        console.log(question15Final);
                        question15First.forEach(function(val, index) {
                            i = range(1, 16, 1);
                            // console.log(index);
                            if (i[index] < 10) {
                                i[index] = "0" + i[index];
                            }
                            if (val == 1) {
                                $('#myTable > tbody:last-child').append(
                                    '<tr><td class="text-center">' + i[index] +
                                    '</td><td class="text-center"><i class="fas fa-check-circle text-success"></i></td></tr>'
                                    );
                            } else {
                                $('#myTable > tbody:last-child').append(
                                    '<tr><td class="text-center">' + i[index] +
                                    '</td><td class="text-center"><i class="fas fa-times-circle text-danger"></i></td></tr>'
                                    );
                            }
                        });
                        question15Final.forEach(function(val, index) {
                            i = range(16, 31, 1);
                            if (val == 1) {
                                $('#myTable1 > tbody:last-child').append(
                                    '<tr><td class="text-center">' + i[index] +
                                    '</td><td class="text-center"><i class="fas fa-check-circle text-success"></i></td></tr>'
                                    );
                            } else {
                                $('#myTable1 > tbody:last-child').append(
                                    '<tr><td class="text-center">' + i[index] +
                                    '</td><td class="text-center"><i class="fas fa-times-circle text-danger"></i></td></tr>'
                                    );
                            }

                        });
                    }
                });
            });
        });

    </script>
@endsection
