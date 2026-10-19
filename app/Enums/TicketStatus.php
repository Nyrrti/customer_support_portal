<?php
namespace App\Enums;
enum TicketStatus: string
{
    case PENDING = "pending";
    case OPEN = "open";
    case CLOSED = "closed";
}