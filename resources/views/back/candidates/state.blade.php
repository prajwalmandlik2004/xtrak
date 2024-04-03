@extends('layouts.app', ['title' => 'BaseCDT '.$state.'s'])

@section('content')
    @livewire('back.candidates.state',['state'=>$state])
@endsection
