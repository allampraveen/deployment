<?php
/**
 * Deployment plugin for Craft CMS 3.x
 *
 * Craft Deployment
 *
 * @link      smsglobal.com
 * @copyright Copyright (c) 2018 Praveen
 */

namespace smsg\deployment\console\controllers;

use smsg\deployment\Deployment;

use Craft;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Deployer Command
 *
 * The first line of this class docblock is displayed as the description
 * of the Console Command in ./craft help
 *
 * Craft can be invoked via commandline console by using the `./craft` command
 * from the project root.
 *
 * Console Commands are just controllers that are invoked to handle console
 * actions. The segment routing is plugin-name/controller-name/action-name
 *
 * The actionIndex() method is what is executed if no sub-commands are supplied, e.g.:
 *
 * ./craft deployment/deployer
 *
 * Actions must be in 'kebab-case' so actionDoSomething() maps to 'do-something',
 * and would be invoked via:
 *
 * ./craft deployment/deployer/do-something
 *
 * @author    Praveen
 * @package   Deployment
 * @since     1.0.0
 */
class DeployerController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Handle deployment/deployer console commands
     *
     * The first line of this method docblock is displayed as the description
     * of the Console Command in ./craft help
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'something';

        echo "Welcome to the console DeployerController actionIndex() method\n";

        return $result;
    }

    /**
     * Handle deployment/deployer/do-something console commands
     *
     * The first line of this method docblock is displayed as the description
     * of the Console Command in ./craft help
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'something';

        echo "Welcome to the console DeployerController actionDoSomething() method\n";

        return $result;
    }
}
