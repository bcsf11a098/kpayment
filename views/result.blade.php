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
                        <td align="left" width="70%" class="heading"><strong>Knet Merchant Demo Shopping Center  -php</strong>
                            <!-- This example displays the content of several ServerVariables. -->

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="msg">
                <?php
                    If ($paymentId == ""){
                        header("location:error.php");
                    }else{
                    ?>

                    Transaction completed successfully.<br>
                    Thank you for your order
                <?php } ?>
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
                        <td width=74% class="tdwhite">{{ $paymentId }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">Post Date :</td>
                        <td class="tdwhite">{{ $postDate }}></td>
                    </tr>
                    <tr>
                        <td class="tdfixed">Result Code :</td>
                        <td class="tdwhite">{{ $result }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">Transaction ID :</td>
                        <td class="tdwhite">{{ $transactionId }}></td>
                    </tr>
                    <tr>
                        <td class="tdfixed">Auth :</td>
                        <td class="tdwhite">{{ $auth }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">Track ID :</td>
                        <td class="tdwhite">{{ $trackId }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">Ref No :</td>
                        <td class="tdwhite">{{ $ref }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">UDF1 :</td>
                        <td class="tdwhite">{{ $udf1 }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">UDF2 :</td>
                        <td class="tdwhite">{{ $udf2 }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">UDF3 :</td>
                        <td class="tdwhite">{{ $udf3 }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">UDF4 :</td>
                        <td class="tdwhite">{{ $udf4 }}</td>
                    </tr>
                    <tr>
                        <td class="tdfixed">UDF5 :</td>
                        <td class="tdwhite">{{ $udf5 }}</td>
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

