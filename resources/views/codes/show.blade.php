@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <!-- إضافة بعض العناصر الأخرى هنا -->

        <!-- إضافة مربع الحوار -->
        <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="purchaseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="purchaseModalLabel">شراء الكود</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>تم شراء الكود بنجاح!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- إضافة بعض العناصر الأخرى هنا -->

    </main>

    <!-- إضافة السكريبت -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'block';
            }

            // عرض مربع الحوار بعد الشراء
            var purchaseModal = document.getElementById('purchaseModal');
            if (purchaseModal) {
                $('#purchaseModal').modal('show');
            }
        });
    </script>

@endsection
