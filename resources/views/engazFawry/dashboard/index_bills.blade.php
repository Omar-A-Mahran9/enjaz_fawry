@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">الفواتير</li>
    </ol>
  </nav>
<div class="aside-row p-2 mb-3">

    <div class="text-right">
      لا توجد فواتير بحسابك حاليا 
    </div>
  
@endsection