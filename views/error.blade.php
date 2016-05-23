<html>
<head>
    <title>Knet Merchant Demo</title>
    <meta http-equiv="pragma" content="no-cache">
    <link href="st.css" rel="stylesheet" type="text/css" />
</head>

<body >
<table width="100%" cellspacing="1" cellpadding="1">
    <tr>
        <td align="center" >
            <table width="70%" border="0" >
                <tr><td align=center class="heading">
                        <img src=knet.gif>
                    </td>
                    <td align="left" width="70%" class="heading"><strong>Knet Merchant Demo Shopping Center -php</strong>
                        <!-- This example displays the content of several ServerVariables. -->

                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" class="msg">
            <div class="error">
                Transaction was not successful<br>
                Your order was not completed. Please try again later</div>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table width=70% border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" col="2">
                <tr>
                    <td colspan="2" align="center" class="msg"><strong class="text">Transaction Details
                            (from Merchant Notification Message)</strong></td>
                </tr>
                <tr>
                    <td width=26% class="tdfixed">Payment ID :</td>
                    <td width=74% class="tdwhite">@if(isset($paymentid)) {{ $paymentid }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">Post Date :</td>
                    <td class="tdwhite">@if(isset($postdate)) {{ $postdate }}> @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">Result Code :</td>
                    <td class="tdwhite">@if(isset($result)) {{ $result }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">Transaction ID :</td>
                    <td class="tdwhite">@if(isset($tranid)) {{ $tranid }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">Auth :</td>
                    <td class="tdwhite">@if(isset($auth)) {{ $auth }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">Track ID :</td>
                    <td class="tdwhite">@if(isset($trackid)) {{ $trackid }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">Ref No :</td>
                    <td class="tdwhite">@if(isset($ref)) {{ $ref }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">UDF1 :</td>
                    <td class="tdwhite">@if(isset($udf1)) {{ $udf1 }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">UDF2 :</td>
                    <td class="tdwhite">@if(isset($udf2)) {{ $udf2 }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">UDF3 :</td>
                    <td class="tdwhite">@if(isset($udf3)) {{ $udf3 }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">UDF4 :</td>
                    <td class="tdwhite">@if(isset($udf4)) {{ $udf4 }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">UDF5 :</td>
                    <td class="tdwhite">@if(isset($udf5)) {{ $udf5 }} @endif</td>
                </tr>
                <tr>
                    <td class="tdfixed">&nbsp; </td>
                    <td class="tdwhite">

                    </td>
                </tr>
            </table></td>
    </tr>
</table>
</body>
</html>

