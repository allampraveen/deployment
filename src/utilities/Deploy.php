<?php
/**
 * Deployment plugin for Craft CMS 3.x
 *
 * Deployment
 *
 * @link      smsglobal.com
 * @copyright Copyright (c) 2018 Praveen
 */

namespace smsg\deployment\utilities;

use smsg\deployment\Deployment;
use smsg\deployment\assetbundles\deployutility\DeployUtilityAsset;

use Craft;
use craft\base\Utility;

/**
 * Deployment Utility
 *
 * Utility is the base class for classes representing Control Panel utilities.
 *
 * https://craftcms.com/docs/plugins/utilities
 *
 * @author    Praveen
 * @package   Deployment
 * @since     1.0.0
 */
class Deploy extends Utility
{
    // Static
    // =========================================================================

    /**
     * Returns the display name of this utility.
     *
     * @return string The display name of this utility.
     */
    public static function displayName(): string
    {
        return Craft::t('deployment', 'Deploy');
    }

    /**
     * Returns the utility’s unique identifier.
     *
     * The ID should be in `kebab-case`, as it will be visible in the URL (`admin/utilities/the-handle`).
     *
     * @return string
     */
    public static function id(): string
    {
        return 'deployment-deploy';
    }

    /**
     * Returns the path to the utility's SVG icon.
     *
     * @return string|null The path to the utility SVG icon
     */
    public static function iconPath()
    {
        return Craft::getAlias("@smsg/deployment/assetbundles/deployutility/dist/img/Deploy-icon.svg");
    }

    /**
     * Returns the number that should be shown in the utility’s nav item badge.
     *
     * If `0` is returned, no badge will be shown
     *
     * @return int
     */
    public static function badgeCount(): int
    {
        return 0;
    }

    /**
     * Returns the utility's content HTML.
     *
     * @return string
     */
    public static function contentHtml(): string
    {
        Craft::$app->getView()->registerAssetBundle(DeployUtilityAsset::class);

        $someVar = 'Have a nice day!';
        return Craft::$app->getView()->renderTemplate(
            'deployment/_components/utilities/Deploy_content',
            [
                'someVar' => $someVar
            ]
        );
    }
}
