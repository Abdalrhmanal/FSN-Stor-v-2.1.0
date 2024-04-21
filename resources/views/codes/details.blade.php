@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $category->type }} الاكواد</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/categories') }}">الصفحة الرئيسية</a></li>
                    <li><span>/{{ $category->type }} / الاكواد</span></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row align-items-top">
                {{-- ترتيب الأكواد بشكل عشوائي --}}
                @php
                    $shuffledCodes = $codes->shuffle();
                @endphp
                
                {{-- عرض أول كود غير مسجل --}}
                
                @foreach ($shuffledCodes as $index => $code)
                    @if (!$code->isRecorded() && !$code->purchased)
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->type }}</h5>
                                    <p class="card-text">{ * * * * * * * * * * * * * }</p>
                                    <p class="card-text">{{ $category->price }}<span><i class="fa fa-turkish-lira"></i></span></p>
                                   @if (Auth::user() && Auth::user()->role_id == 2)
                                        @if ($category->price > $creditBalanceUser)
                                            <h5 style="color: red;">ليس لديك ما يكفي من الرصيد لشراء هذا الكود</h5>
                                        @elseif($code->isRecorded())
                                            <h5 style="color: red;">حاول ثانيتا هناك ضغط على شراء هذه الفئة</h>
                                        @else
                                            <div id="liveAlertPlaceholder"></div>
                                            <a href="{{ route('addtocoderecord.create', $code->id) }}" class="btn btn-primary purchase-btn" id="purchase-btn" onclick="handlePurchase(event)">شراء الكود</a>
                                            @break
                                        @endif
                                    @endif

                                    @can('is-admin')
                                        <!-- زر الحذف -->
                                        <form action="{{ route('codes.destroy', $code->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">حذف الكود</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                            {{-- انهاء الحلقة بمجرد عرض كود واحد --}}
                            @break
                        </div>
                    @endif
                @endforeach
            </div>
            {{-- إذا لم يكن هناك أكواد --}}
            @if (count($shuffledCodes) === 0)
                <div class="col-lg-12">
                    <h5 style="color: red">لا يوجد أكواد من فئة {{ $category->type }} حاليًا، ستتوفر قريبًا بإذن الله.</h5>
                </div>
            @endif
        </section>
        
        <!-- Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">تأكيد الشراء</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>اهدأ يا نقرة وحدة بتكفي</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                @if (session('code_purchased'))
                    <span>اضغط <a href="{{ route('code_management.index') }}" onclick="refreshPage()">هنا</a> لعرض الأكواد.</span>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </main>

    <script>
        // عرض الرسالة بعد تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'block';
            }
        });

        var isPurchaseClicked = false;

        function handlePurchase(event) {
            if (!isPurchaseClicked) {
                isPurchaseClicked = true;

                // اكمال عملية الشراء
                // يمكنك هنا إضافة الكود الخاص بإكمال عملية الشراء

            } else {
                // منع النقر المتعدد
                event.preventDefault();

                // عرض الرسالة المنبثقة
                $('#confirmationModal').modal('show');
            }
        }

        function refreshPage() {
            location.reload();
        }
        
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertTrigger = document.getElementById('purchase-btn')
if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    appendAlert('سيتم شراء الكود جاري المعالجة', 'success')
  })
}
    </script>

@endsection
