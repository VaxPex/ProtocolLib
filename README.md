# ProtocolLib
protocollib like spigot (not a spigot user if u r make a pr if im wrong in something) - unfinished but can be used

# how to use
> ## using PacketEvent
> u can use it anywhere
```php
use VaxPex\events\PacketEvent;
use VaxPex\tools\Tools;

Tools::executePacketEvent(function(PacketEvent $event){
    echo $event->toString() . PHP_EOL;
}, $plugin); 
```
