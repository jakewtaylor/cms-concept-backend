<?php

namespace App\Enum;

enum BlockType: string
{
    case HTML = 'html';
    case Image = 'image';
    case JSON = 'json';
    case Markdown = 'markdown';
    case Text = 'text';
}
