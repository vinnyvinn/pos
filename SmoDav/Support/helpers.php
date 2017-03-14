<?php

function flash($message, $status = 'info')
{
    session()->flash('flash_message', $message);
    session()->flash('flash_status', $status);
}
