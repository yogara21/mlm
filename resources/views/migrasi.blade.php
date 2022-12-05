@extends('layouts.main')
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Member ID</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1
                        @endphp
                        @forelse ($members as $member)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $member->member_id }}</td>
                            <td>{{ $member->name }}</td>
                            <td><a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-primary">Migrate</a></td>                    
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-danger mb-0">
                                    Data Post belum Tersedia.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection