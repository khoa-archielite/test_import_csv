@extends('frontend.layouts.base')
@section('content')
    <div class="container">
        <h1 class="mt-3 text-center">{{ __('Start Import file') }}</h1>
        <form action="{{ route('csv.store') }}" class="mt-3" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="import_csv" class="form-label">{{ __('Import user from csv') }}</label>
                <input type="file" class="form-control" name="csv_file" id="import_csv">
                <div id="csvHelpText" class="form-text">{{ __('Import file csv') }}</div>
                @error('csv_file')
                <span class="d-block invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
