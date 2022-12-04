@extends('frontend.layouts.base')
@section('content')

    <form action="{{ route('csv.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="import_csv" class="form-label">{{ __('Import user from csv') }}</label>
            <input type="file" class="form-control" name="csv_file" id="import_csv">
            <div id="csvHelpText" class="form-text">{{ __('Import file csv') }}</div>

            <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
        </div>
    </form>
@endsection
