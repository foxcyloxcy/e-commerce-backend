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
                Hi {{ $user->first_name }},
            </p>
          </td>
        </tr>
      </tbody>
    </table>
<table>
    <tbody>
            <tr>
                <td style="padding: 10px; font-size: 20px !important;">
                    <p>Your payment is being processed on the {{ $data->item_name }} item, you can contact the seller now by visiting the seller page on the website. We hope you like your item, if you have any problems with this please contact the seller directly. Thank you for using the reloved platform!</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
