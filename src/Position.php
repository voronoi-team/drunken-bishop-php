<?php

namespace Voronoi\DrunkenBishop;

class Position
{
    public $location;
    public $index;

    function __construct($location, $index)
    {
      $this->location = $location;
      $this->index    = $index;
    }

    function getIndex()
    {
      return $this->index;
    }

    static function createFromIndex($index, $width, $height)
    {
        if ($index == 0) {
          return new Position(Location::TOP_LEFT, $index);
        } else if ($index < $width - 2) {
          return new Position(Location::TOP, $index);
        } else if ($index == $width - 1) {
          return new Position(Location::TOP_RIGHT, $index);
        } else if ($index == ($height-1) * $width) {
          return new Position(Location::BOTTOM_LEFT, $index);
        } else if ($index == $width * $height - 1) {
          return new Position(Location::BOTTOM_RIGHT, $index);
        } else if ($index % $width == 0) {
          return new Position(Location::LEFT, $index);
        } else if ($index % $width == $width - 1) {
          return new Position(Location::RIGHT, $index);
        } else if ($index >= ($height-1) * $width) {
          return new Position(Location::BOTTOM, $index);
        } else {
          return new Position(LOCATION::MIDDLE, $index);
        }
    }

    /// Provides the next $position moving in the attempted direction
    function move($attemptedDirection, $width, $height)
    {
        // Helper method for creating new $positions
        $createPosition = function($newPosition) use ($width, $height) {
            return Position::createFromIndex($newPosition, $width, $height);
        };

        // Offsets
        $left      = -1;
        $right     = 1;
        $down      = $width;
        $downLeft  = $width - 1;
        $downRight = $width + 1;
        $up        = -1 * $width;
        $upRight   = -1 * $width + 1;
        $upLeft    = -1 * $width - 1;

        switch ($this->location) {

        case Location::TOP_LEFT:
          switch ($attemptedDirection) {
          case Direction::UP_LEFT: return new Position(Location::TOP_LEFT, $this->index);
          case Direction::UP_RIGHT: return $createPosition($this->index + $right);
          case Direction::DOWN_LEFT: return $createPosition($this->index + $down);
          case Direction::DOWN_RIGHT: return $createPosition($this->index + $downRight);
          }

        case Location::TOP:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return  $createPosition($this->index + $left);
            case Direction::UP_RIGHT: return $createPosition($this->index + $right);
            case Direction::DOWN_LEFT: return $createPosition($this->index + $downLeft);
            case Direction::DOWN_RIGHT: return $createPosition($this->index + $downRight);
            }

        case Location::TOP_RIGHT:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return $createPosition($this->index - $left);
            case Direction::UP_RIGHT: return new Position(Location::TOP_RIGHT, $this->index);
            case Direction::DOWN_LEFT: return $createPosition($this->index + $downLeft);
            case Direction::DOWN_RIGHT: return $createPosition($this->index + $down);
            }

        case Location::LEFT:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return $createPosition($this->index + $up);
            case Direction::UP_RIGHT: return $createPosition($this->index + $upRight);
            case Direction::DOWN_LEFT: return $createPosition($this->index + $down);
            case Direction::DOWN_RIGHT: return $createPosition($this->index + $downRight);
            }

        case Location::MIDDLE:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return $createPosition($this->index + $upLeft);
            case Direction::UP_RIGHT: return $createPosition($this->index + $upRight);
            case Direction::DOWN_LEFT: return $createPosition($this->index + $downLeft);
            case Direction::DOWN_RIGHT: return $createPosition($this->index + $downRight);
            }

        case Location::RIGHT:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return $createPosition($this->index + $upLeft);
            case Direction::UP_RIGHT: return $createPosition($this->index + $up);
            case Direction::DOWN_LEFT: return $createPosition($this->index + $downLeft);
            case Direction::DOWN_RIGHT: return $createPosition($this->index + $down);
            }

        case Location::BOTTOM_LEFT:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return $createPosition($this->index + $up);
            case Direction::UP_RIGHT: return $createPosition($this->index + $upRight);
            case Direction::DOWN_LEFT: return new Position(Location::BOTTOM_LEFT, $this->index);
            case Direction::DOWN_RIGHT: return $createPosition($this->index + $right);
            }

        case Location::BOTTOM:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return $createPosition($this->index + $upLeft);
            case Direction::UP_RIGHT: return $createPosition($this->index + $upRight);
            case Direction::DOWN_LEFT: return $createPosition($this->index + $left);
            case Direction::DOWN_RIGHT: return $createPosition($this->index + $right);
            }

        case Location::BOTTOM_RIGHT:
            switch ($attemptedDirection) {
            case Direction::UP_LEFT: return $createPosition($this->index + $upLeft);
            case Direction::UP_RIGHT: return $createPosition($this->index + $up);
            case Direction::DOWN_LEFT: return $createPosition($this->index + $left);
            case Direction::DOWN_RIGHT: return new Position(Location::BOTTOM_RIGHT, $this->index);
            }
        }
    }
}
