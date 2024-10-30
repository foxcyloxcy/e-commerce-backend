@extends('mail.layout.default')

@section('title')
    @lang('Declined')
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
                    <p>Your item has been declined.</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; font-size: 20px !important;">
                    <p>Reason:</p>
                    <p>{{ $data->reject_reason }}</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
