@extends('layouts.app', ['title' => 'Liste des candidats'])

@section('content')
    @livewire('back.candidates.state',['state'=>$state])
@endsection
