@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="container">
            <center>
                <h5 style="margin-top: 10px" "><b>طرق الدفع المعتمدة لدينا</b></h5>
            </center>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="img/Sham.png" class="img-fluid rounded-start" style="max-width: 160px;padding: 10px;" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body" style="margin-left: 20px;">
                              <h5 style="margin-top: 25px;padding: 20px 0 15px 0;
    font-size: 18px;
    font-weight: 500;
    color: #012970;
    font-family: "Cairo", sans-serif;">محفظة شامنا</h5>
                              <p class="card-text"><small class="text-body-secondary">
                                IBAN : 0014666347090002
                                </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="img/Papara.jpg" class="img-fluid rounded-start" style="max-width: 180px;padding: 10px;" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body" style="margin-left: 20px;">
                              <h5 style="margin-top: 25px;padding: 20px 0 15px 0;
    font-size: 18px;
    font-weight: 500;
    color: #012970;
    font-family: "Cairo", sans-serif;">محفظة بابارا</h5>
                              <p class="card-text"><small class="text-body-secondary">
                                IBAN : TR82 0082 9000 0949 1829 0041 95
                                </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="img/ALAmana.jpg" class="img-fluid rounded-start" style="max-width: 160px;padding: 10px;" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body" style="margin-left: 20px;">
                              <h5 style="margin-top: 25px;padding: 20px 0 15px 0;
    font-size: 18px;
    font-weight: 500;
    color: #012970;
    font-family: "Cairo", sans-serif;">محفظة الامانة</h5>
                              <p class="card-text"><small class="text-body-secondary">
                                IBAN : 003545876001
                                </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </main>
@endsection
