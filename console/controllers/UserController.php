<?php

namespace console\controllers;

use frontend\models\SignupForm;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii\validators\EmailValidator;

class UserController extends Controller
{
    /**
     * Create user
     */
    public function actionCreate()
    {
        $username = $this->prompt('Enter username:', ['required' => true]);
        $email = $this->prompt('Enter email:', ['required' => true, 'validator' => function($input, &$error) {
            $emailValidator = new EmailValidator();

            if (!$emailValidator->validate($input, $validatorError)) {
                $error = $validatorError;
                return false;
            }

            return true;
        }]);

        $password = $this->prompt('Enter password:', ['required' => true]);

        $this->prompt('Repeat password:', ['required' => true, 'validator' => function($input, &$error) use ($password) {

            if ($password !== $input) {
                $error = 'Passwords you entered do not match';
                return false;
            }

            return true;
        }]);

        $signupForm = new SignupForm();
        $signupForm->username = trim($username);
        $signupForm->email = trim($email);
        $signupForm->password = trim($password);
        $result = $signupForm->signup();


        if ($result) {
            $this->stdout("User was successfully created\n", Console::BG_GREEN);
            return ExitCode::OK;
        } else {
            $this->stdout("Failed to create user\n", Console::BG_RED);

            foreach ($signupForm->firstErrors as $error) {
                $this->stdout("{$error}\n", Console::FG_RED);
            }

            return ExitCode::DATAERR;
        }
    }
}