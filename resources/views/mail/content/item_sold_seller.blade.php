@extends('mail.layout.default')

@section('title')
    @lang('Item Sold')
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
                    <p>Congratulations your {{ $data->item_name }} has been sold and the buyer now has your details and will be in contact to arrange collection.</p> <br>
                    <p>Your payment is also being processed to the account details you have provided when creating your profile and will be received in a maximum of 5 working days.</p> <br>
                    <p>If you do not hear from them within 48 hours feel free to contact our support team hello@therelovedmarketplace.com</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
