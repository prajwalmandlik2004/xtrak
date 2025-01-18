@extends('layouts.app', ['title' => "Ajout d'un nouveau candidat"])

@section('content')
    @livewire('back.opportunity.form', ['action' => $action,'candidate'=>$candidate])
@endsection
    