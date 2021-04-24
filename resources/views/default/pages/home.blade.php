@extends('layouts.master')
@section('content')
<form id="frm-logout" action="{{ route('logout') }}" method="post" style="display: inline;">
  @csrf
 <app :auth="{{ json_encode(auth()->check()) }}" :user="{{ json_encode($user) }}"></app>
@endsection



