An SSH Random Art generator based on http://www.dirk-loss.de/sshvis/drunken_bishop.pdf


# Installation
`composer require voronoi/drunken-bishop`

# Usage

```
// SSH public key fingerprint
$fingerprint = "ZvmUf+CE20cNCqZBMHaI+dAdELeY/i+p0wQJBfYoE8U";

$artGenerator = new Voronoi\DrunkenBishop\ArtGenerator();
$artwork = $artGenerator->paint($fingerprint);

print($artwork);
// +---[RSA 2048]----+
// |  .o+*B*=.       |
// |   oE+oB..       |
// |  o .++.o o   .  |
// |   o .+  = + . o |
// |      ..S + + . .|
// |       +.o * o   |
// |       o..o + o  |
// |      . +.   o   |
// |      .o ..      |
// +----[SHA256]-----+
```
