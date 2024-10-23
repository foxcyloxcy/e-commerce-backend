@extends('mail.layout.default')

@section('title')
    @lang('New Bid')
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
                     <p>You have received a bid on {{ $item->item_name}}  item, visit the 'bids received' page under your profile on the reloved website to accept or reject your offer</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
