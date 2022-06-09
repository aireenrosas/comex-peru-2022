<?php
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Model
{
    use HasPushSubscriptions;
}
