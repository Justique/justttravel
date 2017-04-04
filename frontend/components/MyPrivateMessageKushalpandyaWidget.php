<?php
/**
 * Created by PhpStorm.
 * User: VisioN
 * Date: 04.06.2015
 * Time: 12:57
 */

namespace frontend\components;

use frontend\assets\FrontendAsset;
use vision\messages\assets\CloadAsset;
use vision\messages\widgets\PrivateMessageWidget;


class MyPrivateMessageKushalpandyaWidget extends PrivateMessageWidget {
    public function run(){
        $this->assetJS();
        $this->addJs();
        $this->html = '<div id="' . $this->uniq_id . '" class="">';
        $this->html .= '<div class="message-north">';
        $this->html .= $this->getListUsers();
        $this->html .= $this->getBoxMessages();
        $this->html .= '</div>';
        $this->html .= $this->getFormInput();
        $this->html .= '</div>';
        return $this->html;
    }

    protected function assetJS() {
        FrontMessageAssets::register($this->view);
    }

    protected function getListUsers() {
        $users = \Yii::$app->mymessages->getAllUsers();
        $html = '<ul style="display:none" class="list_users message-user-list">';
        foreach($users as $usr) {
            $html .= '<li class="contact" data-user="' . $usr['id'] . '"><a href="#">';
            $html .= '<span class="user-img"></span>';
            $html .= '<span class="user-title">' . $usr[\Yii::$app->mymessages->attributeNameUser];
            $html .= ' <span>';
            if($usr['cnt_mess']){
                $html .= ' <strong>( непрочитанных - '.$usr['cnt_mess']." )</strong>";
            }
            $html .= "</span></span></a></li>";
        }
        $html .= '</ul>';
        return $html;
    }

    protected function getBoxMessages() {
        $html = '';
        $html .= '<div style="width:100%" class="message-container message-thread">';

        $html .= '</div>';
        return $html;
    }

    protected function getFormInput() {
        $html = '<form action="#" class="message-form" method="POST">';
        $html .= '<textarea placeholder="Сообщение..." disabled="true" name="input_message"></textarea>';
        $html .= '<input type="hidden" name="message_id_user" value="">';
        $html .= '<button class="button yellow" type="submit">' . $this->buttonName . '</button>';
//        $html .= \Yii::$app->mymessages->enableEmail ? '<span class="send_mail"><input class="checkbox" id="send_mail" type="checkbox" name="send_mail" value="1"><label for="send_mail">Отправить также на email</label></span>' : '';
        $html .= '</form>';
        return $html;
    }
}