<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title',"Congratulations!")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        /* Some resets and issue fixes */
        #outlook a { padding:0; }
        body{ width:100% !important; -webkit-text; size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; }
        .ReadMsgBody { width: 100%; }
        .ExternalClass {width:100%;}
        .backgroundTable {margin:0 auto; padding:0; width:100%;!important;}
        table td {border-collapse: collapse;}
        .ExternalClass * {line-height: 115%;}
        /* End reset */
        /* tablet/medium screen media queries */
        @media screen and (max-width: 630px){
            /* Display block allows us to stack elements */
            *[class="mobile-column"] {display: block;}

            /* Some more stacking elements */
            *[class="mob-column"] {float: none !important; width: 100% !important;}

            /* Hide stuff */
            *[class="hide"] {display:none !important;}

            /* This sets elements to 100% width and fixes the height issues */
            *[class="100p"] {width:100% !important; height:auto !important;}

            /* For the 2x2 stack */
            *[class="condensed"] {padding-bottom:40px !important; display: block;}

            /* Centers content on mobile */
            *[class="center"] {text-align:center !important; width:100% !important; height:auto !important;}

            /* 100percent width section with 20px padding */
            *[class="100pad"] {width:100% !important; padding:20px;}

            /* 100percent width section with 20px padding left & right */
            *[class="100padleftright"] {width:100% !important; padding:0 20px 0 20px;}

            /* 100percent width section with 20px padding top & bottom */
            *[class="100padtopbottom"] {width:100% !important; padding:20px 0px 20px 0px;}

            /* centered and fixed width of 300px; */
            *[class="center-fixed"] {width:300px !important; margin: 20px auto; display: block;}

        }
    </style>
</head>
<body style="margin: 0px; padding: 0px;">
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; font-family: sans-serif;">
    <tbody>
    <tr>
        <td align="center">
            <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; max-width: 640px;" width="100%">
                <tbody>
                <tr>
                    <td style="background-color: #eee; line-height: 0px;" height="8px">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center; background-color: #eee;">
                        <img src="images/logo.png" style="max-width: 180px; width: 100%;" />
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #eee; line-height: 0px;" height="8px">&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color: #FFD11F; line-height: 0px;" height="32">&nbsp;</td>
                </tr>
                    @yield('content')
                <tr>
                    <td style="background-color: #eee; line-height: 0px;" height="32">&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color: #eee;">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
                            <tbody>
                            <tr>
                                <td width="22px"></td>
                                <td>
                                    <table border="0" cellspacing="8" cellpadding="0" width="100%" style="border-collapse: separate;" class="mobile-column">
                                        <tbody class="mobile-column">
                                        <tr style="vertical-align: top;" class="mobile-column">
                                            <td width="33.3%" style="background-color: #FFD11F;" class="center-fixed">
                                                <img src="http://placehold.it/400x300" width="100%" />
                                                <div style="padding: 8px; text-align: center;">
                                                    How to Earn Badges
                                                </div>
                                            </td>
                                            <td width="33.3%" style="background-color: #FFD11F;" class="center-fixed">
                                                <img src="http://placehold.it/400x300" width="100%" />
                                                <div style="padding: 8px; text-align: center;">
                                                    Why is an Agile Workforce Important?
                                                </div>
                                            </td>
                                            <td width="33.3%" style="background-color: #FFD11F;" class="center-fixed">
                                                <img src="http://placehold.it/400x300" width="100%" />
                                                <div style="padding: 8px; text-align: center;">
                                                    How to Write a Helpful Review
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="22px"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #eee; line-height: 0px;" height="32">&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>