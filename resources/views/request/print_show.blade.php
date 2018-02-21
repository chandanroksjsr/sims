@extends('layouts.report')
@section('title',"$request->code")
@section('content')
  <style>
      th , tbody{
        text-align: center;
      }

      #content{
        font-family: "Arial";
      }

      @media print {
          tr.page-break  { display: block; page-break-after: always; }
      }   

  </style>
  <div id="content" class="col-sm-12">
    <h4 class="text-center">REQUISITION AND ISSUE SLIP <label class="label label-info">{{ $request->status }}</label> <small class="pull-right">Appendix 63</small></h4>
    <table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
          <tr rowspan="2">
              <th class="text-left" colspan="8">Fund Cluster:  <span style="font-weight:normal"></span> </th>
          </tr>
          <tr rowspan="2">

              <th class="text-left" colspan="4">Division:  
                @if($request->office->head_office == null)
                <span style="font-weight:normal">{{ isset($request->office->name) ? $request->office->name : $request->office }}</span> 
                @else
                <span style="font-weight:normal">{{ isset($request->office->headoffice) ? $request->office->headoffice->name : $request->office }}</span> 
                @endif
              </th>
              <th class="text-left" colspan="4">Responsibility Center Code:  <span style="font-weight:normal">{{ isset($request->office->code) ? $request->office->code : $request->office }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="4">Office: 
                @if($request->office->head_office == null)
                <span style="font-weight:normal">N/A</span> 
                @else
                <span style="font-weight:normal">{{ isset($request->office) ? $request->office->name : $request->office }}</span> 
                @endif
              </th>
              <th class="text-left" colspan="4">RIS No.:  <span style="font-weight:normal">{{ $request->code }}</span> </th>
          </tr>
          <tr>
            <th rowspan=2>Stock Number</th>
            <th rowspan=2>Details</th>
            <th rowspan=2>Quantity Requested</th>
            <th class="col-sm-1" colspan=2>Stock Availability</th>
            <th rowspan=2>Quantity Issued</th>
            <th rowspan=2>Remarks</th>
          </tr>
           <tr>
             <th>Yes</th>
             <th>No</th>
           <tr>
      </thead>
      <tbody>
        @foreach($request->supplies as $key=>$supply)
        <tr style="font-size: 12px;" class="{{ ((($key+1) % $row_count) == 0) ? "page-break" : "" }}">
          <td>{{ $supply->stocknumber }}</td>
          <td>
            <span style="font-size:@if(strlen($supply->details) > 50) 7px @elseif(strlen($supply->details) > 40) 9px @elseif(strlen($supply->details) > 20) 10px @else 11px @endif">
              {{ $supply->details }}
            </span>
          </td>
          <td>{{ $supply->pivot->quantity_requested }}</td>
          @if($supply->pivot->quantity_issued > 0 && $request->status == 'approved')
          <td class="text-center"> ✔ </td>
          <td class="text-center">  </td>
          @elseif($supply->pivot->quantity_issued <= 0 && $request->status == 'approved')
          <td class="text-center">  </td>
          <td class="text-center"> ✔ </td>
          @else
          <td class="text-center"></td>
          <td class="text-center">  </td>
          @endif
          <td>{{ $supply->pivot->quantity_issued }}</td>
          <td>{{ $supply->pivot->comments }}</td>
        </tr>
        @endforeach
        <tr>
          <td style="padding: 15px;">***</td>
          <td>***</td>
          <td class="text-center"> **** Nothing Follows *****  </td>
          <td>***</td>
          <td>***</td>
          <td>***</td>
          <td>***</td>
        </tr>
        @for($ctr = 0 ; $ctr < $end; $ctr++)
        <tr>
          <td style="padding: 15px;"></td>
          <td></td>
          <td></td>
          <td class="text-center">  </td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Purpose:
          </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <p class="text-left">{{ $request->purpose }}<p>
            <hr class="col-sm-12" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="footer" class="col-sm-12">
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th class="col-sm-1">   </th>
          <th class="col-sm-1">  Requested By: </th>
          <th class="col-sm-1">  Approved By: </th>
          <th class="col-sm-1">  Issued By: </th>
          <th class="col-sm-1">  Received By: </th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td class="text-center">
            Signature:
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
        </tr>

        <tr>
          <td class="text-center">
            Printed Name:
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ (count($request->requestor) > 0) ? $request->requestor->firstname . " " . $request->requestor->lastname : "" }}</span>
            <br />
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"> Dr. {{ isset($approvedby->head) ? $approvedby->head : "" }}</span>
            <br />
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"></span>
            <br />
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"> </span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
        </tr>

        <tr>
          <td class="text-center">
            Designation:
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;">{{ Auth::user()->position }}, {{ isset($request->office) ? $request->office->code : "" }}</span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;">VPAA, {{ isset($approvedby->name) ? $approvedby->code : "" }}</span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
        </tr>

        <tr>
          <td class="text-center">
            Date:
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
        </tr>


      </tbody>
    </table>

    <div class="col-sm-12" style="font-size: 12px;">
      <legend>Additional Notes</legend>
      <ul>
        <li>
          <p class="text-justified"><strong>Note:</strong>This request is valid for 3 working days upon approval after which, if items are not picked up, the request is automatically <span class="text-danger"> cancelled</span></p> 
        </li>
        <li>
          <p class="text-justified">
            Supplies and Materials will be released <span class="text-danger">only </span> to authorized personnel of the requesting office. Janitors, student assistants and other non-PUP employees may accompany the authorized PUP personnel of ther office and assist in the pick-up and transporting of the requested supplies and materials but are not authorized to recieve and/or laim the said supplies and materials.
          </p>
        </li>
      </ul>
    </div>

  </div>
@endsection