<?php

namespace qvalent\rate;

use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        /** @var Module $module */
        $module = $app->getModule('rate');

        if (!$app instanceof ConsoleApplication) {
            $app->getUrlManager()->addRules([
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => $module->id  . '/<controller>/<action>',
                    'route' => $module->id . '/<controller>/<action>'
                ]
            ], false);
        }
    }
}
