<?php
/**
 * Deployment plugin for Craft CMS 3.x
 *
 * Craft Deployment
 *
 * @link      smsglobal.com
 * @copyright Copyright (c) 2018 Praveen
 */

namespace smsg\deployment\controllers;

use smsg\deployment\Deployment;

use Craft;
use craft\web\Controller;

/**
 * Deployment Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Praveen
 * @package   Deployment
 * @since     1.0.0
 */
class DeploymentController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index'];


    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/deployment/deployment
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $success="Deployment";
        $variables['success'] = $success;
        return $this->renderTemplate(
            'deployment/index',
            $variables
        );

    }

    public function actionPrepare(){

        $this->requirePostRequest();
        $request = \Craft::$app->request;
        \Craft::$app->session->setNotice(
            \Craft::t('app', 'Prepare Live')
        );

        $settings = \Craft::$app->getModule('deployment')->getSettings();
    
        $ch_git = curl_init();

        curl_setopt($ch_git, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_git, CURLOPT_HTTPHEADER, array('PRIVATE-TOKEN: '. $settings->private_token, 'Content-Type: application/json'));
        curl_setopt($ch_git, CURLOPT_URL, $settings->url . '/projects/'. $settings->project .'/trigger/pipeline');
        curl_setopt($ch_git, CURLOPT_POST, true);
        $info = array(
            'ref' => 'master',
            'token' => $settings->token
        );
        $payload = json_encode($info, JSON_PRETTY_PRINT);
        curl_setopt($ch_git, CURLOPT_POSTFIELDS, $payload);
        $res = curl_exec($ch_git);

        $response = json_decode($res);

        $id = $response->id;

        Craft::$app->getSession()->set('deployer', $id);

        $deployerJobId = Craft::$app->getSession()->get('deployer');

        $ch_git = curl_init();

        curl_setopt($ch_git, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_git, CURLOPT_HTTPHEADER, array('PRIVATE-TOKEN: '. $settings->private_token, 'Content-Type: application/json'));
        curl_setopt($ch_git, CURLOPT_URL, $settings->url . '/projects/'.$settings->project . '/pipelines/'.$deployerJobId.'/jobs');
        $res = curl_exec($ch_git);

        $response = json_decode($res);
        $prepareJobId='';
        $deployJobId = '';
        foreach($response as $item){
            if($item->name == 'prepare_deployer'){
                $prepareJobId = $item->id;
            }
            if($item->name == 'prod_deployer'){
                $deployJobId = $item->id;
            }
        }
        Craft::$app->getSession()->set('prepareJobId', $prepareJobId);
        Craft::$app->getSession()->set('deployJobId', $deployJobId);

        $ch_git = curl_init();

        curl_setopt($ch_git, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_git, CURLOPT_HTTPHEADER, array('PRIVATE-TOKEN: '. $settings->private_token, 'Content-Type: application/json'));
        curl_setopt($ch_git, CURLOPT_URL, $settings->url . '/projects/'.$settings->project. '/jobs/'.$prepareJobId.'/play');
        curl_setopt($ch_git, CURLOPT_POST, true);
        $res = curl_exec($ch_git);
        $response = json_decode($res);
        $success="Prepare";
        $variables['success'] = $success;
        return $this->renderTemplate(
            'deployment/index',
            $variables
        );
    }

    public function actionPublish(){
        $this->requirePostRequest();
        $request = \Craft::$app->request;
        \Craft::$app->session->setNotice(
            \Craft::t('app', 'Publish')
        );
        $success="Publish";
        $variables['success'] = $success;
        $deployJobId = Craft::$app->getSession()->get('deployJobId');

        $settings = \Craft::$app->getModule('deployment')->getSettings();

        $ch_git = curl_init();

        curl_setopt($ch_git, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_git, CURLOPT_HTTPHEADER, array('PRIVATE-TOKEN: '. $settings->private_token, 'Content-Type: application/json'));
        curl_setopt($ch_git, CURLOPT_URL, $settings->url . '/projects/'.$settings->project.'/jobs/'.$deployJobId.'/play');
        curl_setopt($ch_git, CURLOPT_POST, true);
        $res = curl_exec($ch_git);
        $response = json_decode($res);

        return $this->renderTemplate(
            'deployment/index',
            $variables
        );
    }
}
