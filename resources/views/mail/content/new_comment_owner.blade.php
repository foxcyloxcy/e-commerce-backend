@extends('mail.layout.default')

@section('title')
    @lang('New Item Comment')
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
                     <p>You have received a public question on your item <a href="https://www.therelovedmarketplace.com/product-details/{{ $data->uuid }}" style="color: #1a0dab; text-decoration: underline;">
                             {{ $data->item_name }}
                         </a> please visit this item to respond to the potential buyer. </p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
