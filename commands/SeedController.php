<?php

namespace app\commands;

use yii\console\Controller;
use app\models\User;

class SeedController extends Controller
{
    /**
     * Create an admin user
     *
     * Run: php yii seed/admin
     */
    public function actionAdmin()
    {
        $user = new User();
        $user->username = 'admin';
        $user->setPassword('Admin@123'); // you can change this later
        $user->role = 'admin';
        $user->client_id = null;

        // 👇 yeh line add karo
        $user->generateAuthKey();

        if ($user->save()) {
            $this->stdout("Admin user created successfully.\n");
        } else {
            $this->stderr("Failed to create admin user:\n");
            print_r($user->errors);
        }
    }

}
