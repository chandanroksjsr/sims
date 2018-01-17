@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Request Form
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('request') }}">Request</a></li>
	    <li class="active">Approval</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <form method="post" action="{{ route('request.approve', $request->id) }}" class="form-horizontal" id="requestForm">
        
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('request.action-form')

      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection