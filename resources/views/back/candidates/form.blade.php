@extends('layouts.app')

@section('content')
    @livewire('back.candidates.form', ['action' => $action,'candidate'=>$candidate])
@endsection
    