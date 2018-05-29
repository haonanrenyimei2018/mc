<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\workplace\mc/application/admin\view\ad\upload.html";i:1527148135;}*/ ?>
<html>
<head>
    <title>js获取客户端网卡的IP地址、MAC地址---www.jbxue.com</title>
</head>
<body>
<object classid="CLSID:76A64158-CB41-11D1-8B02-00600806D9B6" id="locator" style="display:none;visibility:hidden"></object>
<object classid="CLSID:75718C9A-F029-11d1-A1AC-00C04FB6C223" id="foo" style="display:none;visibility:hidden"></object>
<form name="myForm">
    <br/>MAC地址：<input type="text" name="macAddress">
    <br/>IP地址：<input type="text" name="ipAddress">
    <br/>主机名：<input type="text" name="hostName">
</form>
</body>
</html>
<script language="javascript">
    var sMacAddr="";
    var sIPAddr="";
    var sDNSName="";
    var service = locator.ConnectServer();
    service.Security_.ImpersonationLevel=3;
    service.InstancesOfAsync(foo, 'Win32_NetworkAdapterConfiguration');
</script>
<script FOR="foo" EVENT="OnObjectReady(objObject,objAsyncContext)" LANGUAGE="JScript">
    if(objObject.IPEnabled != null && objObject.IPEnabled != "undefined" && objObject.IPEnabled == true){
        if(objObject.IPEnabled && objObject.IPAddress(0) !=null && objObject.IPAddress(0) != "undefined" && objObject.DNSServerSearchOrder!=null)
            sIPAddr = objObject.IPAddress(0);
        if(objObject.MACAddress != null &&objObject.MACAddress != "undefined")
            sMacAddr = objObject.MACAddress;
        if(objObject.DNSHostName != null &&objObject.DNSHostName != "undefined")
            sDNSName = objObject.DNSHostName;
    } <a target=_blank href="http://www.jbxue.com" target="_blank">www.jbxue.com</a>
</script>

<script FOR="foo" EVENT="OnCompleted(hResult,pErrorObject, pAsyncContext)" LANGUAGE="JScript">
    myForm.macAddress.value=sMacAddr;
    myForm.ipAddress.value=sIPAddr;
    myForm.hostName.value=sDNSName;
</script>