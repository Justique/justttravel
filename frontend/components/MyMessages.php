<?php

namespace frontend\components;

use common\models\UserProfile;
use vision\messages\models\Messages;
use vision\messages\exceptions\ExceptionMessages;

class MyMessages extends \vision\messages\components\MyMessages
{
    /**
     * Method to getMessages.
     *
     * @param $whom_id
     * @param $from_id
     * @param $type
     *
     * @throws ExceptionMessages
     * @return array
     */
    protected function getMessages($whom_id, $from_id = null, $type = null, $last_id = null) {
        $table_name = Messages::tableName();
        $my_id = $this->getIdCurrentUser();

        $query = new \yii\db\Query();
        $query
            ->select([
                'FROM_UNIXTIME(msg.created_at, "%d-%m-%Y %H:%i:%S") as created_at',
                'msg.id',
                'msg.status',
                'msg.message',
                "usr1.id as from_id",
                "usr1.$this->attributeNameUser as from_name",
                "usr2.id as whom_id",
                "usr2.$this->attributeNameUser as whom_name"
            ])
            ->from("$table_name as msg")
            ->leftJoin("$this->userTableName as usr1", 'usr1.id = msg.from_id')
            ->leftJoin("$this->userTableName as usr2", 'usr2.id = msg.whom_id');

        if($from_id) {
            $query
                ->where(['msg.whom_id' => $whom_id, 'msg.from_id' => $from_id])
                ->orWhere(['msg.from_id' => $whom_id, 'msg.whom_id' => $from_id]);
        } else {
            $query->where(['msg.whom_id' => $whom_id]);
        }


        //if not set type
        //send all message where no delete
        if($type) {
            $query->andWhere(['=', 'msg.status', $type]);
        } else {
            /*
            $query->andWhere('((msg.is_delete_from != 1 AND from_id = :my_id) OR (msg.is_delete_whom != 1 AND whom_id = :my_id) ) ', [
                ':my_id' => $my_id,
            ]);
            */
        }

        $query->andWhere('((msg.is_delete_from != 1 AND from_id = :my_id) OR (msg.is_delete_whom != 1 AND whom_id = :my_id) ) ', [
            ':my_id' => $my_id,
        ]);

        if($last_id){
            $query->andWhere(['>', 'msg.id', $last_id]);
        }

        $return = $query->orderBy('msg.id')->all();
        $ids = [];
        foreach($return as $key => $m) {
            if($m['whom_id'] == $my_id) {
                $ids[] = $m['id'];
            }
            $from_user_profile = UserProfile::findOne(['user_id' => $m['from_id']]);
            $return[$key]['from_avatar'] = $from_user_profile
                ? \Yii::$app->glide->createSignedUrl([
                    'glide/index',
                    'path' => $from_user_profile->avatar_path,
                    'w' => 100,
                    'q' => getenv('IMAGE_QUALITY')
                ], true)
                : '';
        }

        //change status to is_read
        if(count($ids) > 0) {
            Messages::updateAll(['status' => Messages::STATUS_READ], ['in', 'id', $ids]);
        }

        $user_id = $this->getIdCurrentUser();
        return array_map(function ($r) use ($user_id) { $r['i_am_sender'] = $r['from_id'] == $user_id; return $r;}, $return);
    }
}