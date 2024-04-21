@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>فلترة</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">الكل</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">اكواد تم شراؤها</h5>

                    @if ($coderecords->isEmpty())
                        <p>لم يتم شراء اكواد حاليا.</p>
                    @else
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col"><center>#</center></th>
                                    <th scope="col"><center>الكود</center></th>
                                    <th scope="col"><center>الفئة</center></th>
                                    <th scope="col"><center>السعر</center></th>
                                    <th scope="col"><center>تاريخ الشراء</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sortedCodes = $coderecords->sortByDesc('created_at');
                                @endphp

                                @foreach ($sortedCodes as $index => $coderecord)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                            <center>
                                                <a href="#" class="text-primary clipboard-btn" data-clipboard-text="{{ $coderecord->code->code }}">{{ $coderecord->code->code }}</a>
                                            </center>
                                        </td>
                                        <td><center>{{ $coderecord->code->category->type }}</center></td>
                                        <td><center>{{ $coderecord->code->category->price }} <i class="fa fa-turkish-lira"></i></center></td>
                                        <td><center>{{ $coderecord->created_at }}</center></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div><!-- End Recent Sales -->
    </main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var clipboard = new ClipboardJS('.clipboard-btn');

        clipboard.on('success', function (e) {
            alert("تم نسخ الكود: " + e.text);
            e.clearSelection();
        });

        clipboard.on('error', function (e) {
            console.error('تعذر النسخ:', e);
        });
    });
</script>

@endsection
