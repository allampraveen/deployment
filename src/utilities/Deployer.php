<?php
/**
 * deployer plugin for Craft CMS 3.x
 *
 * Deployment
 *
 * @link      https://github.com/allampraveen/
 * @copyright Copyright (c) 2018 Praveen
 */

namespace smsg\deployer\utilities;

use smsg\deployer\Deployer;
use smsg\deployer\assetbundles\deployerutility\DeployerUtilityAsset;

use Craft;
use craft\base\Utility;

/**
 * deployer Utility
 *
 * Utility is the base class for classes representing Control Panel utilities.
 *
 * https://craftcms.com/docs/plugins/utilities
 *
 * @author    Praveen
 * @package   Deployer
 * @since     1.0.0
 */
class Deployer extends Utility
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
        return Craft::t('deployer', 'Deployer');
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
        return 'deployer-deployer';
    }

    /**
     * Returns the path to the utility's SVG icon.
     *
     * @return string|null The path to the utility SVG icon
     */
    public static function iconPath()
    {
        return Craft::getAlias("@smsg/deployer/assetbundles/deployerutility/dist/img/Deployer-icon.svg");
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
        Craft::$app->getView()->registerAssetBundle(DeployerUtilityAsset::class);

        $someVar = 'Have a nice day!';
        return Craft::$app->getView()->renderTemplate(
            'deployer/_components/utilities/Deployer_content',
            [
                'someVar' => $someVar
            ]
        );
    }
}
