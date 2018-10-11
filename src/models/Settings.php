<?php
/**
 * deployment plugin for Craft CMS 3.x
 *
 * deployment
 *
 * @link      smsglobal.com
 * @copyright Copyright (c) 2018 Praveen
 */

namespace smsg\deployment\models;

use smsg\deployment\Deployment;

use Craft;
use craft\base\Model;

/**
 * Deployment Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Praveen
 * @package   Deployment
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * private token model attribute
     *
     * @var string
     */
    public $private_token = '';
    
     /**
     * token model attribute
     *
     * @var string
     */
    public $token = '';
    
    
    /**
     * project model attribute
     *
     * @var string
     */
    public $project = '';

    /**
     * url model attribute
     *
     * @var string
     */
    public $url = '';


    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['token', 'string'],
            ['token', 'default', 'value' => ''],
            ['private_token', 'string'],
            ['private_token', 'default', 'value' => ''],
            ['project', 'string'],
            ['project', 'default', 'value' => ''],
            ['url', 'string'],
            ['url', 'default', 'value' => ''],
        ];
    }
}

