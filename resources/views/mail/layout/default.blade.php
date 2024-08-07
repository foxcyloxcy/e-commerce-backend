<html>
  <div style="background-color: #fff; width: 700px; height: 600px; padding-left: 15px; padding-right: 15px; padding-top: 30px; padding-bottom: 43px; color: #081626; font-size: 16px; margin: auto; margin-bottom: 80px; margin-top: 80px; ">
    <head>
        <table>
            <tbody>
                <tr>
                <td width="50%" >
                    <img class="company-logo" src="https://reloved-uat.s3.ap-northeast-1.amazonaws.com/asset/mainlogo.png">
                </td>
                </tr>
                </tr>
            </tbody>
        </table>
      <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-size: 14px;
            color: #394551;
            font-family: 'Inter', sans-serif;
        }
        th,
        td {
            text-align: left;
            font-size: 8px;
        }
        th {
          text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        p{
          color: #081626;
          font-size: 14;
          font-weight: 400;
        }
        .company-logo {
          width: 30%;
          margin-bottom: 20px;
        }
        .box {
          width: 10px;
          height: 10px;
          border:  1px #050505 solid;
          margin-right: 10px;
        }
        .button {
            background-color: #2C3694;
            border: none;
            color: #E6E8E9;
            padding: 5px;
            border-radius: 5%;
            font-size: 12px;
        }
        .footer {
            color: #8D949B;
            font-size: 9px;
            margin-top: 10px;
        }
      </style>
  </head>
    <body style="background-color: #FAFAFA; width: 100%;">
        @yield('content')
        <table>
            <tbody>
                <tr>
                    <td style="padding: 10px;">
                        <table>
                            <tbody>
                                <tr>
                                <td>
                                <p> Warm regards,</p>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Reloved UAE</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                        <table>
                            <tbody>
                                <tr>
                                <td>
                                    <img style="width: 15%;" src="https://reloved-uat.s3.ap-northeast-1.amazonaws.com/asset/mainlogo.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="footer">
                                        © 2023 Reloved UAE. All rights reserved
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
  </div>
</html>
