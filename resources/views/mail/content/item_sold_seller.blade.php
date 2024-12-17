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
                    <p>Congratulations your item has been sold and the buyer now has your details and will be in contact to arrange collection. If you do not hear from them within 48 hours feel free to contact our support team hello@therelovedmarketplace.com</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection