<?php

namespace app\enums\request;

enum StatusEnum: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Declined = 'declined';
}
