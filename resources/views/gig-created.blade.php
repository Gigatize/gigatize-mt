@extends('layouts.email')
@section('content')
<tr>
    <td>
        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
            <tbody>
            <tr>
                <td style="line-height: 0px;" height="40">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div style="border-radius: 50%; width: 160px; height: 160px; background-color: #ccc; margin: 0 auto;"></div>
                </td>
            </tr>
            <tr>
                <td style="line-height: 0px;" height="20">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 0px 20px 0px 20px;">
                    <span style="font-size: 40px;">Congratulations!</span><br/>
                    <span style="font-size: 24px;">You've posted a gig!</span><br/>
                </td>
            </tr>
            <tr>
                <td style="line-height: 0px;" height="20">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <a href="#"
                       style="border-radius: 8px; padding: 8px 0; text-align: center; width: 180px; background-color: #FFD11F; color: #000; display: block; margin: 0 auto; font-size: 20px; text-decoration: none;">View
                        My Gig</a>
                </td>
            </tr>
            <tr>
                <td style="line-height: 0px;" height="40">&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr>
    <td style="background-color: #eee;">
        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
            <tbody>
            <tr>
                <td style="line-height: 0px;" height="16" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="30"></td>
                <td style="line-height: 1.6; font-size: 16px;">
                    Hi first_name,<br/><br/>
                    Thank you for posting a gig! You will be notified when someone has signed up.<br/><br/>
                    Your gig kicks off in <span style="color: #00A1AC;">|X|</span> days on <span
                        style="color: #00A1AC;">|MM/DD/YYYY|</span>.<br/>
                    Your gig will conclude in <span style="color: #00A1AC;">|X|</span> days on <span
                        style="color: #00A1AC;">|MM/DD/YYYY|</span>, but you may alter this deadline up until one week
                    before gig kickoff.<br/><br/>
                    If you have any questions or would like to learn more about how Gigatize can help you, please visit
                    our Knowledge Hive: <a href="#"
                                           style="color: #00A1AC;">www.gigatize.io/knowledgehive/</a>.<br/><br/>
                    Thank you!
                    - The Gigatize Team
                </td>
                <td width="30"></td>
            </tr>
            <tr>
                <td style="line-height: 0px;" height="16" colspan="3">&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection