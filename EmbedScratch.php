<?php
/*
    Copyright (C) 2018 Apple502j All rights reversed.
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
    
    Embedding Scratch in MediaWiki
    <scratch> Tag
    
    Some parts are from ScratchSig
    https://github.com/LLK/mw-ScratchSig2/blob/master/ScratchSig2.php
    
*/

if (!defined('MEDIAWIKI')) {
    die();
}
error_reporting(0);

$wgExtensionFunctions[] = 'beginEmbedScratch';
$wgHooks['ParserFirstCallInit'][] = 'parserEmbedScratch';

function parserEmbedScratch (Parser $parser) {
    $parser->setHook('scratch', 'renderEmbedScratch');
    return true;
}

function renderEmbedScratch ($input, array $args, Parser $parser, PPFrame $frame) {
    $project = $args["project"]?$args["project"]:"";
    if ($url == ""){
        return "";
    }
    $o =  '<br>'
        . '<iframe allowtransparency="true" width="485" height="402" allowfullscreen frameborder="0" src="https://scratch.mit.edu/projects/embed/'
        . $project
        . '/?autostart=false"></iframe>';
    return $o;
}
function beginEmbedScratch () {
    global $wgOut;
    $wgOut->addModules('ext.embedScratch');
}

