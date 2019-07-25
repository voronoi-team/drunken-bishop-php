<?php

namespace Voronoi\DrunkenBishop;

class Formatter
{

  static $header = "+--[ RSA 2048]----+";
  static $footer = "+-----------------+";

  function render($walk)
  {
      $lines = array_merge(
        [Formatter::$header],
        $this->buildBody($walk),
        [Formatter::$footer]
      );

      return join("\n", $lines);
  }

  private function buildBody($walk)
  {
    $lines = [];
    $line = "";
    foreach ($walk->stepCounts as $index => $count) {

      // Walls
      if ($index % $walk->width == 0 ) {
        // start of the line
        $line = "|";
      }

      $character = $this->mapCharacter($index, $count, $walk->start->index, $walk->end->index);
      $line .= $character;

      // Check at end of line
      if ($index % $walk->width == $walk->width - 1) {
        $line .= "|";
        $lines[] = $line;
        $line = "";
      }
    }

    return $lines;
  }

  private function mapCharacter($index, $count, $startIndex, $endIndex)
  {
    if ($index == $startIndex) {
        return "S";
    } else if ($index == $endIndex) {
        return "E";
    } else {
        switch ($count) {
        case 0: return " ";
        case 1: return ".";
        case 2: return "o";
        case 3: return "+";
        case 4: return "=";
        case 5: return "*";
        case 6: return "B";
        case 7: return "O";
        case 8: return "X";
        case 9: return "@";
        case 10: return "%";
        case 11: return "&";
        case 12: return "#";
        case 13: return "/";
        case 14: return "^";
        default: return "";
        }
    }
  }
}
