<?php

if (!function_exists('isDark')) {
    function isDark(): bool
    {
        return authCheck() && auth()->user()->dark_mode_enabled;
    }
}

if (!function_exists('isMenuOpened')) {
    function isMenuOpened(array $names, string $prefix = 'dashboard'): bool
    {
        foreach ($names as $name) {
            if (request()?->routeIs($prefix . '.' . $name . '.*')) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('isCurrentPage')) {
    function isCurrentPage(string $routeName): bool
    {
        return request()?->routeIs($routeName);
    }
}

if (!function_exists('isSelected')) {
    function isSelected(string $name, $value, $default = null): bool
    {
        if ($value === old($name)) {
            return true;
        }

        if (is_array($default)) {
            return in_array($value, $default);
        }

        return $value === $default;
    }
}

if (!function_exists('isSelectedMultiple')) {
    function isSelectedMultiple(string $name, $value, array $default = []): bool
    {
        return in_array($value, old($name, $default));
    }
}

if (!function_exists('isChecked')) {
    function isChecked(string $name, bool $default = false): bool
    {
        return old($name, $default);
    }
}
