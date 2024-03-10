@extends('layouts.app')

@section('content')
    @livewire('back.candidates.show', ['candidate' => $candidate])
@endsection
