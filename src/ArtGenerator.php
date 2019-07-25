<?php

namespace Voronoi\DrunkenBishop;

class ArtGenerator
{

  /**
   *  Creates the Random Art for the specified fingerprint
   *
   * @param  String $fingerprint Base64 encoded SSH Public key fingerprint
   *
   * @return String SSH Random Art
   */
  public function paint($fingerprint)
  {
      $bytes = $this->convertToBytes($fingerprint);
      $walk = $this->performDrunkWalk($bytes);

      $formatter = new Formatter();
      return $formatter->render($walk);
  }

  private function convertToBytes($fingerprint)
  {
    $binaryData = base64_decode($fingerprint);
    $unpackedArray = unpack("C*", $binaryData); // Convert to char array
    return array_merge($unpackedArray); // convert to 0-index array
  }

  private function performDrunkWalk($pathAsBytes)
  {
    $walk = new Walk();
    for ($i = 0; $i < count($pathAsBytes); $i++) {
      $nextByte = $pathAsBytes[$i];

      // Each byte represents 4 walks from right to left.
      $walk->step((Int) $nextByte & 0b11);
      $walk->step((Int) ($nextByte >> 2) & 0b11);
      $walk->step((Int) ($nextByte >> 4) & 0b11);
      $walk->step((Int) ($nextByte >> 6) & 0b11);
    }
    return $walk;
  }
}
