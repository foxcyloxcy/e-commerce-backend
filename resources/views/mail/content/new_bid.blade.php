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
                    <p>Your {{ $item->item_name}} received a bid of {{ $bid->asking_price }}.</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
