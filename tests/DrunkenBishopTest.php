<?php

namespace Tests\DrunkenBishop;

use Tests\TestCase;
use Voronoi\DrunkenBishop\ArtGenerator;

class DrunkenBishopTest extends TestCase
{
  public function testGeneratesCorrectArtwork()
  {
    $fingerprint = "ZvmUf+CE20cNCqZBMHaI+dAdELeY/i+p0wQJBfYoE8U";

    $artGenerator = new ArtGenerator();
    $artwork = $artGenerator->paint($fingerprint);

    $expected = "+--[ RSA 2048]----+
|  .o+*B*=.       |
|   oE+oB..       |
|  o .++.o o   .  |
|   o .+  = + . o |
|      ..S + + . .|
|       +.o * o   |
|       o..o + o  |
|      . +.   o   |
|      .o ..      |
+-----------------+";
    $this->assertEquals($expected, $artwork);
  }
}
