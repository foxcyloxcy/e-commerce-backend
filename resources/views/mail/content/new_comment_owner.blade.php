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
                     <p>You have received a public question on your item {{ $data->item_name }} please visit this item to respond to the potential buyer. </p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
