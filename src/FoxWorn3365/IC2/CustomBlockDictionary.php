<?php

namespace FoxWorn3365\IC2;

use Himbeer\LibSkin\SkinConverter;

final class CustomBlockDictionary {
    public static array $custom = [
        "tin_cable" => 'TinCable'
    ];

    public static array $geometry = [
        'tin_cable' => '{
            "format_version": "1.12.0",
            "minecraft:geometry": [
                {
                    "description": {
                        "identifier": "geometry.cable",
                        "texture_width": 64,
                        "texture_height": 64,
                        "visible_bounds_width": 3,
                        "visible_bounds_height": 2.5,
                        "visible_bounds_offset": [0, 0.75, 0]
                    },
                    "bones": [
                        {
                            "name": "bb_main",
                            "pivot": [0, 0, 0],
                            "cubes": [
                                {"origin": [-8, 6, -2], "size": [17, 4, 4], "uv": [0, 0]}
                            ]
                        }
                    ]
                }
            ]
        }'
    ];

    public static array $texture = [
        'tin_cable' => 'cable.png'
    ];

    public static array $names = [
        'tin_cable' => 'Tin Cable'
    ];

    public static function getGeometry(string $item) : string|null {
        return @self::$geometry[$item];
    }

    public static function getSkin(string $item) : string|null {
        return SkinConverter::imageToSkinDataFromPngPath(__DIR__ . '/texture/' . self::$texture[$item]);
    }

    public static function getName(string $item) : string|null {
        return @self::$names[$item];
    }

    public static function registerAll() : object {
        $object = new \stdClass;
        foreach (self::$custom as $block => $class) {
            $object->{$block} = str_replace('/', '\\', 'FoxWorn3365/IC2/entity/') . $class;
        }
        return $object;
    }
}