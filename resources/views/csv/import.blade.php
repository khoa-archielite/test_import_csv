@extends('frontend.layouts.base')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <label for="import_csv">{{ __('Import user from csv') }}</label>
        <input type="file" name="csv_file" id="import_csv">
        <input type="submit" value="Submit">
    </form>
@endsection
