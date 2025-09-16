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
                     <p>You have received a bid on <a href="https://www.therelovedmarketplace.com/product-details/{{ $item->uuid }}" style="color: #1a0dab; text-decoration: underline;">
                             {{ $item->item_name }}
                         </a>   item, visit the 'bids received' page under your profile on the reloved website to accept or reject your offer</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
