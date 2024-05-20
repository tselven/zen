<?php

namespace Core\Enums;

enum JobStatus{
    case InProgress;
    case Completed;
    case Failed;
    case Cancelled;
}
