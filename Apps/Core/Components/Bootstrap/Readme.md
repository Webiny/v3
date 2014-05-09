Bootstrap
=========

Bootstrap is a component that initializes Webiny platform. It's the first component that boots up.
It reads the system configuration, initializes other core components and broadcasts an event that other components
can listen to and attach their own callbacks.

## Events

### 'bootstrap_end'

This is the only event to which you can subscribe.
The callback doesn't receive any arguments.
This event is broadcasted when all the core components have been booted.

## Configuration

This component doesn't take any configuration parameters.