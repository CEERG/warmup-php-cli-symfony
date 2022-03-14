<?php

namespace app\api\enums;

enum EventType: string {
    case Education = "education";
    case Recreational = "recreational";
    case Social = "social";
    case Diy = "diy";
    case Charity = "charity";
    case Cooking = "cooking";
    case Relaxation = "relaxation";
    case Music = "music";
    case Busywork = "busywork";
}