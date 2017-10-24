<?php


namespace components\Helpers;


class Sort
{
    const DATE_NEWEST = ['key' => 'status_abc', 'text' => 'Status (ABC)', 'sql' => ['column' => 'status', 'direction' => 'asc']];
    const DATE_OLDEST = ['key' => 'status_zyx', 'text' => 'Status (ZYX)', 'sql' => ['column' => 'status', 'direction' => 'desc']];
    const NAME_ABC = ['key' => 'name_abc', 'text' => 'Name (ABC)', 'sql' => ['column' => 'name', 'direction' => 'asc']];
    const NAME_ZYX = ['key' => 'name_zyx', 'text' => 'Name (ZXY)', 'sql' => ['column' => 'name', 'direction' => 'desc']];
    const EMAIL_ABC = ['key' => 'email_abc', 'text' => 'Email (ABC)', 'sql' => ['column' => 'email', 'direction' => 'asc']];
    const EMAIL_ZYX = ['key' => 'email_zyx', 'text' => 'Email (ZXY)', 'sql' => ['column' => 'email', 'direction' => 'desc']];

    public static function get()
    {
        $reflection = new \ReflectionClass(self::class);

        return collect($reflection->getConstants());
    }
}
