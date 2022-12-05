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
                <form action="{{ route('member.update', $data->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">Member ID</label>
                        <input type="text" class="form-control" name="member_id"
                        value="{{ !empty($data->member_id) ? $data->member_id : '' }}" placeholder="Masukkan Id Member" disabled>
                    </div>

                    <div class="form-group">
                        <label id="parent">Parent</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">- Pilih -</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" {{ ($member->id == $data->parent_id) ? 'selected':'' }}>{{ $member->member_id.'-'.$member->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Nama</label>
                        <input type="text" class="form-control"
                            name="name" value="{{ !empty($data->name) ? $data->name : '' }}" disabled>
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