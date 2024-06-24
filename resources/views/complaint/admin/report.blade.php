@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('breadcrumb-title')
    <h3>Report Summary</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href=""> Report Summary</i></a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.complaint.report.ex') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-12 mb-3" id="daily_month">
                                    <label for="daily_month">Bulan</label>
                                    <select class="form-select" name="daily_month">
                                        <option value="">-- Bulan --</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 mb-3" id="daily_year">
                                    <label for="daily_year">Tahun</label>
                                    <select class="form-select" name="daily_year">
                                        <option value="">-- Tahun --</option>
                                        @for ($i = 22; $i <= 30; $i++)
                                            <option value="20{{ $i }}">20{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <button class="btn btn-danger">Cetak PDF</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
        $(document).ready(function() {
            $('#monthly_year').hide();
            $('#annual_year_start').hide();
            $('#annual_year_end').hide();
        });

        $('#type').on('change', function() {
            let val = $(this).val();
            if (val == 1) {
                $('#daily_month').show();
                $('#daily_year').show();
                $('#monthly_year').hide();
                $('#annual_year_start').hide();
                $('#annual_year_end').hide();
            } else if (val == 2) {
                $('#daily_month').hide();
                $('#daily_year').hide();
                $('#monthly_year').show();
                $('#annual_year_start').hide();
                $('#annual_year_end').hide();
            } else if (val == 3) {
                $('#daily_month').hide();
                $('#daily_year').hide();
                $('#monthly_year').hide();
                $('#annual_year_start').show();
                $('#annual_year_end').show();
            }
        });
    </script>
@endpush
