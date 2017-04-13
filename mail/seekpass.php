<p>尊敬的<?php echo $adminuser;?>.您好!</p>
<p>您的找回密码链接:</p>
<p><?php $url = Yii::$app->urlManager->createAbsoluteUrl(['admin/manage/mailchangepass', 'timestamp' => $time, 'adminuser' => $adminuser, 'token' => $token]);?></p>
<p><a href="<?php echo $url;?>"><?php echo $url;?></a></p>
<p>此链接5分钟有效,请勿转发给别人</p>
<p>该邮件为系统自动发送,请勿回复!</p>
