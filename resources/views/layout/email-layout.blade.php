<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/>
    <style>
        body {
            background: #e4e4e4;
            margin: 30px;
            padding: 30px;
        }

        .heading {
            height: 50px;
        }

        .main-body {
            max-width: 550px;
            background: #fafcff;
            padding: 30px;
        }

        .promate-image {
            width: 90px;
            height: 90px;
            float: right;
        }

        .title {
            font-weight: 400;
            text-align: center;
            float: left;
            font-size: 20px;
            padding-left: 15px;
        }

        .content-body {
            /* padding: 20px;
             margin: 20px;*/
        }
    </style>
</head>
<body>
<div class="main-body">
    <div class="content-body">
        @yield('content')
    </div>


    <table border="0" cellpadding="0" cellspacing="0" width="100%">

        <!-- start permission -->
        <tr>
            <td align="center" bgcolor="#e9ecef"
                style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                <p style="margin: 0;">If you didn't request this email, you can safely delete this email.</p>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#e9ecef"
                style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                
            </td>
        </tr>
        <!-- end unsubscribe -->

    </table>

</div>

</body>
</html>
