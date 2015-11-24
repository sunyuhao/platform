<?php

namespace Oro\Component\EntitySerializer;

class ConfigUtil
{
    /**
     * A field which can be used to get the discriminator value an entity.
     * For example:
     *  'fields' => [
     *      'type' => ['property_path' => '__discriminator__']
     *  ]
     */
    const DISCRIMINATOR = '__discriminator__';

    /**
     * A field which can be used to get FQCN of an entity.
     * For example:
     *  'fields' => [
     *      'entity' => ['property_path' => '__class__']
     *  ]
     */
    const CLASS_NAME = '__class__';

    const EXCLUSION_POLICY      = 'exclusion_policy';
    const EXCLUSION_POLICY_ALL  = 'all';
    const EXCLUSION_POLICY_NONE = 'none';

    const DISABLE_PARTIAL_LOAD = 'disable_partial_load';
    const HINTS                = 'hints';
    const FIELDS               = 'fields';
    const ORDER_BY             = 'order_by';
    const POST_SERIALIZE       = 'post_serialize';

    const PROPERTY_PATH = 'property_path';
    const EXCLUDE       = 'exclude';


    /**
     * @param array  $config A config
     * @param string $key    A config key
     *
     * @return array
     */
    public static function getArrayValue(array $config, $key)
    {
        return isset($config[$key])
            ? $config[$key]
            : [];
    }

    /**
     * @param array $config The config of an entity
     *
     * @return string
     */
    public static function getExclusionPolicy(array $config)
    {
        return isset($config[self::EXCLUSION_POLICY])
            ? $config[self::EXCLUSION_POLICY]
            : self::EXCLUSION_POLICY_NONE;
    }

    /**
     * @param array $config The config of an entity
     *
     * @return bool
     */
    public static function isExcludeAll(array $config)
    {
        return
            isset($config[self::EXCLUSION_POLICY])
            && $config[self::EXCLUSION_POLICY] === self::EXCLUSION_POLICY_ALL;
    }

    /**
     * @param array $config The config of a field
     *
     * @return bool
     */
    public static function isExclude(array $config)
    {
        return
            isset($config[self::EXCLUDE])
            && $config[self::EXCLUDE];
    }

    /**
     * @param array $config The config of an entity
     *
     * @return bool
     */
    public static function isPartialAllowed($config)
    {
        return
            !isset($config[self::DISABLE_PARTIAL_LOAD])
            || !$config[self::DISABLE_PARTIAL_LOAD];
    }

    /**
     * Checks if the specified field has some special configuration
     *
     * @param array  $config The config of an entity the specified field belongs
     * @param string $field  The name of the field
     *
     * @return array
     */
    public static function hasFieldConfig($config, $field)
    {
        return
            !empty($config[self::FIELDS])
            && array_key_exists($field, $config[self::FIELDS]);
    }

    /**
     * Returns the configuration of the specified field
     *
     * @param array  $config The config of an entity the specified field belongs
     * @param string $field  The name of the field
     *
     * @return array
     */
    public static function getFieldConfig($config, $field)
    {
        return isset($config[self::FIELDS][$field])
            ? $config[self::FIELDS][$field]
            : [];
    }

    /**
     * Checks whether a property path represents some metadata property like '__class__' or '__discriminator__'
     *
     * @param string $propertyPath
     *
     * @return bool
     */
    public static function isMetadataProperty($propertyPath)
    {
        return strpos($propertyPath, '__') === 0;
    }

    /**
     * Splits a property path to parts
     *
     * @param string $propertyPath
     *
     * @return string[]
     */
    public static function explodeProperty($propertyPath)
    {
        return explode('.', $propertyPath);
    }
}
