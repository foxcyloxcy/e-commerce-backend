@extends('mail.layout.default')

@section('title')
    @lang('Payment Received')
@endsection

@section('content')
<table>
      <tbody>
        <tr>
          <td style="padding: 10px; font-size: 20px !important;">
            <p>
                Hi {{ $user->name }},
            </p>
          </td>
        </tr>
      </tbody>
    </table>
<table>
    <tbody>
            <tr>
                <td style="padding: 10px; font-size: 20px !important;">
                     <p>Your payment is being processed for {{ $data->item_name }}, as the buyer you are responsible for collecting the item which you can coordinate with the seller.</p><br>
                     <p>If you wish to use a reloved delivery partner you can contact reloved directly.</p><br>
                     <p>We hope you enjoy the item, if you have any issues with this you can contact the seller directly. 
                      Thank you for using the reloved platform.</p>
                    <br>  
                    <hr>
                    <p>Seller Contact Details:</p>
                    <p>Name: {{$data->user->first_name}} {{$data->user->last_name}}</p>
                    <p>Email: {{$data->user->email}} </p>
                    <p>Contact Number: {{$data->user->mobile_number}}</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
