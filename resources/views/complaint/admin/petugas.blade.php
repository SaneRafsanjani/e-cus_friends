@extends('layouts.landing.master')

@section('content')
    <main id="main">
        <section class="contact" style="margin-top: 100px">
            <div class="container">
                <div class="row">
                    {{-- <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <p>Form Pengaduan</p>
                    </header> --}}
                    <div class="col-xl-12 contact">
                        <div id="add_complaint_error_message"></div>
                        <form action="" method="post" id="add_petugas">
                            <div class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                data-aos-delay="200">
                                <h5 class="text-center fw-bold mb-3">Data Petugas</h5>
                                <div class="row gy-4">
                                    <div class="form-group col-md-6 mb-2 mt-4">
                                        <label for="report_name">Petugas</label>
                                        <select class="form-control" name="pelaksana" id="pelaksana">
                                            <option value="">---- Pilih Petugas ----</option>
                                            @foreach ($petugas as $p)
                                                <option value="{{ $p->NAMA_PETUGAS }}">{{ $p->NAMA_PETUGAS }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input class="form-control" id="reported_name" type="text" name="reported_name"> --}}
                                    </div>
                                    {{-- <select class="form-select" name="type" id="type">
                                        <option value="1">Harian</option>
                                        <option value="2">Bulanan</option>
                                        <option value="3">Tahunan</option>
                                    </select> --}}
                                </div>
                                <button class="mt-4" type="submit" id="add_complaint_button">Submit</button>
                                <div class="mt-3" id="add_complaint_loading" role="status" style="color: #1c9285"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('after-script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/script-landing.js') }}"></script>
@endpush
