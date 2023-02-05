<?php
defined('BASEPATH') or exit('No direct script access allowed');

function asset_url($link = null)
{
    return base_url('assets/') . $link;
}
