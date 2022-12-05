@extends('layouts.main')
@section('container')
    <h1>Hitung Bonus</h1>

<div class="row">
    <div class="col-12">
        <form action="{{ route('bonus.show') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-4">
              <label for="parent_id" class="form-label">Parent</label>
              <select name="parent_id" id="parent_id" class="form-select">
                <option value="">- Pilih -</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{ $member->member_id.'-'.$member->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-md btn-primary">Hitung</button>
                </div>
          </form>
    </div>
    @if(isset($parents))
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $parents->name }}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{ $parents->level }}</td>
                            </tr>
                            <tr>
                                <th>Bonus</th>
                                <td> $ {{ $parents->bonus }}</td>
                            </tr>
                    </table>
                </div>

            </div>
        </div>
    @endif
@endsection