DevTools
========

This component provides core functions for developing applications and plugins for Webiny platform.

# Component development

Every application or a plugin is consisted out of components. Applications have many components, while a plugin has
only one.

Depending on if you are developing a plugin, or an application, your component structure will be fairly similar.

## Installation

Every component should have an `install.php` script in its root. The script should extend
`Webiny\Apps\Core\Components\DevTools\Lib\InstallAbstract` and implement the abstract methods.

The `install` method will be called when the component is marked for installation. The system will make sure that its
only installed once all its dependencies have been resolved. It the system is unable to resolve the dependencies locally,
it will try automatically to download and install the missing components.

There are also two callbacks that you can implement. The `installation_successful` callback is triggered when the component
is installed successfully, and the `installation_failed` callback that is triggered when the installation fails.


## Uninstallation

Similar, to the installation process, every component should also have an `uninstall.php` script in its root. The script
should extend `Webiny\Apps\Core\Components\DevTools\Lib\UninstallAbstract` and implement the abstract methods.

The `uninstall` method will be called when the components is marked for uninstallation. The system will automatically
remove all the created collections, data from cache and storage so you don't have to worry about that. In case of a
premium component, the system will also remove any credit card subscriptions and similar.

Like with the installation process, the uninstall provides you with the callbacks that you can implement.
`uninstall_successful` is triggered when the component was removed successfully. The `uninstall_failed` callback is
triggered when uninstall failed.

## Events

The difference between using the callback methods (`installation_successful`, `installation_failed`) and events is
that callback methods are called only on installation  of that particular component, while events are called when
any component gets installed or uninstalled.

There are couple of events you can subscribe to:

### `installation_successful`

This event is broadcasted when a component has been installed successfully.
// TODO: define which arguments the callback gets

### `installation_failed`

This event is broadcasted when a component installation fails.
// TODO: define which arguments the callback gets

### `uninstallation_successful`

This event is broadcasted when a component is uninstalled successfully.
// TODO: define which arguments the callback gets

## Component.yaml

This file contains information about the component and its details. It should be written in YAML format (http://www.yaml.org).
It should contain the following information:
- `name`: name of the component (human readable)
- `version`: component version (e.g. 1.0.1)
- `author`: name of the author (e.g. Webiny LTD)
- `dependency`: a list of dependencies that need to be resolved, before the component can be installed

Here is an example Component.yaml file:

```
    name: Bootstrap
    version: 0.1.0
    author: Webiny LTD
    dependency:
      - Apps/Core/Templating
      - Apps/Core/EventManager
      - Apps/Core/Storage
      - Apps/Core/Cache
```

# DevToolsTrait

This is a PHP trait that provides you with access to all core components that you need to develop your plugin.
To use the trait, simply `use` the `Webiny\Apps\Core\Components\DevTools\Lib\DevToolsTrait` inside your class, like this:

````php
class MyClass
{
    use Webiny\Apps\Core\Components\DevTools\Lib\DevToolsTrait;

    public function myMethod()
    {
        // get database
        $this->_wDatabase()->find(...);

        // get storage
        $this->_wStorage();
    }
}
````

You have access to following components:
 - `_wDatabase`: get access to your current database
 - `_wStorage`: get access to your storage
 - `_wCache`: get access to cache system
 - `_wConfig`: get current system configuration
 - `_wRequest`: get current request data, including access to cookie and session storage
 - `_wEvents`: get access to current events
 - `_wServiceOutput`: returns an instance of `ServiceOutput` class that you must use to return the results from REST service
 - `_wService`: TODO
 - `_wEntity`: TODO
 - `_wTemplateEngine`: TODO