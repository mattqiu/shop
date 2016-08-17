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


  <script type="text/javascript" charset="utf-8" src="<?php echo C('PLUGIN');?>ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php echo C('PLUGIN');?>ueditor/ueditor.all.min.js"> </script>
  <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
  <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
  <script type="text/javascript" charset="utf-8" src="<?php echo C('PLUGIN');?>ueditor/lang/zh-cn/zh-cn.js"></script>


  <tr>
    <td>


      <style type="text/css">
        .tab-div {
          background: #EEF8F9;
          border: 1px solid #BBDDE5;
          margin: 0 0 10px 0;
          padding: 1px;
        }
        #tabbar-div {
          background: #80BDCB;
          padding-left: 10px;
          height: 22px;
          padding-top: 1px;
        }

        #tabbar-div p {
          margin: 2px 0 0 0;
        }

        .tab-front {
          background: #BBDDE5;
          line-height: 20px;
          font-weight: bold;
          padding: 4px 15px 4px 18px;
          border-right: 2px solid #278296;
          cursor: hand;
          cursor: pointer;
          font-size: 14px;
        }

        .tab-back {
          color: #FFF;
          line-height: 20px;
          padding: 4px 15px 4px 18px;
          border-right: 1px solid #FFF;
          cursor: hand;
          cursor: pointer;
          font-size: 14px;

        }

        .tab-hover {
          color: #FFF;
          background: #94C9D3;
          line-height: 20px;
          padding: 4px 15px 4px 18px;
          border-right: 1px solid #FFF;
          cursor: hand;
          cursor: pointer;
        }

        #tabbody-div {
          border: 2px solid #BBDDE5;
          padding: 10px;
          background: #FFF;
        }
      </style>
      <div id="tabbar-div">
        <p>
          <span class="tab-front" id="general-tab">通用信息</span>
          <span class="tab-back" id="detail-tab">详细描述</span>
          <span class="tab-back" id="mix-tab">其他信息</span>
          <span class="tab-back" id="properties-tab">商品属性</span>
          <span class="tab-back" id="gallery-tab">商品相册</span>
          <span class="tab-back" id="linkgoods-tab">关联商品</span>
          <span class="tab-back" id="groupgoods-tab">配件</span>
          <span class="tab-back" id="article-tab">关联文章</span>
        </p>
      </div>
      <script type="text/javascript">
        $(function(){
          $('#tabbar-div span').on('click', function(){
            $('#tabbar-div span').attr('class', 'tab-back');
            $(this).attr('class', 'tab-front');
            $('table[id$=-show]').hide();
            //当前被点击标签内容显示
            var idflag = $(this).attr('id');
            $('#'+idflag+'-show').show();
          });
        })
      </script>

      <form action="/index.php/Admin/Goods/update/goods_id/1.html" method="post" enctype="multipart/form-data">

      <table id="general-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
      <tr>
        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品名称：</span></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
        <input type="text" name="goods_name"  value="<?php echo ($good["goods_name"]); ?>"/>
          <input type="hidden" name="goods_id" value="<?php echo ($good["goods_id"]); ?>" />
        </div></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">价格：</span></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_price" value="<?php echo ($good["goods_price"]); ?>" /></div></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">数量：</span></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_number" value="<?php echo ($good["goods_number"]); ?>" /></div></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">重量：</span></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_weight" value="<?php echo ($good["goods_weight"]); ?>" /></div></td>
      </tr>
        <tr>
          <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">logo图片：</span></div></td>
          <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="file" name="goods_file" /><img src="<?php echo C('SITE_URL'); echo ($good["goods_small_logo"]); ?>" alt="<?php echo ($good["goods_name"]); ?>">
            </td>
        </tr>


    </table>
        <table id="detail-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" style="display: none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">详情描述：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <textarea rows="5" cols="30" name="goods_introduce" id="editor" style="width:650px;height:260px;"><?php echo ($good["goods_introduce"]); ?></textarea>
            </div></td>
          </tr>
        </table>
        <table id="mix-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" style="display: none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">其它信息：</span></div></td>
          </tr>
        </table>
        <table id="properties-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" style="display: none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品属性：</span></div></td>
          </tr>
        </table>
        <script type="text/javascript">
          function add_pics_item(spanobj) {
//    var picstr = spanobj.parentNode.parentNode.parentNode;
//    var futr = picstr.cloneNode();
            var picstr = $(spanobj).parent().parent().parent();
            var futr = picstr.clone();
            var sp = "<span class='STYLE19' onclick='$(this).parent().parent().parent().remove()'>[-]商品相册:</span>";
            //从futr中把[+]号span给删除
            futr.find('span').remove();
            //在给futr追加[-]号span
            futr.find('div').append(sp);
            $('#gallery-tab-show')[0].appendChild(futr[0]);
          }

          //删除单个相册图片
          function del_pics(pics_id) {
            $.ajax({
              url:"<?php echo U('delPics');?>",
              data:{'pics_id':pics_id},
              dataType:'html',
              type:'get',
              success:function(msg){
                $('#pic_show_'+pics_id).remove();
              }
            });
          }
        </script>
        <table id="gallery-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" style="display: none">
        <tr><td colspan="2">
          <?php if(is_array($pc)): foreach($pc as $key=>$img): ?><li style="list-style: none; float: left;" id="pic_show_<?php echo ($img["pics_id"]); ?>">
              <img width="180" height="180" src="<?php echo C('SITE_URL'); echo ($img["pics_mid"]); ?>" alt="">
              <span style="color: #ff0705" onclick="del_pics(<?php echo ($img["pics_id"]); ?>)">[-]</span>
            </li><?php endforeach; endif; ?></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19" onclick="add_pics_item(this)">[+]商品相册：</span></div></td>
            <td>
              <input type="file" name="goods_pics[]">
            </td>
          </tr>
        </table>
        <table id="linkgoods-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" style="display: none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">关联商品：</span></div></td>
          </tr>
        </table>
        <table id="groupgoods-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" style="display: none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">配件：</span></div></td>
          </tr>
        </table>
        <table id="article-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" style="display: none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">关联文章：</span></div></td>
          </tr>
        </table>
        <table  width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" >
  <tr>
    <td height="20" bgcolor="#FFFFFF" class="STYLE6"></td>
    <td height="20" bgcolor="#FFFFFF" class="STYLE19" align="center">
      <input type="submit" value="提交">
    </td>
  </tr>
        </table>
      </form>

    </td>
  </tr>
</table>
<script>
  //实例化编辑器
  //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
  var ue = UE.getEditor('editor');

</script>


</body>
</html>