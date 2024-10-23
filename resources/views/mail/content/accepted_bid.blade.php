@extends('mail.layout.default')

@section('title')
    @lang('Bid Accepted')
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
                    <p>Your offer has been accepted on the {{$data->item_name}} item, you can now go to your profile, pending bids and pay for this item. Once the item has been paid you will receive the sellers details for arranging collection. Thank you for using the reloved platform!</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
