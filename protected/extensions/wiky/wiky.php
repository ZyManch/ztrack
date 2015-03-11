<?php
/* Wiky.php - A tiny PHP "library" to convert Wiki Markup language to HTML
 * Author: Toni Lähdekorpi <toni@lygon.net>
 *
 * Code usage under any of these licenses:
 * Apache License 2.0, http://www.apache.org/licenses/LICENSE-2.0
 * Mozilla Public License 1.1, http://www.mozilla.org/MPL/1.1/
 * GNU Lesser General Public License 3.0, http://www.gnu.org/licenses/lgpl-3.0.html
 * GNU General Public License 2.0, http://www.gnu.org/licenses/gpl-2.0.html
 * Creative Commons Attribution 3.0 Unported License, http://creativecommons.org/licenses/by/3.0/
 */

class wiky {
    private $patterns, $replacements;

    public function __construct($analyze=false) {
        $this->patterns=array(
            "/\r\n/",
            // Headings
            "/^==== (.+?) ====$/m",						// Subsubheading
            "/^=== (.+?) ===$/m",						// Subheading
            "/^== (.+?) ==$/m",						// Heading

            // Formatting
            "/\'\'\'\'\'(.+?)\'\'\'\'\'/s",					// Bold-italic
            "/\'\'\'(.+?)\'\'\'/s",						// Bold
            "/\'\'(.+?)\'\'/s",						// Italic

            // Special
            "/^----+(\s*)$/m",						// Horizontal line
            "/\[\[(file|img):((ht|f)tp(s?):\/\/(.+?))( (.+))*\]\]/i",	// (File|img):(http|https|ftp) aka image
            "/(&quot;(.+)&quot;\:)((news|(ht|f)tp(s?)|irc):\/\/(.+?))(\s+)/i",		// Other urls with text
            "/(\[([^\]]*)\])/i",			// Other urls without text

            // Indentations
            "/[\n\r]: *.+([\n\r]:+.+)*/",					// Indentation first pass
            "/^:(?!:) *(.+)$/m",						// Indentation second pass
            "/([\n\r]:: *.+)+/",						// Subindentation first pass
            "/^:: *(.+)$/m",						// Subindentation second pass

            // Ordered list
            "/[\n\r]?#.+([\n|\r]#.+)+/",					// First pass, finding all blocks
            "/[\n\r]#(?!#) *(.+)(([\n\r]#{2,}.+)+)/",			// List item with sub items of 2 or more
            "/[\n\r]#{2}(?!#) *(.+)(([\n\r]#{3,}.+)+)/",			// List item with sub items of 3 or more
            "/[\n\r]#{3}(?!#) *(.+)(([\n\r]#{4,}.+)+)/",			// List item with sub items of 4 or more

            // Unordered list
            "/[\n\r]?\*.+([\n|\r]\*.+)+/",					// First pass, finding all blocks
            "/[\n\r]\*(?!\*) *(.+)(([\n\r]\*{2,}.+)+)/",			// List item with sub items of 2 or more
            "/[\n\r]\*{2}(?!\*) *(.+)(([\n\r]\*{3,}.+)+)/",			// List item with sub items of 3 or more
            "/[\n\r]\*{3}(?!\*) *(.+)(([\n\r]\*{4,}.+)+)/",			// List item with sub items of 4 or more

            // List items
            "/^[#\*]+ *(.+)$/m",						// Wraps all list items to <li/>

            // Newlines (TODO: make it smarter and so that it groupd paragraphs)
            "/^(?!<li|dd).+(?=(<a|strong|em|img)).+$/mi",			// Ones with breakable elements (TODO: Fix this crap, the li|dd comparison here is just stupid)
            "/^[^><\n\r]+$/m",						// Ones with no elements
        );
        $this->replacements=array(
            function($matches) {
                return "\n";
            },

            // Headings
            function($matches) {
                return '<h3>'.$matches[1].'</h3>';
            },
            function($matches) {
                return '<h2>'.$matches[1].'</h2>';
            },
            function($matches) {
                return '<h1>'.$matches[1].'</h1>';
            },
            //Formatting
            function($matches) {
                return '<strong><em>'.$matches[1].'</em></strong>';
            },
            function($matches) {
                return '<strong>'.$matches[1].'</strong>';
            },
            function($matches) {
                return '<em>'.$matches[1].'</em>';
            },
            // Special
            function($matches) {
                return '<hr/>';
            },
            function($matches) {
                return '<img src="'.$matches[2].'" alt="'.$matches[6].'"/>';
            },
            function($matches) {
                return ' <a href="'.$matches[3].'" target="_blank">'.$matches[2].'</a> ';
            },
            function($matches) {
                $url = Yii::app()->controller->createUrl('',array(
                    'id' => Yii::app()->request->getParam('id'),
                    'module' => 'wiki',
                    'wiki'=>$matches[2]
                ));
                return '<a href="'.htmlspecialchars($url).'">'.$matches[2].'</a>';
            },
            // Indentations
            function($matches) {
                return "\n<dl>".$matches[0]."\n</dl>"; // Newline is here to make the second pass easier
            },
            function($matches) {
                return '<dd>'.$matches[1].'</dd>';
            },
            function($matches) {
                return "\n<dd><dl>".$matches[0]."\n</dl></dd>";
            },
            function($matches) {
                return '<dd>'.$matches[1].'</dd>';
            },
            // Ordered list
            function($matches) {
                return "\n<ol>\n".$matches[0]."\n</ol>";
            },
            function($matches) {
                return "\n<li>".$matches[1]."\n<ol>".$matches[2]."\n</ol>\n</li>";
            },
            function($matches) {
                return "\n<li>".$matches[1]."\n<ol>".$matches[2]."\n</ol>\n</li>";
            },
            function($matches) {
                return "\n<li>".$matches[1]."\n<ol>".$matches[2]."\n</ol>\n</li>";
            },
            // Unordered list
            function($matches) {
                return "\n<ul>\n".$matches[0]."\n</ul>";
            },
            function($matches) {
                return "\n<li>".$matches[1]."\n<ul>".$matches[2]."\n</ul>\n</li>";
            },
            function($matches) {
                return "\n<li>".$matches[1]."\n<ul>".$matches[2]."\n</ul>\n</li>";
            },
            function($matches) {
                return "\n<li>".$matches[1]."\n<ul>".$matches[2]."\n</ul>\n</li>";
            },
            // List items
            function($matches) {
                return "<li>$1</li>";
            },

            // Newlines
            function($matches) {
                return $matches[0].'<br/>';
            },
            function($matches) {
                return $matches[0].'<br/>';
            }
        );
        if($analyze) {
            foreach($this->patterns as $k=>$v) {
                $this->patterns[$k].="S";
            }
        }
    }
    public function parse($input) {
        if(!empty($input)) {
            $input = htmlspecialchars($input);
            foreach ($this->patterns as $index => $pattern) {
                $input = preg_replace_callback($pattern,$this->replacements[$index],$input);
            }
            $output = $input;
        } else {
            $output = false;
        }
        return $output;
    }
}