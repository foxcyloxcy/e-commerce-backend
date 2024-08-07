@extends('mail.layout.default')

@section('title')
    @lang('Approved')
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
                    <p>Exciting news - Your item has been Approved.</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
