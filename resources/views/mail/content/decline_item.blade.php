@extends('mail.layout.default')

@section('title')
    @lang('Declined')
@endsection

@section('content')
<table>
      <tbody>
        <tr>
          <td style="padding: 10px;">
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
                <td style="padding: 10px;">
                    <p>Your item has been Declined.</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;">
                    <p>Reason:</p>
                    <p>{{ $data->reason }}</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
