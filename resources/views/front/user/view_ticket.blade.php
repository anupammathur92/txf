<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
    .table-bordered { border: 1px solid #dee2e6; }
    .table { width: 100%; background-color: transparent; border-collapse: collapse;}
    .table-bordered td, .table-bordered th { border: 1px solid #dee2e6; }
    .table td, .table th { padding: 9px; vertical-align: top; border-top: 1px solid #dee2e6;font-size: 14px; }
    </style>
</head>
<body style="background: #ececec;">
    <table width="420" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family: Arial, Helvetica, sans-serif; width: 420px; max-width: 420px; margin:0 auto;">
        <tr><td height="50" colspan="2">&nbsp;</td></tr>
        <tr>
            <td align="center" colspan="2">
                <img src="{{ asset('public/images/front/logo.svg') }}" width="130" style="display: inline-block;" alt="">
            </td>
        </tr>
        <tr><td height="10" colspan="2">&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:0 15px;background: #fff;text-align:center;">
                    <tr><td height="20">&nbsp;</td></tr>
                    <tr>
                        <td align="center" style="text-align: center;">
                            <h2 style="margin-bottom: 0;margin-top: 0; color: #2b333e;font-size: 35px;">{{ $ticket_detail->getEventDetails->event_name }}</h2>
                        </td>
                    </tr>
                    <tr><td height="3"></td></tr>
                    <tr>
                        <td align="center" style="text-align: center;">
                            <p style="text-align: center;padding: 6px 10px;width: 50px; display: inline-block;background: #ececec; font-size: 12px; border-radius: 10px; margin:0 auto;">{{ $ticket_detail->getEventTicketDetails->getTicketCategory->ticket_category_name }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <p style="margin-top: 5px;color: #1d294f;line-height: 1.6;">{{ $ticket_detail->getEventDetails->getVenue->venue_name }}<br></p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <img src="{{ asset('public/uploads/qrcode/'.$ticket_detail->qrcode_link) }}" alt="qr-code-img" style="margin-top: 10px;">
                        </td>
                    </tr>
                    <tr><td height="10">&nbsp;</td></tr>
                    <tr>
                        <td align="center">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="right" style="text-align: right;padding-right: 10px;width: 42%;">
                                        <span style="padding: 10px 0;width: 65px; margin-left: auto; display: inline-block;border: 1px solid #ddd;font-size: 14px;border-radius: 20px; text-align: center;">#{{ $ticket_detail->id }}</span>
                                    </td>
                                    <td align="left" style="text-align: left;">
                                        <span style="padding: 10px 0;width: 140px; margin-right: auto; display: inline-block;border: 1px solid #ddd;font-size: 14px;border-radius: 20px; text-align: center;">No. of Ticket: {{ $ticket_detail->no_of_tickets }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td height="40">&nbsp;</td></tr>
                    <tr>
                        <td>
                            <span style="background: #ececec;color: #000;padding: 10px 20px;display: block;text-align: center;border-radius: 5px;font-weight: 600;">{{ date('D, j M Y',strtotime($ticket_detail->getEventDetails->event_date)) }}</span>
                        </td>
                    </tr>
                    <tr><td height="5"></td></tr>
                    <tr>
                        <td>
                            <span style="background: #ececec;color: #000;padding: 10px 20px;display: block;text-align: center;border-radius: 5px;font-weight: 600;">{{ $ticket_detail->getEventDetails->event_time }}</span>
                        </td>
                    </tr>
                    <tr><td height="10">&nbsp;</td></tr>
                     <tr>
                        <td>
                            <h2 style="font-size: 14px;">User Information</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-bordered" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">User Age</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td align="center">{{ $ticket_detail->getUsers->full_name }}</td>
                                    <td align="center">
                                        <?php 
                                             $data=$ticket_detail->getUsers->dob;
                                             $age = date_diff(date_create($data), date_create('now'))->y;
                                             echo $age;
                                        ?>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr> -->
                    <tr><td height="20">&nbsp;</td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><p style="font-size: 12px;color: #9c9c9c;">Copyright 2021 © TixFair</p></td>
            <!-- <td align="right">
                <a href="#" style="font-size: 12px;color: #9c9c9c;margin-right: 5px;">Privacy Policy</a>
                <a href="#" style="font-size: 12px;color: #9c9c9c;">Terms & conditions</a>
            </td> -->
        </tr>
        <tr><td height="50" colspan="2">&nbsp;</td></tr>
    </table>
</body>
</html>