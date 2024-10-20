@extends('mail.layout.default')

@section('title')
    @lang('Verification')
@endsection

@section('content')
<table>
      <tbody>
        <tr>
          <td style="padding: 10px; font-size: 16px;">
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
                <td style="padding: 10px; font-size: 16px;">
                    <p>Your OTP is: {{ $code }}</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
