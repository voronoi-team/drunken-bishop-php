<?php

namespace Voronoi\DrunkenBishop;

class Walk
{

  /// Don't change these without modifying currentPosition in the constructor
  public $width = 17;
  public $height = 9;

  public $currentPosition;
  public $endPosition;
  public $startPosition;

  // Array<Int> Number of counts at position
  public $stepCounts;

  function __construct()
  {
    // Defaults to middle
    $this->currentPosition = new Position(Location::MIDDLE, 8 + $this->width * 4);
    $this->end = $this->currentPosition;
    $this->start = $this->currentPosition;
    $this->stepCounts = [];
    foreach(range(0, $this->height * $this->width - 1) as $i) {
      $this->stepCounts[] = 0;
    }
    $this->stepCounts[$this->currentPosition->getIndex()] = 1;
  }

  /// Take a step in the specified direction
  function step($direction)
  {
      $this->currentPosition = $this->currentPosition->move($direction, $this->width, $this->height);
      $this->stepCounts[$this->currentPosition->getIndex()] += 1;
      $this->end = $this->currentPosition;
  }
}
