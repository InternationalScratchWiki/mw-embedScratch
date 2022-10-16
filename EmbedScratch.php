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

use MediaWiki\Hook\ParserFirstCallInitHook;

if (!defined('MEDIAWIKI')) {
	die();
}
class EmbedScratch implements ParserFirstCallInitHook {
	public function onParserFirstCallInit($parser) {
		$parser->setHook('scratch', array(__CLASS__, 'renderEmbedScratch'));
	}

	public static function renderEmbedScratch($input, $argv, $parser) {
		$project = '';
		$width = $width_max = 485;
		$height = $height_max = 402;

		if (!empty($argv['project'])) {
			$project = $argv['project'];
		} elseif (!empty($input)) {
			$project = $input;
		}
		if (
			!empty($argv['width']) &&
			ctype_digit($argv['width']) &&
			($width_max >= (int)$argv['width'])
		) {
			$width = (int)$argv['width'];
		}
		if (
			!empty($argv['height']) &&
			ctype_digit($argv['height']) &&
			($height_max >= (int)$argv['height'])
		) {
			$height = (int)$argv['height'];
		}
		if (empty($project)) {
			return '';
		}

		$paddingTop = (int)($height / $width * 100);
		return Html::rawElement(
			'div',
			[
				'style' => "max-width:{$width}px",
				'class' => 'mw-embed-scratch'
			],
			Html::rawElement(
				'div',
				['style' => "position:relative;padding-top:{$paddingTop}%"],
				Html::element(
					'iframe',
					[
						'allowtransparency' => 'true',
						'width' => '100%',
						'height' => '100%',
						'src' => "https://scratch.mit.edu/projects/{$project}/embed/",
						'framborder' => '0',
						'allowfullscreen' => '',
						'scrolling' => 'no',
						'style' => 'overflow:hidden;position:absolute;top:0;left:0;border:none;'
					]
				)
			)
		);
	}
}
