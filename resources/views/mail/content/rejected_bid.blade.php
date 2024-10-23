@extends('mail.layout.default')

@section('title')
    @lang('Bid Rejected')
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
                    <p>Your offer has been rejected on the {{ $data->item_name }} item, you can submit another offer to see if this gets accepted.</p>
                </td>
            </tr>
          
    </tbody>
</table>
@endsection
