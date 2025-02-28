@php
    /**
     * Determine if the given route name is active.
     *
     * @param string $routeName
     * @return bool
     */
    function isRouteActive($routeName)
    {
        return \Route::currentRouteName() === $routeName;
    }
@endphp
