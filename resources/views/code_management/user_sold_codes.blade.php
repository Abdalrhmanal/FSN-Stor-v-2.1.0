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
                    <h5 class="card-title">مبيعات الاكواد</h5>

                    @if ($codes->isEmpty())
                        <p>لا يوجد اكواد حاليا.</p>
                    @else
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col"><center> # </center></th>
                                    <th scope="col"><center>  الكود </center></th>
                                    <th scope="col"><center>  الفئة</center> </th>
                                    <th scope="col"><center></center>   السعر </th>
                                    <th scope="col"><center> تا ريخ الشراء</center></th>
                                    <th scope="col"><center> ا لمندوب</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ترتيب السجلات حسب أحدث تاريخ --}}
                                @php
                                    $sortedCodes = $codes->sortByDesc('created_at');
                                @endphp

                                @foreach ($sortedCodes as $index => $codeRecord)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td><a href="#" class="text-primary clipboard-btn" data-clipboard-text="{{ $codeRecord->code->code }}">{{ $codeRecord->code->code }}</a></td>
                                        <td>{{ $codeRecord->code->category->type }}</td>
                                        <td>{{ $codeRecord->code->category->price }} <i class="fa fa-turkish-lira"></i></td>
                                        <td>{{ $codeRecord->created_at }}</td>
                                        <td><a href="{{ route('users.index')}}">{{ $codeRecord->user->name }}</a></td>
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
