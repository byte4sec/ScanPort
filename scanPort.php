<?php

$youip = $HTTP_SERVER_VARS["REMOTE_ADDR"]; // 获取本机IP地址
$remoteip = $_POST['inputIp']; // 获取表单提交的IP地址

?>

<html>

<head>

    <title>计算机网络课程设计 在线端口扫描</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="./bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="./css/sb-admin-2.css" rel="stylesheet">

    <style TYPE="text/css">
        <!--
        body {
            FONT-SIZE: 12px;
            FONT-FAMILY: Verdana;
            color: #000000;
        }
        td {
            FONT-SIZE: 12px;
            FONT-FAMILY: Verdana;
            color: #000000;
            line-height: 14px;
        }
        .style1 {
            color: #FFFFFF
        }
        -->
    </style>

</head>

<body>

<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-md-4 col-md-offset-4">
            <img class="img-responsive img-rounded" src="xiaohui.png"/>
        </div>
    </div>


    <?php

    if (!empty($remoteip)) {

// 如果表单不为空就进入IP地址格式的判断
        function err()
        {

            echo("<script>alert('对不起，该IP地址不合法');window.history.back();</script>");
            die();

        }

// 定义提交错误IP的提示信息
        $ips = explode(".", $remoteip);

// 用.分割IP地址
        if (intval($ips[0]) < 1 or intval($ips[0]) > 255 or intval($ips[3]) < 1
            or intval($ips[3] > 255)
        ) err();

// 如果第一段和最后一段IP的数字小于1或者大于255，则提示出错
        if (intval($ips[1]) < 0 or intval($ips[1]) > 255 or intval($ips[2]) < 0
            or intval($ips[2] > 255)
        ) err();

// 如果第二段和第三段IP的数字小于0或者大于255，则提示出错
        $closed = '此端口目前处于关闭状态。';
        $opened = '<font color=red>此端口目前处于打开状态！</font>';
        $close = "关闭";
        $open = "<font color=red>打开</font>";
        $port = array(21, 23, 25, 79, 80, 110, 135, 137, 138, 139, 143, 443, 445, 1433, 3306, 3389);
        $msg = array(
            'Ftp',
            'Telnet',
            'Smtp',
            'Finger',
            'Http',
            'Pop3',
            'Location Service',
            'Netbios-NS',
            'Netbios-DGM',
            'Netbios-SSN',
            'IMAP',
            'Https',
            'Microsoft-DS',
            'MSSQL',
            'MYSQL',
            'Terminal Services'
        );
        echo " <div class='row' style='margin-top:25px'>
        <div class='col-md-4 col-md-offset-4'>
            <table class=' table table-bordered'>
                <tr>
                    <td align=center>您扫描的IP</td><td align=center style='color:red;'>".$remoteip."</td>
                </tr>
            </table>
        </div>
    </div>
    <div class='row' style='margin-top:10px'>
        <div class='col-md-8 col-md-offset-2'>
            <table class='table table-bordered '>
                <tr>
                    <td align=center>端口</td>
                    <td align=center>服务</td>
                    <td align=center>检测结果</td>
                    <td align=center>描述</td>
                </tr>";
        // 输出显示的表格
        for ($i = 0; $i < sizeof($port); $i++) {

            $fp = @fsockopen($remoteip, $port[$i], $errno, $errstr, 1);

            if (!$fp) {

                echo "<tr><td align=center>" . $port[$i] . "</td><td align=center>" . $msg[$i] . "</td><td


align=center>" . $close . "</td><td align=center>" . $closed . "</td></tr>\n";


            } else {

                echo "<tr><td align=center>" . $port[$i] . "</td><td align=center>" . $msg[$i] . "</td><td align=center


align=center>" . $open . "</td><td align=center>" . $opened . "</td></tr>";


            }

        }


        exit;

    }


    ?>


    </table>
</div>
</div>
</div>
</body>
</html>