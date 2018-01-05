@extends('layouts.report')
@section('title',"$receipt->number")
@section('content')
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
        <tr rowspan="2">
            <th class="text-left" colspan="4">Receipt:  <span style="font-weight:normal">{{ $receipt->number }}</span> </th>
            <th class="text-left" colspan="4">Supplier:  <span style="font-weight:normal">{{ isset($receipt->supplier) ? $receipt->supplier->name : 'Not Set' }}</span> </th>
        </tr>
        <tr rowspan="2">
            <th class="text-left" colspan="4">Invoice:  <span style="font-weight:normal">{{ $receipt->invoice }}</span> </th>
            <th class="text-left" colspan="4">Date Delivered:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($receipt->date_delivered)->toFormattedDateString() }}</span> </th>
        </tr>
        <tr>
        <th class="col-sm-1">Stock Number</th>
        <th class="col-sm-1">Details</th>
        <th class="col-sm-1">Unit</th>
        <th class="col-sm-1">Delivered Quantity</th>
        <th class="col-sm-1">Remaining Quantity</th>
        <th class="col-sm-1">Unit Cost</th>
        <th class="col-sm-1">Amount</th>
      </tr>
    </thead>
    <tbody>
    @if(count($receipt->supplies) > 0)
      @foreach($receipt->supplies as $supply)
      <tr>
        <td>{{ $supply->stocknumber }}</td>
        <td>{{ $supply->details }}</td>
        <td>{{ $supply->unit->name }}</td>
        <td>{{ $supply->pivot->quantity }}</td>
        <td>{{ $supply->pivot->remaining_quantity }}</td>
        <td>{{ $supply->pivot->unitcost }}</td>
        <td>{{ $supply->pivot->quantity * ( isset($supply->pivot->unitcost) && $supply->pivot->unitcost != "" && $supply->pivot->unitcost != null ) ? $supply->pivot->unitcost : 0 }}</td>
      </tr>
      @endforeach
    @else
    <tr>
      <td colspan=7 class="col-sm-12"><p class="text-center">  No record </p></td>
    </tr>
    @endif
    </tbody>
  </table>
</div>
@include('vendor.print_footer')
@endsection