@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/toastr/toastr.min.css">
@stop
@section('container')
<div class="row">
    <div class="col-12">
            <!-- Notifikasi menggunakan flash session data -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">Member ID</label>
                        <input type="text" class="form-control @error('member_id') is-invalid @enderror" name="member_id"
                            value="{{ old('member_id') }}" placeholder="Masukkan Id Member">

                        <!-- error message untuk member_id -->
                        @error('member_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label id="parent_id">Parent</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">- Pilih -</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->member_id.'-'.$member->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required>

                        <!-- error message untuk nama -->
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </div>
                    
                </form>

            </div>
        </div>
    </div>
</div>
@endsection