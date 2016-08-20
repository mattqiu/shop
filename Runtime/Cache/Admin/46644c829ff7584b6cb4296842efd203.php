<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" charset="utf-8" src="<?php echo C('JS_URL');?>jquery-1.8.3.min.js"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <style type="text/css">
        <!--
        body {
            margin-left: 3px;
            margin-top: 0px;
            margin-right: 3px;
            margin-bottom: 0px;
        }
        .STYLE1 {
            color: #e1e2e3;
            font-size: 12px;
        }
        .STYLE6 {color: #000000; font-size: 12; }
        .STYLE10 {color: #000000; font-size: 12px; }
        .STYLE19 {
            color: #344b50;
            font-size: 12px;
        }
        .STYLE21 {
            font-size: 12px;
            color: #3b6375;
        }
        .STYLE22 {
            font-size: 12px;
            color: #295568;
        }
        a:link{
            color:#e1e2e3; text-decoration:none;
        }
        a:visited{
            color:#e1e2e3; text-decoration:none;
        }
        -->
    </style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> <?php echo ($daohang["first"]); ?> -> <?php echo ($daohang["second"]); ?></span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
              <a href="<?php echo ($daohang["url"]); ?>"><img src="<?php echo C('AD_IMG_URL');?>add.gif" width="10" height="10" /> <?php echo ($daohang["third"]); ?></a>   &nbsp;
              </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>



    <tr>
        <td>





            <form action="/index.php/Admin/Attribute/tianjia.html" method="post" enctype="multipart/form-data">

                <table id="general-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">属性名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="attr_name" />
                            <span style="color: rgb(255, 0, 9)">*</span>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品类型：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <select name="type_id" >
                                <option value="0">-请选择-</option>
                                <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                            </select>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">单选/多选属性：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="radio" name="attr_sel" checked="checked" value="0" />单选
                            <input type="radio" name="attr_sel" value="1" />多选
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">请选择值得录入方式：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="radio" name="attr_write" checked="checked" value="0" />手工录入
                            <input type="radio" name="attr_write" value="1" />从下面列表选取
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">可选值列表：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <textarea name="attr_vals"  cols="30" rows="5"></textarea>
                            <span style="color: rgba(119, 105, 68, 0.67)">多个可选值中间使用“,”分割</span>
                        </div></td>
                    </tr>




                </table>

                <table  width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" >
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19" align="center">
                            <input type="submit" value="添加属性">
                        </td>
                    </tr>
                </table>
            </form>

        </td>
    </tr>
</table>


</body>
</html>